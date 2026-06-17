<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCategory;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $categories     = DonationCategory::where('status', 'active')->get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        // Determine active category from URL or default to first
        $activeCategoryId = null;
        if ($request->filled('category')) {
            $cat = $categories->firstWhere('id', (int) $request->category);
            $activeCategoryId = $cat?->id;
        }
        if (! $activeCategoryId && $categories->isNotEmpty()) {
            $activeCategoryId = $categories->first()->id;
        }

        return view('frontend.pages.donate', compact('categories', 'paymentMethods', 'activeCategoryId'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'full_name'           => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'amount'              => 'required|numeric|min:1',
            'donation_category_id'=> 'nullable|exists:donation_categories,id',
            'payment_method_id'   => 'required|exists:payment_methods,id',
            'transaction_id'      => 'required|string|max:255',
            'payment_proof'       => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $proofPath = $request->file('payment_proof')->store('donation-proofs', 'public');

        Donation::create([
            'donation_category_id' => $request->donation_category_id ?: null,
            'full_name'            => $request->full_name,
            'email'                => $request->email,
            'amount'               => $request->amount,
            'payment_method_id'    => $request->payment_method_id,
            'transaction_id'       => $request->transaction_id,
            'payment_proof_path'   => $proofPath,
            'ip_address'           => $request->ip(),
        ]);

        return redirect()->route('donate')
            ->with('success', 'Thank you for your generous donation! We will review and confirm your payment shortly.');
    }
}
