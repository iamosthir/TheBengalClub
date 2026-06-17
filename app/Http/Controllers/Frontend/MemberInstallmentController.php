<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MembershipInstallment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MemberInstallmentController extends Controller
{
    public function submitPayment(Request $request, MembershipInstallment $installment)
    {
        $user = Auth::user();

        if ($installment->user_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        if ($installment->status === 'completed') {
            return response()->json(['success' => false, 'message' => 'This installment is already paid.'], 422);
        }

        if ($installment->member_submitted_at) {
            return response()->json(['success' => false, 'message' => 'Payment already submitted. Awaiting admin approval.'], 422);
        }

        $validated = $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'txn_id'            => 'required|string|max:255',
            'proof'             => 'required|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('installment-proofs', 'public');
        }

        $installment->update([
            'member_payment_method_id' => $validated['payment_method_id'],
            'member_txn_id'            => $validated['txn_id'],
            'member_proof_path'        => $proofPath,
            'member_submitted_at'      => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment submitted successfully. Awaiting admin approval.',
        ]);
    }

    public function donate(Request $request)
    {
        $user = Auth::user()->load('profile.membershipCategory');

        if (! $user->profile?->membershipCategory?->optional_installment) {
            return response()->json(['success' => false, 'message' => 'Donations are not available for your membership category.'], 403);
        }

        $validated = $request->validate([
            'amount'            => 'required|numeric|min:1',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'txn_id'            => 'required|string|max:255',
            'proof'             => 'required|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        $nextNumber = MembershipInstallment::where('user_id', $user->id)->count() + 1;

        $proofPath = $request->file('proof')->store('installment-proofs', 'public');

        MembershipInstallment::create([
            'user_id'                  => $user->id,
            'user_profile_id'          => $user->profile->id,
            'installment_number'       => $nextNumber,
            'due_date'                 => now()->toDateString(),
            'amount'                   => $validated['amount'],
            'status'                   => 'pending',
            'member_payment_method_id' => $validated['payment_method_id'],
            'member_txn_id'            => $validated['txn_id'],
            'member_proof_path'        => $proofPath,
            'member_submitted_at'      => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Donation submitted successfully. Awaiting admin approval.',
        ]);
    }
}
