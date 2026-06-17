<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Request from The Bengal Club</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background-color: #1a1a2e; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; }
        .header p { color: #cccccc; margin: 5px 0 0; font-size: 14px; }
        .body { padding: 40px 30px; }
        .body p { color: #444444; font-size: 16px; line-height: 1.6; margin: 0 0 16px; }
        .amount-box { background: #f0f4ff; border: 2px dashed #3a5bd9; border-radius: 8px; padding: 20px; text-align: center; margin: 24px 0; }
        .amount-box .label { font-size: 13px; color: #666666; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .amount-box .amount { font-size: 36px; font-weight: bold; color: #1a1a2e; }
        .amount-box .purpose { font-size: 14px; color: #666666; margin-top: 8px; }
        .btn-wrapper { text-align: center; margin: 30px 0; }
        .btn { display: inline-block; background-color: #1a1a2e; color: #ffffff; text-decoration: none; padding: 14px 36px; border-radius: 6px; font-size: 16px; font-weight: bold; letter-spacing: 0.5px; }
        .link-fallback { word-break: break-all; font-size: 13px; color: #3a5bd9; }
        .footer { background-color: #f9f9f9; padding: 20px 30px; text-align: center; border-top: 1px solid #eeeeee; }
        .footer p { color: #aaaaaa; font-size: 13px; margin: 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>{{ $siteSetting?->site_name ?? 'The Bengal Club' }}</h1>
            <p>Payment Request</p>
        </div>
        <div class="body">
            <p>Dear {{ $paymentLink->name }},</p>
            <p>You have a payment request from <strong>{{ $siteSetting?->site_name ?? 'The Bengal Club' }}</strong>. Please review the details below and complete your payment securely online.</p>

            <div class="amount-box">
                <div class="label">Amount Due</div>
                <div class="amount">BDT {{ number_format($paymentLink->amount, 2) }}</div>
                @if($paymentLink->purpose)
                    <div class="purpose">{{ $paymentLink->purpose }}</div>
                @endif
            </div>

            <p>Click the button below to view payment instructions and submit your payment:</p>

            <div class="btn-wrapper">
                <a href="{{ route('payment-link.show', $paymentLink->token) }}" class="btn">Pay Now</a>
            </div>

            <p>If the button does not work, copy and paste this link into your browser:</p>
            <p class="link-fallback">{{ route('payment-link.show', $paymentLink->token) }}</p>

            <p>If you have any questions, please contact us.</p>

            <p>Warm regards,<br><strong>{{ $siteSetting?->site_name ?? 'The Bengal Club' }} Team</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $siteSetting?->site_name ?? 'The Bengal Club' }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
