<?php

namespace App\Mail;

use App\Models\MembershipApplication;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $settings;
    public $pdfUrl;

    public function __construct(MembershipApplication $application, string $pdfUrl)
    {
        $this->application = $application;
        $this->settings = SiteSetting::getSettings();
        $this->pdfUrl = $pdfUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Received - ' . ($this->settings->site_name ?? 'The Bengal Club'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-received',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
