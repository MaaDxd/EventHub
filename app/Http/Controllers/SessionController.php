<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    /**
     * Check session status and return remaining time
     */
    public function checkStatus()
    {
        if (!Auth::check()) {
            return response()->json(['authenticated' => false]);
        }

        $lastActivity = Session::get('last_activity', time());
        $timeout = config('session.lifetime') * 60; // Convert minutes to seconds
        $elapsed = time() - $lastActivity;
        $remaining = max(0, $timeout - $elapsed);

        return response()->json([
            'authenticated' => true,
            'remaining_seconds' => $remaining,
            'timeout_seconds' => $timeout,
            'will_expire_at' => time() + $remaining
        ]);
    }

    /**
     * Extend session by updating last activity
     */
    public function extend()
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        Session::put('last_activity', time());

        return response()->json([
            'success' => true,
            'message' => 'Sesión extendida exitosamente',
            'new_expiry' => time() + (config('session.lifetime') * 60)
        ]);
    }

    /**
     * Manually logout user
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return response()->json(['success' => true, 'message' => 'Sesión cerrada']);
    }
}
