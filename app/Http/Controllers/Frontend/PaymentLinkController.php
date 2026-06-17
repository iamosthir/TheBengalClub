<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PaymentLink;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentLinkController extends Controller
{
    public function show(string $token)
    {
        $paymentLink = PaymentLink::where('token', $token)->firstOrFail();

        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('frontend.pages.payment-link', compact('paymentLink', 'paymentMethods'));
    }

    public function submit(Request $request, string $token)
    {
        $paymentLink = PaymentLink::where('token', $token)->firstOrFail();

        if (! $paymentLink->isPayable()) {
            return redirect()->route('payment-link.show', $paymentLink->token)
                ->with('error', 'This payment link is no longer accepting payments.');
        }

        $validated = $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'transaction_id' => 'required|string|max:255',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Replace any previously uploaded proof (e.g. a re-submission)
        if ($paymentLink->payment_proof_path) {
            Storage::disk('public')->delete($paymentLink->payment_proof_path);
        }

        $proofPath = $request->file('payment_proof')->store('payment-link-proofs', 'public');

        $paymentLink->update([
            'status' => 'submitted',
            'payment_method_id' => $validated['payment_method_id'],
            'transaction_id' => $validated['transaction_id'],
            'payment_proof_path' => $proofPath,
            'submitted_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('payment-link.show', $paymentLink->token)
            ->with('success', 'Payment submitted successfully. We will review and confirm it shortly.');
    }
}
