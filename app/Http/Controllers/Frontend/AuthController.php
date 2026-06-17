<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('frontend.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isSuspended()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Your membership has been suspended. Please contact support for assistance.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('member.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // If admin is impersonating, return to admin panel
        if ($request->session()->has('impersonating_admin_id')) {
            return $this->stopImpersonating($request);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.index');
    }

    public function stopImpersonating(Request $request)
    {
        $adminId = $request->session()->get('impersonating_admin_id');

        // Log out the member
        Auth::guard('web')->logout();

        // Remove impersonation flag
        $request->session()->forget('impersonating_admin_id');

        // Log back in as admin
        Auth::guard('admin')->loginUsingId($adminId);

        return redirect()->route('admin.registered-members.index')
            ->with('success', 'Returned to admin panel.');
    }
}
