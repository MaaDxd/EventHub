<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = Session::get('last_activity', time());
            $timeout = config('session.lifetime') * 60; // Convert minutes to seconds

            if (time() - $lastActivity > $timeout) {
                Auth::logout();
                Session::flush();

                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Sesión expirada'], 401);
                }

                return redirect()->route('login')->with('message', 'Tu sesión ha expirado por inactividad.');
            }

            // Update last activity time
            Session::put('last_activity', time());
        }

        return $next($request);
    }
}
