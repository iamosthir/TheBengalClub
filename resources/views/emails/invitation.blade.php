<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Are Invited to The Bengal Club</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background-color: #1a1a2e; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; }
        .header p { color: #cccccc; margin: 5px 0 0; font-size: 14px; }
        .body { padding: 40px 30px; }
        .body p { color: #444444; font-size: 16px; line-height: 1.6; margin: 0 0 16px; }
        .invite-box { background: #f0f4ff; border: 2px dashed #3a5bd9; border-radius: 8px; padding: 20px; text-align: center; margin: 24px 0; }
        .invite-box .label { font-size: 13px; color: #666666; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .invite-box .code { font-size: 36px; font-weight: bold; color: #1a1a2e; letter-spacing: 6px; }
        .details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .details-table td { padding: 10px 12px; border-bottom: 1px solid #eeeeee; font-size: 15px; color: #444444; }
        .details-table td:first-child { font-weight: bold; color: #222222; width: 45%; }
        .btn-wrapper { text-align: center; margin: 30px 0; }
        .btn { display: inline-block; background-color: #1a1a2e; color: #ffffff; text-decoration: none; padding: 14px 36px; border-radius: 6px; font-size: 16px; font-weight: bold; letter-spacing: 0.5px; }
        .footer { background-color: #f9f9f9; padding: 20px 30px; text-align: center; border-top: 1px solid #eeeeee; }
        .footer p { color: #aaaaaa; font-size: 13px; margin: 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>The Bengal Club</h1>
            <p>An exclusive invitation for you</p>
        </div>
        <div class="body">
            <p>Dear Invitee,</p>
            <p>We are pleased to inform you that you have been invited to join <strong>The Bengal Club</strong> as a member. Please find your invitation details below.</p>

            <table class="details-table">
                <tr>
                    <td>Membership Category</td>
                    <td>{{ $invitation->membershipCategory->title }}</td>
                </tr>
                <tr>
                    <td>Application Fee</td>
                    <td>BDT {{ number_format($invitation->application_fee, 2) }}</td>
                </tr>
                <tr>
                    <td>Invited Email</td>
                    <td>{{ $invitation->email }}</td>
                </tr>
            </table>

            <div class="invite-box">
                <div class="label">Your Invitation ID</div>
                <div class="code">{{ $invitation->invite_id }}</div>
            </div>

            <p>To apply for membership, click the button below and use your invitation ID during the application process.</p>

            <div class="btn-wrapper">
                <a href="{{ url('/invites/' . $invitation->invite_id) }}" class="btn">Apply Now</a>
            </div>

            <p>If you did not expect this invitation or have any questions, please disregard this email or contact us at <a href="mailto:info@thebengal.club">info@thebengal.club</a>.</p>

            <p>Warm regards,<br><strong>The Bengal Club Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} The Bengal Club. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
