<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Ruta raíz para evitar error 404
Route::get('/', function () {
    $events = [
        [
            'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
            'title' => 'Concierto de Rock',
            'date' => '25 de Agosto, 2024',
            'location' => 'Estadio Nacional'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80',
            'title' => 'Festival de Jazz',
            'date' => '12 de Septiembre, 2024',
            'location' => 'Parque Central'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1515168833906-d2a3b82b3029?auto=format&fit=crop&w=800&q=80',
            'title' => 'Obra de Teatro',
            'date' => '05 de Octubre, 2024',
            'location' => 'Teatro Municipal'
        ],
    ];
    return view('welcome', ['events' => $events]);
})->name('welcome');



// Rutas para autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas protegidas para dashboards según roles
Route::middleware('auth')->group(function () {
    // Rutas para administradores
    Route::get('/dashboard/admin', function () {
        return view('dashboard_admin');
    })->middleware('role:admin')->name('dashboard.admin');

    // Rutas para creadores de eventos
    Route::get('/dashboard/creator', function () {
        return view('dashboard_creator');
    })->middleware('role:creator')->name('dashboard.creator');

    // Rutas para usuarios normales
    Route::get('/dashboard/user', function () {
        return view('dashboard_user');
    })->middleware('role:user')->name('dashboard.user');

    // Ruta por defecto que redirige según rol
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role === 'creator') {
            return redirect()->route('dashboard.creator');
        } else {
            return redirect()->route('dashboard.user');
        }
    })->name('dashboard');
});
