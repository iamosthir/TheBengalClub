<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::latest()->paginate(10);
        return view('admin.pages.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tag_line' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('facilities', 'public');
        }

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty(trim($value));
            });
            $validated['features'] = array_values($validated['features']); // Re-index array
        }

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        return view('admin.pages.facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return view('admin.pages.facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tag_line' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($facility->image_path) {
                Storage::disk('public')->delete($facility->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('facilities', 'public');
        }

        // Filter out empty features
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], function($value) {
                return !empty(trim($value));
            });
            $validated['features'] = array_values($validated['features']); // Re-index array
        }

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        // Delete image if exists
        if ($facility->image_path) {
            Storage::disk('public')->delete($facility->image_path);
        }

        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }
}
