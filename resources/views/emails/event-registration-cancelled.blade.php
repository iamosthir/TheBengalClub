<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Cancelled</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #343a40; color: #fff; padding: 24px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0 0 4px; font-size: 24px; }
        .header p { margin: 0; opacity: 0.85; }
        .content { background-color: #fff; padding: 30px; border: 1px solid #ddd; border-top: none; }
        .cancelled-badge {
            background: #fee2e2; border: 2px solid #dc2626; border-radius: 10px;
            padding: 16px 20px; text-align: center; margin: 20px 0;
        }
        .cancelled-badge h2 { color: #991b1b; margin: 0 0 4px; }
        .cancelled-badge p { color: #b91c1c; margin: 0; }
        .event-details { background: #f8fafc; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .event-details h3 { margin: 0 0 14px; color: #111827; font-size: 18px; }
        .detail-row { display: flex; margin-bottom: 10px; }
        .detail-label { font-weight: bold; color: #374151; min-width: 100px; }
        .detail-value { color: #4b5563; }
        .note-box { background: #fff7ed; border-left: 4px solid #f59e0b; padding: 12px 16px; border-radius: 4px; margin: 16px 0; }
        .footer { text-align: center; padding: 20px; color: #777; font-size: 13px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bengal Club</h1>
        <p>Event Registration Update</p>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $registration->full_name }}</strong>,</p>

        <div class="cancelled-badge">
            <h2>Registration Cancelled</h2>
            <p>Your event registration has been cancelled.</p>
        </div>

        <p>We regret to inform you that your registration for the following event has been cancelled:</p>

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
        </div>

        @if($registration->note)
            <div class="note-box">
                <strong>Reason:</strong> {{ $registration->note }}
            </div>
        @endif

        <p>If you have any questions or believe this was done in error, please contact us.</p>

        <p>Best regards,<br><strong>Bengal Club Team</strong></p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Bengal Club. All rights reserved.</p>
    </div>
</body>
</html>
