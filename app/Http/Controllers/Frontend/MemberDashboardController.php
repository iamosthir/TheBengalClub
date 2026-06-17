<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load([
            'profile.membershipCategory',
            'profile.installments',
        ]);

        $isOptionalInstallment = (bool) $user->profile?->membershipCategory?->optional_installment;

        $installments = $user->profile?->installments ?? collect();
        // Overdue alerts only apply to mandatory installment members
        $overdueCount = $isOptionalInstallment
            ? 0
            : $installments->filter(fn ($i) => $i->isOverdue() && ! $i->isPaymentSubmitted())->count();
        $pendingCount = $installments->filter(fn ($i) => $i->isPaymentSubmitted())->count();

        return view('frontend.pages.member-dashboard', compact('user', 'overdueCount', 'pendingCount', 'isOptionalInstallment'));
    }

    public function paymentTimeline()
    {
        $user = Auth::user()->load([
            'profile.membershipCategory',
            'profile.installments' => fn ($q) => $q->orderBy('installment_number'),
            'profile.installments.memberPaymentMethod',
        ]);

        $isOptionalInstallment = (bool) $user->profile?->membershipCategory?->optional_installment;
        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('frontend.pages.member-payments', compact('user', 'paymentMethods', 'isOptionalInstallment'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'                    => 'required|string|max:255',
            'mobile'                  => 'required|string|max:20',
            'profession_organization' => 'required|string|max:255',
            'date_of_birth'           => 'required|date',
            'nid_passport'            => 'required|string|max:255',
            'address'                 => 'required|string',
            'photo'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_url'            => 'nullable|url|max:500',
            'instagram_url'           => 'nullable|url|max:500',
            'linkedin_url'            => 'nullable|url|max:500',
            'twitter_url'             => 'nullable|url|max:500',
            'youtube_url'             => 'nullable|url|max:500',
        ]);

        // Update user name
        $user->update(['name' => $request->name]);

        // Update profile
        $profileData = $request->only([
            'mobile',
            'profession_organization',
            'date_of_birth',
            'nid_passport',
            'address',
            'facebook_url',
            'instagram_url',
            'linkedin_url',
            'twitter_url',
            'youtube_url',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->profile->photo) {
                Storage::disk('public')->delete($user->profile->photo);
            }

            $profileData['photo'] = $request->file('photo')->store('member-photos', 'public');
        }

        $user->profile->update($profileData);

        return back()->with('profile_success', 'Profile updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password_email' => 'required|string',
        ]);

        if (!Hash::check($request->current_password_email, $user->password)) {
            return back()->withErrors(['current_password_email' => 'Current password is incorrect.']);
        }

        $user->update(['email' => $request->email]);

        return back()->with('email_success', 'Email updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => $request->password]);

        return back()->with('password_success', 'Password updated successfully.');
    }
}
