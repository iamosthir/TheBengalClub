<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationCategoryController extends Controller
{
    public function index()
    {
        $categories = DonationCategory::latest()->paginate(15);
        return view('admin.pages.donation-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.donation-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'status'      => 'required|in:active,disabled',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('donation-categories', 'public');
        }

        DonationCategory::create([
            'name'        => $request->name,
            'description' => $request->description,
            'image_path'  => $imagePath,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.donation-categories.index')
            ->with('success', 'Donation category created successfully.');
    }

    public function edit(DonationCategory $donationCategory)
    {
        return view('admin.pages.donation-categories.edit', compact('donationCategory'));
    }

    public function update(Request $request, DonationCategory $donationCategory)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'status'      => 'required|in:active,disabled',
        ]);

        $imagePath = $donationCategory->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('donation-categories', 'public');
        }

        $donationCategory->update([
            'name'        => $request->name,
            'description' => $request->description,
            'image_path'  => $imagePath,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.donation-categories.index')
            ->with('success', 'Donation category updated successfully.');
    }

    public function destroy(DonationCategory $donationCategory)
    {
        if ($donationCategory->image_path) {
            Storage::disk('public')->delete($donationCategory->image_path);
        }
        $donationCategory->delete();

        return redirect()->route('admin.donation-categories.index')
            ->with('success', 'Donation category deleted.');
    }
}
