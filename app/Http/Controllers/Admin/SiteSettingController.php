<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * Show the form for editing site settings
     */
    public function edit()
    {
        $settings = SiteSetting::getSettings();
        return view('admin.pages.settings.site', compact('settings'));
    }

    /**
     * Update site settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:1024',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'phone_secondary' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'total_members' => 'nullable|integer|min:0',
            'application_fee' => 'nullable|numeric|min:0',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'google_maps_url' => 'nullable|url|max:500',
            'footer_text' => 'nullable|string|max:1000',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        try {
            $settings = SiteSetting::getSettings();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($settings->logo && Storage::disk('public')->exists($settings->logo)) {
                    Storage::disk('public')->delete($settings->logo);
                }
                $validated['logo'] = $request->file('logo')->store('settings', 'public');
            } else {
                unset($validated['logo']);
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                // Delete old favicon if exists
                if ($settings->favicon && Storage::disk('public')->exists($settings->favicon)) {
                    Storage::disk('public')->delete($settings->favicon);
                }
                $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
            } else {
                unset($validated['favicon']);
            }

            $settings->update($validated);

            return redirect()
                ->route('admin.site-settings.edit')
                ->with('success', 'Site settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update settings: ' . $e->getMessage())
                ->withInput();
        }
    }
}
