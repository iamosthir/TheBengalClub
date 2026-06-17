<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
use App\Mail\EventCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEventNotificationEmail implements ShouldQueue
{
    use Queueable;

    public $event;

    /**
     * Create a new job instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get all users with email addresses
        $users = User::whereNotNull('email')->get();

        // Send email to each user
        foreach ($users as $user) {
            Mail::to($user->email)->send(new EventCreatedMail($this->event, $user));
        }
    }
}
