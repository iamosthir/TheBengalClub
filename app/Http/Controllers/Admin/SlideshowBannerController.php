<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideshowBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideshowBannerController extends Controller
{
    public function index()
    {
        $banners = SlideshowBanner::orderBy('order')->get();
        return view('admin.pages.slideshow-banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.slideshow-banner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'extra_text' => 'nullable|string',
            'enable_action_button' => 'nullable',
            'button_text' => 'nullable|string|max:255',
            'action_link' => 'nullable|url|max:255',
            'order' => 'required|integer|min:0',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slideshow-banners', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['enable_action_button'] = $request->has('enable_action_button');

        SlideshowBanner::create($validated);

        return redirect()->route('admin.slideshow-banner.index')
            ->with('success', 'Slideshow banner created successfully.');
    }

    public function show(string $id)
    {
        $banner = SlideshowBanner::findOrFail($id);
        return view('admin.pages.slideshow-banner.show', compact('banner'));
    }

    public function edit(string $id)
    {
        $banner = SlideshowBanner::findOrFail($id);
        return view('admin.pages.slideshow-banner.edit', compact('banner'));
    }

    public function update(Request $request, string $id)
    {
        $banner = SlideshowBanner::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'extra_text' => 'nullable|string',
            'enable_action_button' => 'nullable',
            'button_text' => 'nullable|string|max:255',
            'action_link' => 'nullable|url|max:255',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $imagePath = $request->file('image')->store('slideshow-banners', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['enable_action_button'] = $request->has('enable_action_button');

        $banner->update($validated);

        return redirect()->route('admin.slideshow-banner.index')
            ->with('success', 'Slideshow banner updated successfully.');
    }

    public function destroy(string $id)
    {
        $banner = SlideshowBanner::findOrFail($id);

        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('admin.slideshow-banner.index')
            ->with('success', 'Slideshow banner deleted successfully.');
    }
}
