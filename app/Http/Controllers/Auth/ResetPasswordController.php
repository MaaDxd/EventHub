<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset form.
     */
    public function showResetForm()
    {
        if (!session('password_reset_verified')) {
            return redirect()->route('password.request')->withErrors([
                'session' => 'Debes verificar tus preguntas de seguridad primero.',
            ]);
        }

        return view('auth.reset-password');
    }

    /**
     * Reset the user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        if (!session('password_reset_verified')) {
            return redirect()->route('password.request')->withErrors([
                'session' => 'La sesión ha expirado. Por favor, intenta de nuevo.',
            ]);
        }

        $userId = session('password_reset_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('password.request')->withErrors([
                'user' => 'Usuario no encontrado.',
            ]);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear session data
        session()->forget(['password_reset_verified', 'password_reset_user_id']);

        // Log the user in
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Tu contraseña ha sido restablecida exitosamente.');
    }
}