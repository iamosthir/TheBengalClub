<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipCategory;
use Illuminate\Http\Request;

class MembershipCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MembershipCategory::latest()->paginate(10);
        return view('admin.pages.membership-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.membership-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'installment_price' => 'nullable|numeric|min:0',
            'bio' => 'nullable|string',
            'badge_text' => 'nullable|string|max:255',
            'duration' => 'required|in:Monthly,Yearly,Lifetime',
            'is_invite_only' => 'boolean',
            'optional_installment' => 'boolean',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:500',
        ]);

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty(trim($value));
            });
            $validated['features'] = array_values($validated['features']);
        }

        $validated['is_invite_only'] = $request->has('is_invite_only');
        $validated['optional_installment'] = $request->has('optional_installment');

        // Lifetime memberships have no recurring installments
        if ($validated['duration'] === 'Lifetime') {
            $validated['installment_price'] = 0;
        } else {
            $validated['installment_price'] = $validated['installment_price'] ?? 0;
        }

        MembershipCategory::create($validated);

        return redirect()->route('admin.membership-categories.index')
            ->with('success', 'Membership Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipCategory $membershipCategory)
    {
        return view('admin.pages.membership-categories.show', compact('membershipCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipCategory $membershipCategory)
    {
        return view('admin.pages.membership-categories.edit', compact('membershipCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MembershipCategory $membershipCategory)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'installment_price' => 'nullable|numeric|min:0',
            'bio' => 'nullable|string',
            'badge_text' => 'nullable|string|max:255',
            'duration' => 'required|in:Monthly,Yearly,Lifetime',
            'is_invite_only' => 'boolean',
            'optional_installment' => 'boolean',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:500',
        ]);

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty(trim($value));
            });
            $validated['features'] = array_values($validated['features']);
        }

        $validated['is_invite_only'] = $request->has('is_invite_only');
        $validated['optional_installment'] = $request->has('optional_installment');

        // Lifetime memberships have no recurring installments
        if ($validated['duration'] === 'Lifetime') {
            $validated['installment_price'] = 0;
        } else {
            $validated['installment_price'] = $validated['installment_price'] ?? 0;
        }

        $membershipCategory->update($validated);

        return redirect()->route('admin.membership-categories.index')
            ->with('success', 'Membership Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipCategory $membershipCategory)
    {
        $membershipCategory->delete();

        return redirect()->route('admin.membership-categories.index')
            ->with('success', 'Membership Category deleted successfully.');
    }
}
