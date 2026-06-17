<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received</title>
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
        .email-header img {
            max-width: 80px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        .email-header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .email-body {
            padding: 30px 25px;
        }
        .email-body h2 {
            color: #0f70bf;
            margin-top: 0;
            font-size: 20px;
        }
        .email-body p {
            margin: 12px 0;
            font-size: 15px;
            color: #444;
        }
        .application-id-box {
            background-color: #f0f7ff;
            border: 2px solid #0f70bf;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .application-id-box .label {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }
        .application-id-box .id-value {
            font-size: 28px;
            font-weight: bold;
            color: #0f70bf;
        }
        .details-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .details-box h3 {
            margin-top: 0;
            color: #0f70bf;
            font-size: 16px;
        }
        .details-box table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-box td {
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
        }
        .details-box td:first-child {
            font-weight: bold;
            color: #666;
            width: 40%;
        }
        .details-box tr:last-child td {
            border-bottom: none;
        }
        .button {
            display: inline-block;
            padding: 14px 35px;
            background-color: #0f70bf;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
        }
        .info-note {
            background-color: #e8f4fd;
            border-left: 4px solid #0f70bf;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #555;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #888;
            font-size: 13px;
        }
        .email-footer a {
            color: #0f70bf;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            @if($settings->logo)
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name }}">
            @endif
            <h1>Application Received</h1>
            <p>Thank you for applying to {{ $settings->site_name ?? 'The Bengal Club' }}</p>
        </div>

        <div class="email-body">
            <h2>Dear {{ $application->name }},</h2>

            <p>We are pleased to confirm that we have received your membership application. Our team will carefully review your application and get back to you shortly.</p>

            <div class="application-id-box">
                <div class="label">Your Application ID</div>
                <div class="id-value">#{{ $application->id }}</div>
            </div>

            <div class="details-box">
                <h3>Application Summary</h3>
                <table>
                    <tr>
                        <td>Full Name</td>
                        <td>{{ $application->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $application->email }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $application->mobile }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{ $application->membershipCategory->title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Submitted On</td>
                        <td>{{ $application->created_at->format('F j, Y \a\t h:i A') }}</td>
                    </tr>
                </table>
            </div>

            <center>
                <a href="{{ $pdfUrl }}" class="button">Download Application Form (PDF)</a>
            </center>

            <div class="info-note">
                <strong>What happens next?</strong><br>
                Our membership committee will review your application. You will receive an email notification once a decision has been made. This process typically takes a few business days.
            </div>

            <p>If you have any questions in the meantime, feel free to reach out to us:</p>
            <ul style="color: #555; font-size: 14px;">
                @if($settings->email)
                    <li>Email: {{ $settings->email }}</li>
                @endif
                @if($settings->phone)
                    <li>Phone: {{ $settings->phone }}</li>
                @endif
            </ul>

            <p style="margin-top: 25px;">
                Warm regards,<br>
                <strong>{{ $settings->site_name ?? 'The Bengal Club' }} Team</strong>
            </p>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'The Bengal Club' }}. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
