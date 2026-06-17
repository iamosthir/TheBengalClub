<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if (! $event->status) {
            abort(404);
        }

        $isMember = Auth::check();

        // Prevent duplicate registration
        $existingQuery = EventRegistration::where('event_id', $event->id)
            ->whereNotIn('status', ['cancelled']);

        if ($isMember) {
            $existingQuery->where('user_id', Auth::id());
        } else {
            $existingQuery->where('email', $request->input('email'));
        }

        if ($existingQuery->exists()) {
            return back()->with('error', 'You have already registered for this event.');
        }

        if ($isMember) {
            $user = Auth::user();
            $rules = [
                'payment_method_id' => $event->is_free ? 'nullable' : 'required|exists:payment_methods,id',
                'transaction_id'    => $event->is_free ? 'nullable|string|max:255' : 'nullable|string|max:255',
                'payment_proof'     => $event->is_free ? 'nullable' : 'required|image|mimes:jpeg,jpg,png|max:5120',
            ];

            $validated = $request->validate($rules);

            $registrationData = [
                'event_id'          => $event->id,
                'user_id'           => $user->id,
                'is_member'         => true,
                'full_name'         => $user->name,
                'email'             => $user->email,
                'phone'             => $user->userProfile->phone ?? null,
                'address'           => $user->userProfile->address ?? null,
                'payment_method_id' => $validated['payment_method_id'] ?? null,
                'transaction_id'    => $validated['transaction_id'] ?? null,
                'status'            => 'pending',
            ];
        } else {
            $rules = [
                'full_name'         => 'required|string|max:255',
                'email'             => 'required|email|max:255',
                'phone'             => 'required|string|max:20',
                'address'           => 'required|string|max:500',
                'payment_method_id' => $event->is_free ? 'nullable' : 'required|exists:payment_methods,id',
                'transaction_id'    => 'nullable|string|max:255',
                'payment_proof'     => $event->is_free ? 'nullable' : 'required|image|mimes:jpeg,jpg,png|max:5120',
            ];

            $validated = $request->validate($rules);

            $registrationData = [
                'event_id'          => $event->id,
                'user_id'           => null,
                'is_member'         => false,
                'full_name'         => $validated['full_name'],
                'email'             => $validated['email'],
                'phone'             => $validated['phone'],
                'address'           => $validated['address'],
                'payment_method_id' => $validated['payment_method_id'] ?? null,
                'transaction_id'    => $validated['transaction_id'] ?? null,
                'status'            => 'pending',
            ];
        }

        // Upload payment proof
        if (! $event->is_free && $request->hasFile('payment_proof')) {
            $registrationData['payment_proof_path'] = $request->file('payment_proof')
                ->store('event-registrations/payment-proofs', 'public');
        }

        EventRegistration::create($registrationData);

        return back()->with('success', 'Your registration has been submitted. You will receive a confirmation email once approved.');
    }
}
