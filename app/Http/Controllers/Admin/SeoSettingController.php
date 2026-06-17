<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoSettingController extends Controller
{
    /**
     * Show the form for editing SEO settings
     */
    public function edit()
    {
        $settings = SeoSetting::getSettings();
        return view('admin.pages.settings.seo', compact('settings'));
    }

    /**
     * Update SEO settings
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_author' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'og_url' => 'nullable|url|max:255',
            'og_type' => 'nullable|string|max:50',
            'og_site_name' => 'nullable|string|max:255',
            'fb_app_id' => 'nullable|string|max:50',
            'twitter_card' => 'nullable|string|max:50',
            'twitter_site' => 'nullable|string|max:50',
            'twitter_creator' => 'nullable|string|max:50',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:500',
            'twitter_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_site_verification' => 'nullable|string|max:255',
            'facebook_pixel_id' => 'nullable|string|max:50',
            'custom_head_code' => 'nullable|string',
            'custom_body_code' => 'nullable|string',
            'index_page' => 'nullable|boolean',
        ]);

        try {
            $settings = SeoSetting::getSettings();

            // Handle OG image upload
            if ($request->hasFile('og_image')) {
                // Delete old image if exists
                if ($settings->og_image && Storage::disk('public')->exists($settings->og_image)) {
                    Storage::disk('public')->delete($settings->og_image);
                }
                $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
            } else {
                unset($validated['og_image']);
            }

            // Handle Twitter image upload
            if ($request->hasFile('twitter_image')) {
                // Delete old image if exists
                if ($settings->twitter_image && Storage::disk('public')->exists($settings->twitter_image)) {
                    Storage::disk('public')->delete($settings->twitter_image);
                }
                $validated['twitter_image'] = $request->file('twitter_image')->store('seo', 'public');
            } else {
                unset($validated['twitter_image']);
            }

            // Handle checkbox
            $validated['index_page'] = $request->has('index_page');

            $settings->update($validated);

            return redirect()
                ->route('admin.seo-settings.edit')
                ->with('success', 'SEO settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to update settings: ' . $e->getMessage())
                ->withInput();
        }
    }
}
