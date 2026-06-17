<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipInstallment;
use App\Models\MembershipTransaction;
use Illuminate\Http\Request;

class MembershipInstallmentController extends Controller
{
    /**
     * Update the status of a membership installment.
     */
    public function update(Request $request, MembershipInstallment $installment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed',
            'payment_method' => 'nullable|in:Bkash,Nagad,Rocket,Bank,Cash,Other',
            'note' => 'nullable|string|max:1000',
        ]);

        $newStatus = $validated['status'];

        if ($newStatus === 'completed') {
            $installment->update([
                'status' => 'completed',
                'payment_method' => $validated['payment_method'] ?? null,
                'note' => $validated['note'] ?? null,
                'paid_at' => now(),
                'completed_by_admin_id' => auth('admin')->id(),
            ]);

            // Record transaction log
            MembershipTransaction::create([
                'user_id' => $installment->user_id,
                'membership_installment_id' => $installment->id,
                'amount' => $installment->amount,
                'payment_type' => $validated['payment_method'] ?? 'Cash',
                'trx_id' => null,
                'admin_id' => auth('admin')->id(),
                'completed_by' => 'admin',
                'status' => 'completed',
                'notes' => $validated['note'] ?? null,
            ]);
        } else {
            // Revert to pending — clear all payment data
            $installment->update([
                'status' => 'pending',
                'payment_method' => null,
                'note' => $validated['note'] ?? null,
                'paid_at' => null,
                'completed_by_admin_id' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $newStatus === 'completed'
                ? 'Installment marked as completed.'
                : 'Installment reverted to pending.',
            'installment' => [
                'id' => $installment->id,
                'status' => $installment->status,
                'payment_method' => $installment->payment_method,
                'note' => $installment->note,
                'paid_at' => $installment->paid_at?->format('d M Y, h:i A'),
            ],
        ]);
    }
}
