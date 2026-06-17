<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tan Samiti Agreement — {{ $tanSamiti->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #000;
            line-height: 1.5;
            padding: 20px 30px;
        }

        .form-title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .form-subtitle {
            text-align: center;
            font-size: 10px;
            color: #444;
            margin-bottom: 6px;
        }

        .header { text-align: center; margin-bottom: 4px; }
        .header-logo { width: 60px; height: auto; }
        .header-divider {
            border: none;
            border-top: 2px solid #000;
            margin: 6px 0 8px;
        }

        .meta-box {
            border: 1px solid #ccc;
            background: #f9f9f9;
            padding: 6px 10px;
            margin-bottom: 10px;
            font-size: 9px;
            line-height: 1.7;
        }
        .meta-box strong { font-weight: bold; }

        .section-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e8e8e8;
            padding: 4px 8px;
            border: 1px solid #000;
            border-bottom: none;
            margin-top: 12px;
            letter-spacing: 0.5px;
        }

        .clause-table {
            width: 100%;
            border-collapse: collapse;
        }
        .clause-table tr td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            vertical-align: top;
            font-size: 9.5px;
            line-height: 1.5;
        }
        .clause-table tr td:first-child {
            font-weight: bold;
            background: #f5f5f5;
            width: 28%;
        }

        .sign-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }
        .sign-table td {
            width: 50%;
            padding: 6px 10px;
            vertical-align: top;
            font-size: 9px;
            border: 1px solid #ccc;
        }
        .sign-line {
            border-bottom: 1px solid #000;
            height: 16px;
            margin-top: 4px;
            margin-bottom: 2px;
        }
        .sign-label { font-size: 8px; color: #555; }

        .footer {
            margin-top: 14px;
            text-align: center;
            font-size: 7px;
            color: #999;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }

        .accepted-box {
            border: 1.5px solid #2a7a2a;
            background: #f0fff0;
            padding: 5px 8px;
            margin-top: 10px;
            font-size: 9px;
            color: #2a7a2a;
        }
        .accepted-box strong { font-weight: bold; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        @if($settings->logo)
            <img src="{{ public_path('storage/' . $settings->logo) }}" class="header-logo" alt="Logo">
        @endif
    </div>

    <div class="form-title">Investment Plan — Legal Membership Agreement</div>
    <div class="form-subtitle">আইনি সদস্য চুক্তিপত্র</div>

    <hr class="header-divider">

    {{-- Meta info --}}
    <div class="meta-box">
        <strong>Samiti:</strong> {{ $tanSamiti->name }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Monthly Amount:</strong> BDT {{ number_format($tanSamiti->monthly_amount, 2) }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Total Cycles:</strong> {{ $tanSamiti->total_cycles }}
        <br>
        <strong>Member Name:</strong> {{ $member->name }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Member ID:</strong> #{{ $member->id }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>NID / Passport:</strong> {{ $member->profile?->nid_passport ?? '—' }}
        <br>
        <strong>Mobile:</strong> {{ $member->profile?->mobile ?? '—' }}
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>Joined:</strong> {{ $membership->joined_at ? $membership->joined_at->format('d M, Y') : now()->format('d M, Y') }}
    </div>

    {{-- Agreement Clauses --}}
    <div class="section-title">Agreement Terms / চুক্তির শর্তাবলী</div>

    <table class="clause-table">
        <tr>
            <td>১. পরিচিতি<br><em>Introduction</em></td>
            <td>
                এই চুক্তি The Bengal Club এবং সদস্যের মধ্যে সম্পাদিত।<br>
                <em>This agreement is made between The Bengal Club and the member.</em>
            </td>
        </tr>
        <tr>
            <td>২. সদস্যের দায়িত্ব<br><em>Membership Obligation</em></td>
            <td>
                সদস্যকে মাসিক চাঁদা প্রদান করতে হবে।<br>
                <em>The member must pay monthly subscription.</em>
            </td>
        </tr>
        <tr>
            <td>৩. পেমেন্ট শর্ত<br><em>Payment Terms</em></td>
            <td>
                প্রতি মাসের ১০ তারিখের মধ্যে প্রদান করতে হবে। গ্রেস পিরিয়ড ৫ দিন।<br>
                <em>Due Date: 10th of each month | Grace period: 5 days.</em>
            </td>
        </tr>
        <tr>
            <td>৪. নিরাপত্তা জামানত<br><em>Security Deposit</em></td>
            <td>
                বকেয়া থাকলে জামানত থেকে সমন্বয় করা হবে।<br>
                <em>Deposit will be adjusted if dues remain unpaid.</em>
            </td>
        </tr>
        <tr>
            <td>৫. বকেয়া<br><em>Non-Payment</em></td>
            <td>
                ১ মাস: সতর্কবার্তা (Warning)<br>
                ২ মাস: সাময়িক বহিষ্কার (Suspension)<br>
                ৩ মাস: সদস্যপদ বাতিল (Cancellation)
            </td>
        </tr>
        <tr>
            <td>৬. আইনি ব্যবস্থা<br><em>Legal Action</em></td>
            <td>
                বকেয়া টাকা বাংলাদেশ আইন অনুযায়ী আদায়যোগ্য।<br>
                <em>Unpaid dues are legally recoverable under Bangladesh law.</em>
            </td>
        </tr>
        <tr>
            <td>৭. গ্যারান্টর<br><em>Guarantor</em></td>
            <td>
                সদস্যকে একজন গ্যারান্টর দিতে হতে পারে।<br>
                <em>Member may require a guarantor.</em>
            </td>
        </tr>
        <tr>
            <td>৮. প্রস্থান নীতি<br><em>Exit Policy</em></td>
            <td>
                প্রস্থানের পূর্বে সমস্ত বকেয়া পরিশোধ করতে হবে।<br>
                <em>All dues must be cleared before exit.</em>
            </td>
        </tr>
    </table>

    {{-- Acceptance stamp --}}
    <div class="accepted-box">
        <strong>✓ Digitally Accepted</strong> — {{ $member->name }} (Member #{{ $member->id }}) accepted these terms and conditions on
        {{ $membership->joined_at ? $membership->joined_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A') }}.
    </div>

    {{-- Signatures --}}
    <div class="section-title" style="margin-top:14px;">Signatures / স্বাক্ষর</div>

    <table class="sign-table">
        <tr>
            <td>
                <div><strong>Member / সদস্য</strong></div>
                <div style="margin-top:6px;">
                    Name / নাম: <div class="sign-line">{{ $member->name }}</div>
                    <span class="sign-label">Member ID:</span> #{{ $member->id }}<br><br>
                    <span class="sign-label">NID / Passport:</span> {{ $member->profile?->nid_passport ?? '________________________' }}<br><br>
                    Signature / স্বাক্ষর: <div class="sign-line"></div>
                </div>
            </td>
            <td>
                <div><strong>Guarantor / গ্যারান্টর</strong></div>
                <div style="margin-top:6px;">
                    Name / নাম: <div class="sign-line"></div>
                    <span class="sign-label">Phone Number:</span> <div class="sign-line"></div>
                    <span class="sign-label">NID Number:</span> <div class="sign-line"></div>
                    Signature / স্বাক্ষর: <div class="sign-line"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:12px;">
                <strong>President Signature / সভাপতির স্বাক্ষর</strong>
                <div class="sign-line" style="width:50%; margin-top:10px;"></div>
            </td>
        </tr>
    </table>

    <div class="footer">
        This is a system-generated document. | {{ $settings->site_name ?? 'The Bengal Club' }} &copy; {{ date('Y') }}
    </div>

</body>
</html>
