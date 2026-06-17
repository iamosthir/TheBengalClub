<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMemberSuspension
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip suspension check if admin is impersonating a member
        if ($request->session()->has('impersonating_admin_id')) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->isSuspended()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('member.login')->withErrors([
                'email' => 'Your membership has been suspended. Please contact support for assistance.',
            ]);
        }

        return $next($request);
    }
}
