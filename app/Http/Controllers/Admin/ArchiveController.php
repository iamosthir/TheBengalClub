<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index()
    {
        $archives = Archive::orderBy('order')->get();

        return view('admin.pages.archive.index', compact('archives'));
    }

    public function create()
    {
        return view('admin.pages.archive.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('archives', 'public');
        $validated['image_path'] = $imagePath;

        Archive::create($validated);

        return redirect()->route('admin.archive.index')
            ->with('success', 'Archive item created successfully.');
    }

    public function edit(string $id)
    {
        $archive = Archive::findOrFail($id);

        return view('admin.pages.archive.edit', compact('archive'));
    }

    public function update(Request $request, string $id)
    {
        $archive = Archive::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($archive->image_path);
            $validated['image_path'] = $request->file('image')->store('archives', 'public');
        }

        $archive->update($validated);

        return redirect()->route('admin.archive.index')
            ->with('success', 'Archive item updated successfully.');
    }

    public function destroy(string $id)
    {
        $archive = Archive::findOrFail($id);

        Storage::disk('public')->delete($archive->image_path);
        $archive->delete();

        return redirect()->route('admin.archive.index')
            ->with('success', 'Archive item deleted successfully.');
    }
}
