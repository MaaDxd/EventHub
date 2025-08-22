<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;



// Ruta raíz para evitar error 404
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

// Ruta para mostrar todos los eventos públicos
Route::get('/eventos', [App\Http\Controllers\HomeController::class, 'allEvents'])->name('events.public');



// Rutas para autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas específicas para registro por tipo de usuario
Route::get('register/user', [RegisterController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('register/user', [RegisterController::class, 'registerUser']);

Route::get('register/creator', [RegisterController::class, 'showCreatorRegistrationForm'])->name('register.creator');
Route::post('register/creator', [RegisterController::class, 'registerCreator']);

// Rutas protegidas para dashboards según roles
Route::middleware('auth')->group(function () {
    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events');

        // User management routes
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::post('/admin/users/{id}/restore', [AdminController::class, 'restoreUser'])->name('admin.users.restore');
        Route::delete('/admin/users/{id}/force', [AdminController::class, 'forceDeleteUser'])->name('admin.users.force-delete');

        // Event management routes
        Route::delete('/admin/events/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
        Route::post('/admin/events/{id}/restore', [AdminController::class, 'restoreEvent'])->name('admin.events.restore');
        Route::delete('/admin/events/{id}/force', [AdminController::class, 'forceDeleteEvent'])->name('admin.events.force-delete');
    });

    // Rutas para creadores de eventos
    Route::get('/dashboard/creator', function () {
        return view('dashboard_creator');
    })->middleware('role:creator')->name('dashboard.creator');

    // Rutas para usuarios normales
    Route::get('/dashboard/user', function () {
        return view('dashboard_user');
    })->middleware('role:user')->name('dashboard.user');

    // Rutas para perfil de usuario
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Rutas para eventos (solo creadores)
    Route::middleware('role:creator')->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    });

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

// Ruta de contacto
Route::get('/contact', function () {
    return view('layouts.contact');
})->name('contact');

