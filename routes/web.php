<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\QrLoginController;
use App\Http\Controllers\EventCommentController;
use App\Http\Controllers\FavoriteController;

 // Rutas para inicio de sesión con código QR
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [QrLoginController::class, 'show'])->name('profile.show');
});
// Ruta para verificar QR (pública, no requiere auth)
Route::get('/qr-verify/{token}', [QrLoginController::class, 'verifyQr'])->name('qr.verify');
// Ruta raíz para evitar error 404
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

// Ruta para mostrar todos los eventos públicos
Route::get('/eventos', [App\Http\Controllers\HomeController::class, 'allEvents'])->name('events.public');

// Ruta para mostrar detalles de un evento específico (pública)
Route::get('/evento/{event}', [EventController::class, 'show'])->name('events.show');



// Rutas para autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para sesión expirada
Route::get('/session/expired', function () {
    return view('session.expired');
})->name('session.expired');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas específicas para registro por tipo de usuario
Route::get('register/user', [RegisterController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('register/user', [RegisterController::class, 'registerUser']);

Route::get('register/creator', [RegisterController::class, 'showCreatorRegistrationForm'])->name('register.creator');
Route::post('register/creator', [RegisterController::class, 'registerCreator']);

// Rutas protegidas para dashboards según roles
Route::middleware(['auth', 'session.timeout'])->group(function () {
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
    Route::get('/profile', [QrLoginController::class, 'show'])->name('profile.show');
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

    // Comment routes for events
    Route::post('/events/{event}/comments', [EventCommentController::class, 'store'])->name('events.comments.store');
    Route::delete('/comments/{comment}', [EventCommentController::class, 'destroy'])->name('comments.destroy');

    // Favorite routes for events
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/events/{event}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/events/{event}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/events/{event}/favorite/check', [FavoriteController::class, 'check'])->name('favorites.check');

    // Session management routes
    Route::get('/session/status', [SessionController::class, 'checkStatus'])->name('session.status');
    Route::post('/session/extend', [SessionController::class, 'extend'])->name('session.extend');
    Route::post('/session/logout', [SessionController::class, 'logout'])->name('session.logout');

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

// Rutas de ayuda
Route::get('/ayuda', [App\Http\Controllers\HelpController::class, 'index'])->name('help.index');
Route::get('/ayuda/usuario', [App\Http\Controllers\HelpController::class, 'userGuide'])->name('help.user-guide');
Route::get('/ayuda/creador', [App\Http\Controllers\HelpController::class, 'creatorGuide'])->name('help.creator-guide');
Route::get('/ayuda/admin', [App\Http\Controllers\HelpController::class, 'adminGuide'])->name('help.admin-guide');
Route::get('/ayuda/faq', [App\Http\Controllers\HelpController::class, 'faq'])->name('help.faq');
Route::get('/ayuda/contacto', [App\Http\Controllers\HelpController::class, 'contact'])->name('help.contact');

