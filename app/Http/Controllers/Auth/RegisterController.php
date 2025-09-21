<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'security_question_1' => ['required', 'string'],
            'security_answer_1' => ['required', 'string', 'min:3'],
            'security_question_2' => ['required', 'string'],
            'security_answer_2' => ['required', 'string', 'min:3'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Asignar rol de usuario por defecto
            'security_question_1' => $request->security_question_1,
            'security_answer_1' => strtolower(trim($request->security_answer_1)),
            'security_question_2' => $request->security_question_2,
            'security_answer_2' => strtolower(trim($request->security_answer_2)),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function showUserRegistrationForm()
    {
        return view('auth.register-user');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email_confirmation' => ['required', 'same:email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'security_question_1' => ['required', 'string'],
            'security_answer_1' => ['required', 'string', 'min:3'],
            'security_question_2' => ['required', 'string'],
            'security_answer_2' => ['required', 'string', 'min:3'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'security_question_1' => $request->security_question_1,
            'security_answer_1' => strtolower(trim($request->security_answer_1)),
            'security_question_2' => $request->security_question_2,
            'security_answer_2' => strtolower(trim($request->security_answer_2)),
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', '¡Te has registrado exitosamente como usuario!');
    }

    public function showCreatorRegistrationForm()
    {
        return view('auth.register-creator');
    }

    public function registerCreator(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email_confirmation' => ['required', 'same:email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
            'security_question_1' => ['required', 'string'],
            'security_answer_1' => ['required', 'string', 'min:3'],
            'security_question_2' => ['required', 'string'],
            'security_answer_2' => ['required', 'string', 'min:3'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'creator',
            'phone' => $request->phone,
            'security_question_1' => $request->security_question_1,
            'security_answer_1' => strtolower(trim($request->security_answer_1)),
            'security_question_2' => $request->security_question_2,
            'security_answer_2' => strtolower(trim($request->security_answer_2)),
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', '¡Te has registrado exitosamente como creador de eventos!');
    }
}