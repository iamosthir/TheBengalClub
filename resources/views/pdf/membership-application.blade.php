<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Application #{{ $application->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #000;
            line-height: 1.3;
            padding: 20px 30px;
        }

        /* ---- Title ---- */
        .form-title {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        /* ---- Header ---- */
        .header {
            text-align: center;
            margin-bottom: 3px;
        }
        .header-logo {
            width: 65px;
            height: auto;
        }
        .header-divider {
            border: none;
            border-top: 2px solid #000;
            margin: 5px 0 8px;
        }

        /* ---- Top info row with photo ---- */
        .top-info-table {
            width: 100%;
            margin-bottom: 8px;
        }
        .top-info-table td {
            vertical-align: top;
        }
        .meta-text {
            font-size: 9px;
            color: #333;
            line-height: 1.5;
        }
        .meta-label {
            font-weight: bold;
        }
        .photo-box {
            width: 90px;
            height: 115px;
            border: 2px solid #000;
            text-align: center;
            vertical-align: middle;
        }
        .photo-box img {
            width: 86px;
            height: 111px;
            object-fit: cover;
        }
        .photo-box-text {
            font-size: 8px;
            color: #666;
            padding-top: 40px;
        }

        /* ---- Section titles ---- */
        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #e8e8e8;
            padding: 4px 8px;
            margin: 10px 0 0;
            border: 1px solid #000;
            border-bottom: none;
        }

        /* ---- Form table ---- */
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .form-table td {
            border: 1px solid #000;
            padding: 5px 8px;
            vertical-align: middle;
            font-size: 10px;
        }
        .form-table .label {
            font-weight: bold;
            background-color: #f5f5f5;
            width: 30%;
            font-size: 9px;
        }
        .form-table .value {
            width: 70%;
        }
        .form-table .label-sm {
            font-weight: bold;
            background-color: #f5f5f5;
            width: 25%;
            font-size: 9px;
        }
        .form-table .value-sm {
            width: 25%;
        }

        /* ---- Declaration ---- */
        .declaration {
            margin-top: 12px;
            padding: 8px 10px;
            border: 1px solid #000;
            font-size: 9px;
            line-height: 1.5;
        }
        .declaration-title {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        /* ---- NID photo section ---- */
        .nid-photo-section {
            margin-top: 12px;
        }
        .nid-photo-box {
            display: inline-block;
            border: 1px solid #000;
            padding: 3px;
        }
        .nid-photo-box img {
            max-height: 90px;
            max-width: 160px;
            display: block;
        }
        .nid-photo-label {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        /* ---- Applicant date line ---- */
        .date-line-table {
            width: 100%;
            margin-top: 20px;
        }
        .date-line-table td {
            vertical-align: bottom;
            font-size: 9px;
        }

        /* ---- Footer ---- */
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 7px;
            color: #999;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    {{-- ============ FORM TITLE ============ --}}
    <div class="form-title">Membership Application Form</div>

    {{-- ============ HEADER (Logo only) ============ --}}
    <div class="header">
        @if($settings->logo)
            <img src="{{ public_path('storage/' . $settings->logo) }}" class="header-logo" alt="Logo">
        @endif
    </div>
    <hr class="header-divider">

    {{-- ============ TOP INFO + PHOTO ============ --}}
    <table class="top-info-table">
        <tr>
            <td style="padding-right: 20px;">
                <div class="meta-text">
                    <span class="meta-label">Application ID:</span> #{{ $application->id }}<br>
                    <span class="meta-label">Date:</span> {{ $application->created_at->format('d M, Y') }}<br>
                    <span class="meta-label">Status:</span> {{ ucfirst($application->status) }}<br>
                    <span class="meta-label">Membership Category:</span> {{ $application->membershipCategory->title ?? 'N/A' }}<br>
                    <span class="meta-label">Duration:</span> {{ $application->membershipCategory->duration ?? 'N/A' }}
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span class="meta-label">Fee:</span> BDT {{ number_format($application->membershipCategory->price ?? 0, 2) }}
                </div>
            </td>
            <td style="width: 95px; text-align: right;">
                <table><tr><td class="photo-box">
                    @if($application->photo)
                        <img src="{{ public_path('storage/' . $application->photo) }}" alt="Applicant Photo">
                    @else
                        <div class="photo-box-text">Passport Size<br>Photograph</div>
                    @endif
                </td></tr></table>
            </td>
        </tr>
    </table>

    {{-- ============ PERSONAL INFORMATION ============ --}}
    <div class="section-title">Personal Information</div>
    <table class="form-table">
        <tr>
            <td class="label">Full Name</td>
            <td class="value">{{ $application->name }}</td>
        </tr>
        <tr>
            <td class="label">Date of Birth</td>
            <td class="value">{{ $application->date_of_birth->format('d M, Y') }}</td>
        </tr>
        <tr>
            <td class="label">NID / Passport No.</td>
            <td class="value">{{ $application->nid_passport }}</td>
        </tr>
        <tr>
            <td class="label">Profession / Organization</td>
            <td class="value">{{ $application->profession_organization }}</td>
        </tr>
    </table>

    {{-- ============ CONTACT DETAILS ============ --}}
    <div class="section-title">Contact Details</div>
    <table class="form-table">
        <tr>
            <td class="label-sm">Mobile Number</td>
            <td class="value-sm">{{ $application->mobile }}</td>
            <td class="label-sm">Email Address</td>
            <td class="value-sm">{{ $application->email }}</td>
        </tr>
        <tr>
            <td class="label">Present Address</td>
            <td class="value" colspan="3">{{ $application->address }}</td>
        </tr>
    </table>

    {{-- ============ REFERENCE ============ --}}
    <div class="section-title">Reference</div>
    <table class="form-table">
        <tr>
            <td class="label">Referred By (If any)</td>
            <td class="value">{{ $application->reference ?? '—' }}</td>
        </tr>
    </table>

    {{-- ============ DECLARATION ============ --}}
    <div class="declaration">
        <div class="declaration-title">Declaration</div>
        I, <strong>{{ $application->name }}</strong>, hereby apply for the membership of
        <strong>{{ $settings->site_name ?? 'The Bengal Club' }}</strong> in accordance with the membership terms and conditions.
        I confirm that the information provided in this application form is true and correct to the best of my knowledge.
        I agree to abide by the rules, regulations, and bylaws of the club.
    </div>

    {{-- ============ NID / PASSPORT PHOTO ============ --}}
    @if($application->nid_photo)
        <div class="nid-photo-section">
            <div class="section-title">NID / Passport Photo</div>
            <table class="form-table">
                <tr>
                    <td style="padding: 8px;">
                        <div class="nid-photo-label">Submitted NID / Passport Photo</div>
                        <div class="nid-photo-box">
                            <img src="{{ public_path('storage/' . $application->nid_photo) }}" alt="NID/Passport Photo">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    @endif

    {{-- ============ DATE LINE ============ --}}
    <table class="date-line-table">
        <tr>
            <td>Date: {{ $application->created_at->format('d / m / Y') }}</td>
        </tr>
    </table>

    {{-- ============ OFFICE USE ============ --}}
    <div class="section-title" style="margin-top: 15px;">For Office Use Only</div>
    <table class="form-table">
        <tr>
            <td class="label-sm">Received By</td>
            <td class="value-sm">&nbsp;</td>
            <td class="label-sm">Date</td>
            <td class="value-sm">&nbsp;</td>
        </tr>
        <tr>
            <td class="label-sm">Approved By</td>
            <td class="value-sm">&nbsp;</td>
            <td class="label-sm">Membership No.</td>
            <td class="value-sm">&nbsp;</td>
        </tr>
    </table>

    {{-- ============ FOOTER ============ --}}
    <div class="footer">
        This is a computer-generated document. | {{ $settings->site_name ?? 'The Bengal Club' }} &copy; {{ date('Y') }}
    </div>
</body>
</html>
