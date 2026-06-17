<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #1a7a4a; color: #fff; padding: 24px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0 0 4px; font-size: 24px; }
        .header p { margin: 0; opacity: 0.85; }
        .content { background-color: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; }
        .invitation-badge {
            background: #dcfce7; border: 2px solid #16a34a; border-radius: 10px;
            padding: 16px 20px; text-align: center; margin: 20px 0;
        }
        .invitation-badge .icon { font-size: 36px; margin-bottom: 8px; }
        .invitation-badge h2 { color: #166534; margin: 0 0 4px; }
        .invitation-badge p { color: #15803d; margin: 0; }
        .event-details { background: #f8fafc; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .event-details h3 { margin: 0 0 14px; color: #111827; font-size: 18px; }
        .detail-row { display: flex; margin-bottom: 10px; }
        .detail-label { font-weight: bold; color: #374151; min-width: 100px; }
        .detail-value { color: #4b5563; }
        .event-thumbnail { width: 100%; max-width: 500px; height: auto; margin: 16px 0; border-radius: 8px; }
        .footer { text-align: center; padding: 20px; color: #777; font-size: 13px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bengal Club</h1>
        <p>Event Registration Confirmation</p>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $registration->full_name }}</strong>,</p>

        <div class="invitation-badge">
            <div class="icon">🎉</div>
            <h2>You're Invited!</h2>
            <p>Your registration has been approved.</p>
        </div>

        <p>We are pleased to confirm your registration for the following event:</p>

        @if($registration->event->thumbnail_path)
            <img src="{{ asset('storage/' . $registration->event->thumbnail_path) }}"
                 alt="{{ $registration->event->title }}"
                 class="event-thumbnail">
        @endif

        <div class="event-details">
            <h3>{{ $registration->event->title }}</h3>
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span class="detail-value">{{ $registration->event->date->format('l, F j, Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Venue:</span>
                <span class="detail-value">{{ $registration->event->venue }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Entry:</span>
                <span class="detail-value">
                    {{ $registration->event->is_free ? 'Free' : 'BDT ' . number_format($registration->event->fee, 2) }}
                </span>
            </div>
        </div>

        <p>We look forward to seeing you at the event. Please keep this email as your invitation confirmation.</p>

        <p>Best regards,<br><strong>Bengal Club Team</strong></p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Bengal Club. All rights reserved.</p>
    </div>
</body>
</html>
