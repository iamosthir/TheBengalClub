<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipApplication;
use App\Models\MembershipInstallment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserProfile;
use App\Mail\ApplicationApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MembershipApplicationController extends Controller
{
    /**
     * Display a listing of membership applications
     */
    public function index(Request $request)
    {
        $query = MembershipApplication::with('membershipCategory');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('nid_passport', 'like', "%{$search}%");
            });
        }

        // Order by latest
        $applications = $query->latest()->paginate(20);

        // Get counts for stats
        $pendingCount = MembershipApplication::where('status', 'pending')->count();
        $acceptedCount = MembershipApplication::where('status', 'accepted')->count();
        $rejectedCount = MembershipApplication::where('status', 'rejected')->count();

        return view('admin.membership-applications.index', compact(
            'applications',
            'pendingCount',
            'acceptedCount',
            'rejectedCount'
        ));
    }

    /**
     * Display the specified application
     */
    public function show(MembershipApplication $membershipApplication)
    {
        $membershipApplication->load([
            'membershipCategory',
            'paymentMethod',
            'paymentVerifiedByAdmin',
            'userProfile.installments.completedByAdmin',
        ]);

        return view('admin.membership-applications.show', compact('membershipApplication'));
    }

    /**
     * Update application status (approve/reject)
     */
    public function updateStatus(Request $request, MembershipApplication $membershipApplication)
    {
        $category = $membershipApplication->membershipCategory;

        $rules = ['status' => 'required|in:accepted,rejected'];
        if ($request->status === 'accepted' && $category->duration !== 'Lifetime') {
            $rules['subscription_period'] = 'required|integer|min:1';
        }
        $request->validate($rules);

        $newStatus = $request->status;

        // If approving the application
        if ($newStatus === 'accepted' && $membershipApplication->status !== 'accepted') {
            // Generate random 6-digit password
            $password = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            try {
                // Create user
                $user = User::create([
                    'name' => $membershipApplication->name,
                    'email' => $membershipApplication->email,
                    'password' => Hash::make($password),
                ]);

                // Calculate membership period based on subscription_period
                $startAt = now();
                $subscriptionPeriod = (int) $request->subscription_period;

                if ($category->duration === 'Monthly') {
                    $endAt = $startAt->copy()->addMonths($subscriptionPeriod);
                } elseif ($category->duration === 'Yearly') {
                    $endAt = $startAt->copy()->addYears($subscriptionPeriod);
                } else {
                    // Lifetime
                    $endAt = $startAt->copy()->addYears(20);
                }

                // Create user profile
                $profile = UserProfile::create([
                    'user_id' => $user->id,
                    'photo' => $membershipApplication->photo,
                    'membership_application_id' => $membershipApplication->id,
                    'date_of_birth' => $membershipApplication->date_of_birth,
                    'nid_passport' => $membershipApplication->nid_passport,
                    'profession_organization' => $membershipApplication->profession_organization,
                    'mobile' => $membershipApplication->mobile,
                    'address' => $membershipApplication->address,
                    'membership_category_id' => $membershipApplication->membership_category_id,
                    'membership_start_at' => $startAt,
                    'membership_end_at' => $endAt,
                ]);

                // Generate installment schedule based on subscription period and category duration
                if ($category->duration === 'Monthly') {
                    for ($i = 0; $i < $subscriptionPeriod; $i++) {
                        MembershipInstallment::create([
                            'user_id'            => $user->id,
                            'user_profile_id'    => $profile->id,
                            'installment_number' => $i + 1,
                            'due_date'           => $startAt->copy()->addMonths($i)->toDateString(),
                            'amount'             => $category->installment_price,
                        ]);
                    }
                } elseif ($category->duration === 'Yearly') {
                    for ($i = 0; $i < $subscriptionPeriod; $i++) {
                        MembershipInstallment::create([
                            'user_id'            => $user->id,
                            'user_profile_id'    => $profile->id,
                            'installment_number' => $i + 1,
                            'due_date'           => $startAt->copy()->addYears($i)->toDateString(),
                            'amount'             => $category->installment_price,
                        ]);
                    }
                }
                // Lifetime: no installments

                // Log the application fee as a transaction
                Transaction::create([
                    'user_id'                    => $user->id,
                    'amount'                     => $category->price,
                    'reason'                     => 'Application Fee — ' . $category->title,
                    'payment_date'               => now()->toDateString(),
                    'payment_method_id'          => $membershipApplication->payment_method_id,
                    'membership_application_id'  => $membershipApplication->id,
                    'recorded_by_admin_id'       => auth()->guard('admin')->id(),
                ]);

                // Update application status
                $membershipApplication->update(['status' => 'accepted']);

                // Send approval email
                Mail::to($membershipApplication->email)->send(
                    new ApplicationApproved($membershipApplication, $user, $password)
                );

                return redirect()
                    ->route('admin.membership-applications.show', $membershipApplication)
                    ->with('success', 'Application approved successfully! User account created and approval email sent.');
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.membership-applications.show', $membershipApplication)
                    ->with('error', 'Failed to approve application: ' . $e->getMessage());
            }
        }

        // If rejecting the application
        if ($newStatus === 'rejected') {
            $membershipApplication->update(['status' => 'rejected']);

            return redirect()
                ->route('admin.membership-applications.show', $membershipApplication)
                ->with('success', 'Application rejected successfully.');
        }

        return redirect()
            ->route('admin.membership-applications.show', $membershipApplication)
            ->with('info', 'Application status updated.');
    }

    /**
     * Mark payment as verified
     */
    public function verifyPayment(MembershipApplication $membershipApplication)
    {
        if ($membershipApplication->payment_verified_at) {
            return redirect()
                ->route('admin.membership-applications.show', $membershipApplication)
                ->with('info', 'Payment was already verified.');
        }

        $membershipApplication->update([
            'payment_verified_at'          => now(),
            'payment_verified_by_admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()
            ->route('admin.membership-applications.show', $membershipApplication)
            ->with('success', 'Payment verified successfully.');
    }

    /**
     * Delete an application
     */
    public function destroy(MembershipApplication $membershipApplication)
    {
        // Don't allow deletion of accepted applications
        if ($membershipApplication->status === 'accepted') {
            return redirect()
                ->route('admin.membership-applications.index')
                ->with('error', 'Cannot delete an accepted application.');
        }

        $membershipApplication->delete();

        return redirect()
            ->route('admin.membership-applications.index')
            ->with('success', 'Application deleted successfully.');
    }

    /**
     * Get pending applications count (for AJAX requests)
     */
    public function getPendingCount()
    {
        $count = MembershipApplication::where('status', 'pending')->count();
        return response()->json(['count' => $count]);
    }
}
