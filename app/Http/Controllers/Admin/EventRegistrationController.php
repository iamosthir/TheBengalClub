<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EventRegistrationApprovedMail;
use App\Mail\EventRegistrationCancelledMail;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventRegistrationController extends Controller
{
    public function index(Event $event)
    {
        $registrations = $event->registrations()
            ->with(['user', 'paymentMethod'])
            ->latest()
            ->paginate(20);

        $counts = [
            'pending'   => $event->registrations()->where('status', 'pending')->count(),
            'approved'  => $event->registrations()->where('status', 'approved')->count(),
            'cancelled' => $event->registrations()->where('status', 'cancelled')->count(),
        ];

        return view('admin.pages.event-registrations.index', compact('event', 'registrations', 'counts'));
    }

    public function show(Event $event, EventRegistration $registration)
    {
        $registration->load(['user', 'paymentMethod']);
        return view('admin.pages.event-registrations.show', compact('event', 'registration'));
    }

    public function approve(Event $event, EventRegistration $registration)
    {
        $registration->update(['status' => 'approved']);

        Mail::to($registration->email)->send(new EventRegistrationApprovedMail($registration));

        return back()->with('success', 'Registration approved and invitation email sent.');
    }

    public function cancel(Request $request, Event $event, EventRegistration $registration)
    {
        $request->validate([
            'note' => 'nullable|string|max:1000',
        ]);

        $registration->update([
            'status' => 'cancelled',
            'note'   => $request->note,
        ]);

        Mail::to($registration->email)->send(new EventRegistrationCancelledMail($registration));

        return back()->with('success', 'Registration cancelled and notification email sent.');
    }
}
