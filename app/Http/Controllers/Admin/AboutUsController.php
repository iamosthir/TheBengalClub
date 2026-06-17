<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function edit()
    {
        $aboutUs = AboutUs::firstOrFail();

        return view('admin.pages.about-us.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $aboutUs = AboutUs::firstOrFail();

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($aboutUs->image_path) {
                Storage::disk('public')->delete($aboutUs->image_path);
            }
            $imagePath = $request->file('image')->store('about-us', 'public');
            $validated['image_path'] = $imagePath;
        }

        $aboutUs->update($validated);

        return redirect()->route('admin.about-us.edit')
            ->with('success', 'About Us content updated successfully.');
    }
}
