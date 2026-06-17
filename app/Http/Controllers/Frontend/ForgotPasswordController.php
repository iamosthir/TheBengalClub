<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('frontend.pages.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We could not find an account with that email address.',
        ]);

        // Delete old OTPs for this email
        PasswordResetOtp::where('email', $request->email)->delete();

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store hashed OTP
        PasswordResetOtp::create([
            'email' => $request->email,
            'otp' => Hash::make($otp),
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP email
        Mail::to($request->email)->send(new PasswordResetOtpMail($otp));

        return back()->with([
            'step' => 2,
            'email' => $request->email,
            'success' => 'OTP has been sent to your email address.',
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $record = PasswordResetOtp::where('email', $request->email)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$record || !Hash::check($request->otp, $record->otp)) {
            return back()->with([
                'step' => 2,
                'email' => $request->email,
            ])->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
        }

        return back()->with([
            'step' => 3,
            'email' => $request->email,
            'otp' => $request->otp,
            'otp_verified' => true,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Re-verify OTP
        $record = PasswordResetOtp::where('email', $request->email)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$record || !Hash::check($request->otp, $record->otp)) {
            return redirect()->route('member.forgot-password')
                ->withErrors(['email' => 'Session expired. Please start over.']);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => $request->password]);

        // Clean up OTPs
        PasswordResetOtp::where('email', $request->email)->delete();

        return redirect()->route('member.login')
            ->with('success', 'Password has been reset successfully. Please login with your new password.');
    }
}
