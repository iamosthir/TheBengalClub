<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MemberProfileController extends Controller
{
    /**
     * Resolve the numeric user ID from either a raw ID or the 2025XXXX format.
     */
    private function resolveUserId($userId): int
    {
        $userId = (string) $userId;

        if (preg_match('/^2025(\d{4})$/', $userId, $matches)) {
            return (int) $matches[1];
        }

        return (int) $userId;
    }

    /**
     * Display the specified member profile
     */
    public function show($userId)
    {
        $userId = $this->resolveUserId($userId);

        // Get the user with their profile and membership category
        $user = User::with(['profile.membershipCategory'])->findOrFail($userId);

        // Check if user has a profile
        if (!$user->profile) {
            abort(404, 'Member profile not found');
        }

        // Get site settings
        $settings = SiteSetting::getSettings();

        // Generate profile URL for QR code
        $profileUrl = route('member.profile', $user->id);

        return view('frontend.pages.member-profile', compact('user', 'settings', 'profileUrl'));
    }

    /**
     * Search for a member by ID or phone number and redirect to their profile, or show not-found page
     */
    public function search(Request $request)
    {
        $query = trim((string) $request->query('id', ''));

        if (preg_match('/^2025(\d{4})$/', $query, $matches)) {
            $user = User::with('profile')->find((int) $matches[1]);

            if ($user && $user->profile) {
                return redirect()->route('member.profile', $user->id);
            }

            return view('frontend.pages.member-not-found', ['searchId' => $query]);
        }

        if ($query !== '') {
            $user = User::with('profile')
                ->whereHas('profile', function ($q) use ($query) {
                    $q->where('manual_member_id', $query);
                })
                ->first();

            if ($user && $user->profile) {
                return redirect()->route('member.profile', $user->id);
            }
        }

        $digits = preg_replace('/\D+/', '', $query);

        if (strlen($digits) >= 7) {
            $user = User::with('profile')
                ->whereHas('profile', function ($q) use ($digits) {
                    $q->where('mobile', $digits)
                      ->orWhere('mobile', 'LIKE', '%' . $digits);
                })
                ->first();

            if ($user && $user->profile) {
                return redirect()->route('member.profile', $user->id);
            }
        }

        return view('frontend.pages.member-not-found', ['searchId' => $query]);
    }

    /**
     * Generate and return QR code image
     */
    public function qrCode($userId)
    {
        $userId = $this->resolveUserId($userId);
        $user = User::findOrFail($userId);

        // Generate profile URL
        $profileUrl = route('member.profile', $user->id);

        // Generate QR code as SVG (no extension required)
        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(1)
            ->errorCorrection('H')
            ->generate($profileUrl);

        return response($qrCode, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'public, max-age=31536000');
    }

    /**
     * Download vCard for the member
     */
    public function downloadVCard($userId)
    {
        $userId = $this->resolveUserId($userId);
        $user = User::with('profile')->findOrFail($userId);

        if (!$user->profile) {
            abort(404, 'Member profile not found');
        }

        // Get site settings
        $settings = SiteSetting::getSettings();

        // Create vCard content
        $vcard = "BEGIN:VCARD\r\n";
        $vcard .= "VERSION:3.0\r\n";
        $vcard .= "FN:" . $user->name . "\r\n";
        $vcard .= "N:" . $user->name . ";;;\r\n";

        // Add organization info
        if ($user->profile->profession_organization) {
            $vcard .= "ORG:" . $user->profile->profession_organization . "\r\n";
            $vcard .= "TITLE:" . $user->profile->profession_organization . "\r\n";
        }

        // Add email
        if ($user->email) {
            $vcard .= "EMAIL;TYPE=INTERNET:" . $user->email . "\r\n";
        }

        // Add phone
        if ($user->profile->mobile) {
            $vcard .= "TEL;TYPE=CELL:" . $user->profile->mobile . "\r\n";
        }

        // Add address
        if ($user->profile->address) {
            $vcard .= "ADR;TYPE=WORK:;;" . str_replace(["\r", "\n"], [" ", " "], $user->profile->address) . "\r\n";
        }

        // Add company info from site settings
        if ($settings->site_name) {
            $vcard .= "NOTE:" . $settings->site_name . "\r\n";
        }

        // Add profile URL
        $profileUrl = route('member.profile', $user->id);
        $vcard .= "URL:" . $profileUrl . "\r\n";

        // Add photo if available
        if ($user->profile->photo) {
            $photoPath = public_path('storage/' . $user->profile->photo);
            if (file_exists($photoPath)) {
                $photoData = base64_encode(file_get_contents($photoPath));
                $photoType = pathinfo($photoPath, PATHINFO_EXTENSION);
                $vcard .= "PHOTO;ENCODING=b;TYPE=" . strtoupper($photoType) . ":" . $photoData . "\r\n";
            }
        }

        $vcard .= "END:VCARD\r\n";

        // Return as downloadable file
        $fileName = str_replace(' ', '_', $user->name) . '.vcf';

        return response($vcard, 200)
            ->header('Content-Type', 'text/vcard')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->header('Content-Length', strlen($vcard));
    }
}
