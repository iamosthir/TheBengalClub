<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentLinkMail;
use App\Models\PaymentLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PaymentLinkController extends Controller
{
    public function index(Request $request)
    {
        $query = PaymentLink::with('paymentMethod')->latest();

        if (in_array($request->input('status'), ['pending', 'submitted', 'verified', 'canceled'], true)) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $links = $query->paginate(20)->withQueryString();

        return view('admin.pages.payment-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.pages.payment-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'purpose' => 'nullable|string|max:255',
        ]);

        $validated['created_by_admin_id'] = auth()->guard('admin')->id();

        $link = PaymentLink::create($validated);

        $message = 'Payment link created. Share it with the payer below.';

        // Send the link by email directly (only if an email was provided)
        if ($link->email) {
            try {
                Mail::to($link->email)->send(new PaymentLinkMail($link));
                $message = 'Payment link created and emailed to '.$link->email.'.';
            } catch (\Throwable $e) {
                Log::error('Failed to send payment link email: '.$e->getMessage());
                $message = 'Payment link created, but the email could not be sent. You can still share it below.';
            }
        }

        return redirect()->route('admin.payment-links.show', $link)
            ->with('success', $message);
    }

    public function show(PaymentLink $paymentLink)
    {
        $paymentLink->load('paymentMethod', 'createdByAdmin', 'verifiedByAdmin');

        return view('admin.pages.payment-links.show', compact('paymentLink'));
    }

    public function verify(PaymentLink $paymentLink)
    {
        if (! $paymentLink->isSubmitted()) {
            return redirect()->back()->with('error', 'Only a submitted payment can be verified.');
        }

        $paymentLink->update([
            'status' => 'verified',
            'verified_at' => now(),
            'verified_by_admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->back()->with('success', 'Payment verified successfully.');
    }

    public function cancel(PaymentLink $paymentLink)
    {
        if ($paymentLink->isVerified()) {
            return redirect()->back()->with('error', 'A verified payment cannot be canceled.');
        }

        $paymentLink->update(['status' => 'canceled']);

        return redirect()->back()->with('success', 'Payment link canceled.');
    }

    public function destroy(PaymentLink $paymentLink)
    {
        if ($paymentLink->payment_proof_path) {
            Storage::disk('public')->delete($paymentLink->payment_proof_path);
        }

        $paymentLink->delete();

        return redirect()->route('admin.payment-links.index')
            ->with('success', 'Payment link deleted.');
    }
}
