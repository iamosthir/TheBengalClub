<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipInstallment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = MembershipInstallment::with([
                'user',
                'userProfile.membershipCategory',
                'memberPaymentMethod',
            ]);

        // Status filter — default to submitted (awaiting approval)
        switch ($request->input('status', 'submitted')) {
            case 'submitted':
                $query->where('status', 'pending')->whereNotNull('member_submitted_at');
                break;
            case 'completed':
                $query->where('status', 'completed');
                break;
            case 'pending':
                $query->where('status', 'pending')->whereNull('member_submitted_at');
                break;
            case 'overdue':
                $query->where('status', 'pending')->where('due_date', '<', now()->startOfDay());
                break;
            // 'all' → no filter
        }

        // Member search
        if ($request->filled('user')) {
            $search = $request->input('user');
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%")
                                                   ->orWhere('email', 'like', "%{$search}%"));
        }

        // Due date range
        if ($request->filled('date_from')) {
            $query->where('due_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->where('due_date', '<=', $request->input('date_to'));
        }

        $requests = $query->latest('member_submitted_at')->paginate(20)->withQueryString();

        return view('admin.pages.payment-requests.index', compact('requests'));
    }

    public function approve(MembershipInstallment $installment)
    {
        if ($installment->status === 'completed' || ! $installment->member_submitted_at) {
            return redirect()->back()->with('error', 'Cannot approve this installment.');
        }

        $installment->update([
            'status'               => 'completed',
            'payment_method'       => $installment->memberPaymentMethod?->name ?? 'Member Payment',
            'note'                 => 'Member Transaction ID: ' . $installment->member_txn_id,
            'paid_at'              => now(),
            'completed_by_admin_id' => auth()->guard('admin')->id(),
        ]);

        $installment->loadMissing('userProfile.membershipCategory');
        $isOptionalDonation = $installment->userProfile?->membershipCategory?->optional_installment ?? false;

        Transaction::create([
            'user_id'              => $installment->user_id,
            'amount'               => $installment->amount,
            'reason'               => $isOptionalDonation
                ? 'Voluntary Donation #' . $installment->installment_number
                : 'Monthly Installment #' . $installment->installment_number,
            'payment_date'         => now()->toDateString(),
            'payment_method_id'    => $installment->member_payment_method_id,
            'recorded_by_admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->route('admin.payment-requests.index')
            ->with('success', 'Payment approved and installment marked as completed.');
    }

    public function reject(MembershipInstallment $installment)
    {
        if (! $installment->member_submitted_at) {
            return redirect()->back()->with('error', 'No pending payment submission found.');
        }

        if ($installment->member_proof_path) {
            Storage::disk('public')->delete($installment->member_proof_path);
        }

        $installment->update([
            'member_payment_method_id' => null,
            'member_txn_id'            => null,
            'member_proof_path'        => null,
            'member_submitted_at'      => null,
        ]);

        return redirect()->route('admin.payment-requests.index')
            ->with('success', 'Payment request rejected. Member can resubmit.');
    }

    public function destroy(MembershipInstallment $installment)
    {
        if ($installment->member_proof_path) {
            Storage::disk('public')->delete($installment->member_proof_path);
        }

        $installment->delete();

        return redirect()->route('admin.payment-requests.index')
            ->with('success', 'Payment request deleted.');
    }
}
