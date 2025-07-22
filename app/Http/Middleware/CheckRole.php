<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        if ($role == 'admin' && $user->role != 'admin') {
            return redirect('/');
        }

        if ($role == 'creator' && $user->role != 'creator') {
            return redirect('/');
        }

        if ($role == 'user' && $user->role != 'user') {
            return redirect('/');
        }

        return $next($request);
    }
}