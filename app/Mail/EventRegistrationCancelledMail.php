<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegistrationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public EventRegistration $registration;

    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Event Registration Cancelled: ' . $this->registration->event->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.event-registration-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
