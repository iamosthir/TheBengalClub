<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Jobs\SendEventNotificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest('date')->paginate(10);
        return view('admin.pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isFree = $request->has('is_free');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'fee' => $isFree ? 'nullable' : 'required|numeric|min:0',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('events/thumbnails', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('events/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // Handle status and fee checkboxes
        $validated['status'] = $request->has('status');
        $validated['is_free'] = $isFree;
        $validated['fee'] = $isFree ? null : $validated['fee'];

        // Create event
        $event = Event::create($validated);

        // Queue email notification if requested
        if ($request->has('notify_members')) {
            SendEventNotificationEmail::dispatch($event);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('admin.pages.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.pages.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $isFree = $request->has('is_free');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'fee' => $isFree ? 'nullable' : 'required|numeric|min:0',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($event->thumbnail_path) {
                Storage::disk('public')->delete($event->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('events/thumbnails', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images if exists
            if ($event->gallery_images) {
                foreach ($event->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $image->store('events/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryPaths;
        }

        // Handle status and fee checkboxes
        $validated['status'] = $request->has('status');
        $validated['is_free'] = $isFree;
        $validated['fee'] = $isFree ? null : $validated['fee'];

        // Update event
        $event->update($validated);

        // Queue email notification if requested
        if ($request->has('notify_members')) {
            SendEventNotificationEmail::dispatch($event);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete thumbnail if exists
        if ($event->thumbnail_path) {
            Storage::disk('public')->delete($event->thumbnail_path);
        }

        // Delete gallery images if exists
        if ($event->gallery_images) {
            foreach ($event->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
