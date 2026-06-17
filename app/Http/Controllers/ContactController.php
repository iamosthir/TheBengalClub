<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Submit contact form
     */
    public function submit(Request $request)
    {
        // Get client IP address
        $ipAddress = $request->ip();

        // Check if user can send inquiry
        if (!Inquiry::canSendInquiry($ipAddress)) {
            $nextAvailable = Inquiry::getNextAvailableTime($ipAddress);

            return response()->json([
                'success' => false,
                'message' => "You've reached the inquiry limit. You can submit another inquiry {$nextAvailable}."
            ], 429);
        }

        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Create inquiry
            Inquiry::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'ip_address' => $ipAddress,
                'is_viewed' => false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you soon.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit inquiry. Please try again later.'
            ], 500);
        }
    }
}
