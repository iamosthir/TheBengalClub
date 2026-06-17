<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('donationCategory');

        if ($request->filled('category')) {
            $query->where('donation_category_id', $request->category);
        }

        $expenses    = $query->latest()->paginate(20);
        $categories  = DonationCategory::orderBy('name')->get();
        $totalAmount = $query->sum('amount');

        return view('admin.pages.expenses.index', compact('expenses', 'categories', 'totalAmount'));
    }

    public function create()
    {
        $categories = DonationCategory::where('status', 'active')->orderBy('name')->get();
        return view('admin.pages.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donation_category_id' => 'nullable|exists:donation_categories,id',
            'description'          => 'required|string|max:500',
            'amount'               => 'required|numeric|min:0.01',
            'attachment'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('expense-attachments', 'public');
        }

        Expense::create([
            'donation_category_id' => $request->donation_category_id ?: null,
            'description'          => $request->description,
            'amount'               => $request->amount,
            'attachment_path'      => $attachmentPath,
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense recorded successfully.');
    }

    public function edit(Expense $expense)
    {
        $categories = DonationCategory::orderBy('name')->get();
        return view('admin.pages.expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'donation_category_id' => 'nullable|exists:donation_categories,id',
            'description'          => 'required|string|max:500',
            'amount'               => 'required|numeric|min:0.01',
            'attachment'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $attachmentPath = $expense->attachment_path;
        if ($request->hasFile('attachment')) {
            if ($attachmentPath) {
                Storage::disk('public')->delete($attachmentPath);
            }
            $attachmentPath = $request->file('attachment')->store('expense-attachments', 'public');
        }

        $expense->update([
            'donation_category_id' => $request->donation_category_id ?: null,
            'description'          => $request->description,
            'amount'               => $request->amount,
            'attachment_path'      => $attachmentPath,
        ]);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->attachment_path) {
            Storage::disk('public')->delete($expense->attachment_path);
        }
        $expense->delete();

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense deleted.');
    }
}
