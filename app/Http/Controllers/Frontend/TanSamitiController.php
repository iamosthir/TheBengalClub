<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\SiteSetting;
use App\Models\TanSamiti;
use App\Models\TanSamitiInstallment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TanSamitiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $samitis = TanSamiti::where('status', 'active')
            ->withCount('activeMembers')
            ->with(['draws' => fn($q) => $q->latest('cycle_number')->limit(1)])
            ->latest()
            ->get();

        $joinedIds = $user->tanSamitiMemberships()
            ->where('status', 'active')
            ->pluck('tan_samiti_id')
            ->toArray();

        return view('frontend.pages.tan-samiti.index', compact('samitis', 'joinedIds'));
    }

    public function show(TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->isActive()) {
            abort(404);
        }

        $user = auth()->user();

        $membership = $tanSamiti->members()
            ->where('user_id', $user->id)
            ->first();

        $myInstallments = collect();
        if ($membership) {
            $myInstallments = $tanSamiti->installments()
                ->where('user_id', $user->id)
                ->with('memberPaymentMethod')
                ->orderBy('cycle_number')
                ->get();
        }

        $draws = $tanSamiti->draws()
            ->with('user.profile')
            ->orderByDesc('cycle_number')
            ->get();

        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('frontend.pages.tan-samiti.show', compact(
            'tanSamiti', 'membership', 'myInstallments', 'draws', 'paymentMethods'
        ));
    }

    public function join(TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->isActive()) {
            return back()->with('error', 'This Investment Plan is not active.');
        }

        $user = auth()->user();

        $exists = $tanSamiti->members()->where('user_id', $user->id)->exists();

        if ($exists) {
            return back()->with('error', 'You have already joined this Investment Plan.');
        }

        if ($tanSamiti->isFull()) {
            return back()->with('error', 'This Investment Plan has reached its member limit.');
        }

        $tanSamiti->members()->create([
            'user_id'   => $user->id,
            'status'    => 'active',
            'joined_at' => now(),
        ]);

        $tanSamiti->generateInstallmentsForUser($user->id);

        return redirect()->route('member.tan-samiti.show', $tanSamiti)
            ->with('success', 'You have successfully joined the Investment Plan!');
    }

    public function agreementPdf(TanSamiti $tanSamiti)
    {
        if (! $tanSamiti->isActive()) {
            abort(404);
        }

        $user = auth()->user();

        $membership = $tanSamiti->members()
            ->where('user_id', $user->id)
            ->first();

        if (! $membership) {
            return back()->with('error', 'You are not a member of this Tan Samiti.');
        }

        $user->load('profile');
        $settings = SiteSetting::firstOrCreate(['id' => 1]);

        $pdf = Pdf::loadView('pdf.tan-samiti-agreement', [
            'tanSamiti'  => $tanSamiti,
            'member'     => $user,
            'membership' => $membership,
            'settings'   => $settings,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'tan-samiti-agreement-' . $tanSamiti->id . '-member-' . $user->id . '.pdf';

        return $pdf->download($filename);
    }

    public function submitPayment(Request $request, TanSamitiInstallment $installment)
    {
        $user = auth()->user();

        if ($installment->user_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        if ($installment->isCompleted()) {
            return response()->json(['success' => false, 'message' => 'This installment is already paid.'], 422);
        }

        if ($installment->isPaymentSubmitted()) {
            return response()->json(['success' => false, 'message' => 'Payment already submitted. Awaiting admin approval.'], 422);
        }

        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'txn_id'            => 'required|string|max:255',
            'proof'             => 'required|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        $proofPath = $request->file('proof')->store('tan-samiti-proofs', 'public');

        $installment->update([
            'member_payment_method_id' => $request->payment_method_id,
            'member_txn_id'            => $request->txn_id,
            'member_proof_path'        => $proofPath,
            'member_submitted_at'      => now(),
            'rejected_at'              => null,
            'rejected_by_admin_id'     => null,
            'rejection_reason'         => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment submitted successfully. Awaiting admin approval.',
        ]);
    }
}
