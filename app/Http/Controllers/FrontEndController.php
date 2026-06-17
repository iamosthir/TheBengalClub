<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Archive;
use App\Models\BoardDirector;
use App\Models\Event;
use App\Models\Facility;
use App\Models\MembershipCategory;
use App\Models\SlideshowBanner;
use App\Models\VisionMission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    public function index()
    {
        $banners = SlideshowBanner::orderBy('order')->get();
        $directors = BoardDirector::where('status', true)->orderBy('order')->get();
        $aboutUs = AboutUs::first();
        $archives = Archive::orderBy('order')->get();
        $facilities = Facility::all();
        $membershipCategories = MembershipCategory::all();
        $visionMission = VisionMission::first();

        // Get events: upcoming first (max 6), then fill with past events if needed
        $today = Carbon::today();

        // Get upcoming events (active and date >= today)
        $upcomingEvents = Event::where('status', true)
            ->where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->get();

        // If we have less than 6 upcoming events, get past events to fill
        $eventsToShow = $upcomingEvents;
        if ($upcomingEvents->count() < 6) {
            $remaining = 6 - $upcomingEvents->count();
            $pastEvents = Event::where('status', true)
                ->where('date', '<', $today)
                ->orderBy('date', 'desc')
                ->take($remaining)
                ->get();

            $eventsToShow = $upcomingEvents->concat($pastEvents);
        }

        // Limit to 6 events total
        $events = $eventsToShow->take(6);

        return view('frontend.pages.index', compact('banners', 'directors', 'aboutUs', 'facilities', 'membershipCategories', 'visionMission', 'events', 'archives'));
    }

    public function eventDetails(Event $event)
    {
        // Only show active events
        if (!$event->status) {
            abort(404);
        }

        return view('frontend.pages.event-details', compact('event'));
    }

    public function certification()
    {
        return view('frontend.pages.certification');
    }

    public function showCertificatePdf()
    {
        $pdfPath = public_path('pdf/certificate.pdf');

        if (!file_exists($pdfPath)) {
            abort(404, 'Certificate PDF not found');
        }

        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="certificate.pdf"'
        ]);
    }
}
