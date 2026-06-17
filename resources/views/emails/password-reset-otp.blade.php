<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
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
        .otp-box {
            background-color: #f8f9fa;
            border: 2px solid #0f70bf;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
            color: #0f70bf;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .important-note {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Password Reset Request</h1>
            <p style="margin: 5px 0 0 0;">Your One-Time Password (OTP)</p>
        </div>

        <div class="email-body">
            <h2>Password Reset OTP</h2>

            <p>You have requested to reset your password. Please use the following OTP to proceed:</p>

            <div class="otp-box">
                <p style="margin: 0; color: #666;">Your OTP Code</p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="margin: 0; color: #666; font-size: 14px;">This code expires in 10 minutes</p>
            </div>

            <div class="important-note">
                <strong>Security Notice:</strong><br>
                If you did not request a password reset, please ignore this email. Your account is safe.
            </div>

            <p>
                Best regards,<br>
                <strong>The Bengal Club Team</strong>
            </p>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} The Bengal Club. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
