<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    public function edit()
    {
        $visionMission = VisionMission::firstOrFail();

        return view('admin.pages.vision-mission.edit', compact('visionMission'));
    }

    public function update(Request $request)
    {
        $visionMission = VisionMission::firstOrFail();

        $validated = $request->validate([
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
        ]);

        $visionMission->update($validated);

        return redirect()->route('admin.vision-mission.edit')
            ->with('success', 'Vision & Mission updated successfully.');
    }
}
