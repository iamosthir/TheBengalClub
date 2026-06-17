<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HonoraryMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HonoraryMemberController extends Controller
{
    public function index()
    {
        $members = HonoraryMember::orderBy('order')->orderBy('id')->paginate(20);
        return view('admin.pages.honorary-members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.pages.honorary-members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'designation'   => 'nullable|array',
            'designation.*' => 'nullable|string|max:255',
            'bio'           => 'nullable|string',
            'photo'         => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order'         => 'nullable|integer|min:0',
        ]);

        // Filter out empty designation entries
        $validated['designation'] = array_values(array_filter($validated['designation'] ?? [], fn($d) => trim($d) !== ''));
        if (empty($validated['designation'])) {
            $validated['designation'] = null;
        }

        $validated['photo_path'] = $request->file('photo')->store('honorary-members', 'public');
        $validated['is_active']  = $request->has('is_active');
        $validated['order']      = $validated['order'] ?? 0;
        unset($validated['photo']);

        HonoraryMember::create($validated);

        return redirect()->route('admin.honorary-members.index')
            ->with('success', 'Honorary member added successfully.');
    }

    public function edit(HonoraryMember $honoraryMember)
    {
        return view('admin.pages.honorary-members.edit', compact('honoraryMember'));
    }

    public function update(Request $request, HonoraryMember $honoraryMember)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'designation'   => 'nullable|array',
            'designation.*' => 'nullable|string|max:255',
            'bio'           => 'nullable|string',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order'         => 'nullable|integer|min:0',
        ]);

        $validated['designation'] = array_values(array_filter($validated['designation'] ?? [], fn($d) => trim($d) !== ''));
        if (empty($validated['designation'])) {
            $validated['designation'] = null;
        }

        if ($request->hasFile('photo')) {
            if ($honoraryMember->photo_path) {
                Storage::disk('public')->delete($honoraryMember->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('honorary-members', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order']     = $validated['order'] ?? 0;
        unset($validated['photo']);

        $honoraryMember->update($validated);

        return redirect()->route('admin.honorary-members.index')
            ->with('success', 'Honorary member updated successfully.');
    }

    public function destroy(HonoraryMember $honoraryMember)
    {
        if ($honoraryMember->photo_path) {
            Storage::disk('public')->delete($honoraryMember->photo_path);
        }
        $honoraryMember->delete();

        return redirect()->route('admin.honorary-members.index')
            ->with('success', 'Honorary member deleted successfully.');
    }
}
