<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with(['paymentMethod', 'donationCategory']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('transaction_id', 'like', "%{$s}%");
            });
        }

        $donations = $query->latest()->paginate(20);

        $pendingCount  = Donation::where('status', 'pending')->count();
        $verifiedCount = Donation::where('status', 'verified')->count();
        $canceledCount = Donation::where('status', 'canceled')->count();
        $totalAmount   = Donation::where('status', 'verified')->sum('amount');

        return view('admin.pages.donations.index', compact(
            'donations', 'pendingCount', 'verifiedCount', 'canceledCount', 'totalAmount'
        ));
    }

    public function show(Donation $donation)
    {
        $donation->load(['paymentMethod', 'donationCategory']);
        return view('admin.pages.donations.show', compact('donation'));
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:verified,canceled',
            'note'   => 'nullable|string|max:1000',
        ]);

        $donation->update([
            'status' => $request->status,
            'note'   => $request->note,
        ]);

        return redirect()->route('admin.donations.show', $donation)
            ->with('success', 'Donation status updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        if ($donation->payment_proof_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($donation->payment_proof_path);
        }
        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation record deleted.');
    }
}
