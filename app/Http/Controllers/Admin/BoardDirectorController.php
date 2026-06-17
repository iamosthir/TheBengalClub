<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardDirectorController extends Controller
{
    public function index()
    {
        $directors = BoardDirector::orderBy('order')->get();

        return view('admin.pages.board-directors.index', compact('directors'));
    }

    public function create()
    {
        return view('admin.pages.board-directors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'order' => 'required|integer|min:0',
            'status' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string',
            'social_links.*.url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('directors', 'public');
            $validated['photo_path'] = $photoPath;
        }

        $validated['status'] = $request->has('status');

        BoardDirector::create($validated);

        return redirect()->route('admin.board-directors.index')
            ->with('success', 'Board director created successfully.');
    }

    public function show(string $id)
    {
        $director = BoardDirector::findOrFail($id);

        return view('admin.pages.board-directors.show', compact('director'));
    }

    public function edit(string $id)
    {
        $director = BoardDirector::findOrFail($id);

        return view('admin.pages.board-directors.edit', compact('director'));
    }

    public function update(Request $request, string $id)
    {
        $director = BoardDirector::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'order' => 'required|integer|min:0',
            'status' => 'boolean',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string',
            'social_links.*.url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            if ($director->photo_path) {
                Storage::disk('public')->delete($director->photo_path);
            }
            $photoPath = $request->file('photo')->store('directors', 'public');
            $validated['photo_path'] = $photoPath;
        }

        $validated['status'] = $request->has('status');

        $director->update($validated);

        return redirect()->route('admin.board-directors.index')
            ->with('success', 'Board director updated successfully.');
    }

    public function destroy(string $id)
    {
        $director = BoardDirector::findOrFail($id);

        if ($director->photo_path) {
            Storage::disk('public')->delete($director->photo_path);
        }

        $director->delete();

        return redirect()->route('admin.board-directors.index')
            ->with('success', 'Board director deleted successfully.');
    }
}
