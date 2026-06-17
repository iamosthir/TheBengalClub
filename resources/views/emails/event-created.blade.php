<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Event Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .event-thumbnail {
            width: 100%;
            max-width: 500px;
            height: auto;
            margin: 20px 0;
            border-radius: 5px;
        }
        .event-details {
            margin: 20px 0;
        }
        .event-details p {
            margin: 10px 0;
        }
        .event-details strong {
            color: #343a40;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bengal Club</h1>
        <p>New Event Announcement</p>
    </div>

    <div class="content">
        <h2>Hello {{ $user->name }},</h2>

        <p>We're excited to announce a new event at Bengal Club!</p>

        @if($event->thumbnail_path)
            <img src="{{ asset('storage/' . $event->thumbnail_path) }}"
                 alt="{{ $event->title }}"
                 class="event-thumbnail">
        @endif

        <div class="event-details">
            <h3>{{ $event->title }}</h3>

            <p><strong>Date:</strong> {{ $event->date->format('l, F j, Y') }}</p>

            <p><strong>Venue:</strong> {{ $event->venue }}</p>

            <p><strong>Description:</strong></p>
            <div>
                {{ Str::limit(strip_tags($event->description), 200) }}
            </div>
        </div>

        <a href="{{ route('admin.events.show', $event->id) }}" class="btn">
            View Full Event Details
        </a>

        <p>We look forward to seeing you there!</p>

        <p>Best regards,<br>
        Bengal Club Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Bengal Club. All rights reserved.</p>
    </div>
</body>
</html>
