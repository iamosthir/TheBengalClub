<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\MembershipCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function index()
    {
        $categories = MembershipCategory::orderBy('title')->get();
        $invitations = Invitation::with('membershipCategory')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.pages.invitations.index', compact('categories', 'invitations'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'email'                   => 'required|email|max:255',
            'membership_category_id'  => 'required|exists:membership_categories,id',
            'application_fee'         => 'required|numeric|min:0',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return back()->withInput()->withErrors([
                'email' => 'This email is already registered as a member.',
            ]);
        }

        do {
            $inviteId = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        } while (Invitation::where('invite_id', $inviteId)->exists());

        $invitation = Invitation::create([
            'invite_id'               => $inviteId,
            'email'                   => $request->email,
            'membership_category_id'  => $request->membership_category_id,
            'application_fee'         => $request->application_fee,
            'is_used'                 => false,
        ]);

        Mail::to($invitation->email)->send(new InvitationMail($invitation));

        return redirect()->route('admin.invitations.index')
            ->with('success', "Invitation sent to {$invitation->email} (ID: {$invitation->invite_id}).");
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        return redirect()->route('admin.invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }
}
