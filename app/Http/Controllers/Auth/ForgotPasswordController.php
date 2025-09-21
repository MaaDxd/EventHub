<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    /**
     * Display the password reset request form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Verify email and show security questions.
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'No encontramos una cuenta con esa dirección de correo electrónico.',
            ])->onlyInput('email');
        }

        // Store user ID in session for security question verification
        session(['password_reset_user_id' => $user->id]);

        return view('auth.security-questions', compact('user'));
    }

    /**
     * Verify security questions and show password reset form.
     */
    public function verifySecurityQuestions(Request $request)
    {
        $request->validate([
            'security_answer_1' => ['required', 'string'],
            'security_answer_2' => ['required', 'string'],
        ]);

        $userId = session('password_reset_user_id');
        
        if (!$userId) {
            return redirect()->route('password.request')->withErrors([
                'session' => 'La sesión ha expirado. Por favor, intenta de nuevo.',
            ]);
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('password.request')->withErrors([
                'user' => 'Usuario no encontrado.',
            ]);
        }

        // Normalize answers (lowercase and trim)
        $answer1 = strtolower(trim($request->security_answer_1));
        $answer2 = strtolower(trim($request->security_answer_2));

        // Check if answers match
        if ($answer1 !== $user->security_answer_1 || $answer2 !== $user->security_answer_2) {
            return back()->withErrors([
                'security_answers' => 'La respuesta no es correcta.',
            ])->withInput();
        }

        // Store user ID for password reset
        session(['password_reset_verified' => true, 'password_reset_user_id' => $user->id]);

        return redirect()->route('password.reset.form');
    }
}