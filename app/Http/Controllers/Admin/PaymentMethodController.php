<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->paginate(10);

        return view('admin.pages.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.pages.payment-methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048',
            'instruction' => 'nullable|string',
            'wallet_number' => 'nullable|string|max:255',
            'qr_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'label' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('payment-methods', 'public');
        }

        if ($request->hasFile('qr_image')) {
            $validated['qr_image_path'] = $request->file('qr_image')->store('payment-methods/qr', 'public');
        }

        unset($validated['logo'], $validated['qr_image']);

        PaymentMethod::create($validated);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.pages.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048',
            'instruction' => 'nullable|string',
            'wallet_number' => 'nullable|string|max:255',
            'qr_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
            'label' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($paymentMethod->logo_path) {
                Storage::disk('public')->delete($paymentMethod->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('payment-methods', 'public');
        }

        if ($request->hasFile('qr_image')) {
            if ($paymentMethod->qr_image_path) {
                Storage::disk('public')->delete($paymentMethod->qr_image_path);
            }
            $validated['qr_image_path'] = $request->file('qr_image')->store('payment-methods/qr', 'public');
        }

        unset($validated['logo'], $validated['qr_image']);

        $paymentMethod->update($validated);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->logo_path) {
            Storage::disk('public')->delete($paymentMethod->logo_path);
        }

        if ($paymentMethod->qr_image_path) {
            Storage::disk('public')->delete($paymentMethod->qr_image_path);
        }

        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Payment method deleted successfully.');
    }
}
