<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #0f70bf, #0a5a9c);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px 20px;
        }
        .email-body h2 {
            color: #0f70bf;
            margin-top: 0;
        }
        .credentials-box {
            background-color: #f8f9fa;
            border: 2px solid #0f70bf;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .credentials-box h3 {
            color: #0f70bf;
            margin-top: 0;
        }
        .credential-item {
            margin: 10px 0;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 4px;
        }
        .credential-label {
            font-weight: bold;
            color: #666;
            display: block;
            margin-bottom: 5px;
        }
        .credential-value {
            font-size: 18px;
            color: #0f70bf;
            font-weight: bold;
        }
        .membership-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .membership-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .membership-details td {
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .membership-details td:first-child {
            font-weight: bold;
            color: #666;
            width: 40%;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #0f70bf;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .important-note {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🎉 Congratulations!</h1>
            <p style="margin: 5px 0 0 0;">Your Membership Application Has Been Approved</p>
        </div>

        <div class="email-body">
            <h2>Dear {{ $application->name }},</h2>

            <p>We are delighted to inform you that your membership application to <strong>The Bengal Club</strong> has been approved! Welcome to our distinguished community.</p>

            <div class="credentials-box">
                <h3>Your Login Credentials</h3>
                <p>You can now access your member account using the following credentials:</p>

                <div class="credential-item">
                    <span class="credential-label">Member ID (Email):</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>

                <div class="credential-item">
                    <span class="credential-label">Password:</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>

            <div class="important-note">
                <strong>⚠️ Important Security Note:</strong><br>
                For your security, please change your password after your first login. Keep your credentials confidential and do not share them with anyone.
            </div>

            <div class="membership-details">
                <h3 style="margin-top: 0; color: #0f70bf;">Your Membership Details</h3>
                <table>
                    <tr>
                        <td>Membership Category:</td>
                        <td><strong>{{ $application->membershipCategory->title }}</strong></td>
                    </tr>
                    <tr>
                        <td>Membership Duration:</td>
                        <td><strong>{{ $application->membershipCategory->duration }}</strong></td>
                    </tr>
                    <tr>
                        <td>Membership Fee:</td>
                        <td><strong>৳{{ number_format($application->membershipCategory->price, 2) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Application Date:</td>
                        <td><strong>{{ $application->created_at->format('F j, Y') }}</strong></td>
                    </tr>
                    <tr style="border-bottom: none;">
                        <td>Approval Date:</td>
                        <td><strong>{{ now()->format('F j, Y') }}</strong></td>
                    </tr>
                </table>
            </div>

            <center>
                <a href="{{ url('/member/login') }}" class="button">Access Member Portal</a>
            </center>

            <h3 style="color: #0f70bf;">Next Steps:</h3>
            <ol>
                <li>Log in to your member account using the credentials provided above</li>
                <li>Complete your profile if needed</li>
                <li>Review your membership benefits and privileges</li>
                <li>Contact us if you have any questions or need assistance</li>
            </ol>

            <p>We look forward to serving you and providing you with an exceptional membership experience at The Bengal Club.</p>

            <p>If you have any questions or need assistance, please don't hesitate to contact us:</p>
            <ul>
                <li>Email: membership@thebengal.club</li>
                <li>Phone: +880 1234-567890</li>
            </ul>

            <p style="margin-top: 30px;">
                Best regards,<br>
                <strong>The Bengal Club Team</strong>
            </p>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} The Bengal Club. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
