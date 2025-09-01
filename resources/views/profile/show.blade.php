@extends('layouts.app')

@section('content')
<div class="min-h-screen gradient-bg">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl font-bold text-black mb-3">Mi Perfil</h1>
                        <p class="text-lg text-gray-600">Gestiona tu información personal y configuración de cuenta</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('welcome') }}" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-3 font-semibold border border-black">
                            <span class="text-xl">🏠</span>
                            <span>Ir al Inicio</span>
                        </a>
                        <a href="{{ route('dashboard.user') }}" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-3 font-semibold border border-black">
                            <span class="text-xl">📊</span>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="bg-white border-l-4 border-black text-black px-6 py-4 rounded-xl mb-8 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Formulario de Información Personal -->
                <div class="event-card">
                    <div class="event-content">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 bg-black rounded-xl flex items-center justify-center">
                                <span class="text-2xl text-white">📝</span>
                            </div>
                            <h2 class="event-title text-2xl">Información Personal</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="name" class="block text-sm font-semibold text-black mb-3">Nombre Completo</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu nombre completo"
                                       required>
                                @error('name')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="block text-sm font-semibold text-black mb-3">Correo Electrónico</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="tu@email.com"
                                       required>
                                @error('email')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <button type="submit" 
                                    class="view-all-btn w-full">
                                <span class="text-xl mr-2">💾</span>
                                <span>Actualizar Información</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Formulario de Cambio de Contraseña -->
                <div class="event-card">
                    <div class="event-content">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 bg-black rounded-xl flex items-center justify-center">
                                <span class="text-2xl text-white">🔒</span>
                            </div>
                            <h2 class="event-title text-2xl">Cambiar Contraseña</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="current_password" class="block text-sm font-semibold text-black mb-3">Contraseña Actual</label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu contraseña actual"
                                       required>
                                @error('current_password')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="block text-sm font-semibold text-black mb-3">Nueva Contraseña</label>
                                <input type="password" 
                                       id="password" 
                                       name="password"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu nueva contraseña"
                                       required>
                                @error('password')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation" class="block text-sm font-semibold text-black mb-3">Confirmar Nueva Contraseña</label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Confirma tu nueva contraseña"
                                       required>
                            </div>
                            
                            <button type="submit" 
                                    class="view-all-btn w-full">
                                <span class="text-xl mr-2">🔐</span>
                                <span>Cambiar Contraseña</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Información de la cuenta -->
            <div class="event-card mt-8">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-black rounded-xl flex items-center justify-center">
                            <span class="text-2xl text-white">ℹ️</span>
                        </div>
                        <h2 class="event-title text-2xl">Información de la Cuenta</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <div class="event-meta">
                                <span class="text-sm font-semibold text-gray-600 mb-2">Rol en el Sistema</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">👤</span>
                                    <span class="text-xl font-bold text-black capitalize">{{ $user->role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <div class="event-meta">
                                <span class="text-sm font-semibold text-gray-600 mb-2">Miembro Desde</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📅</span>
                                    <span class="text-xl font-bold text-black">{{ $user->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         {{-- Reemplaza la sección QR en tu profile/show.blade.php --}}

<div class="mt-6 p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">🔐 Login con Código QR</h3>
        
        @if(!isset($qrCode))
            <a href="{{ route('profile.show') }}?generate_qr=1" 
               class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                <i class="fas fa-qrcode mr-2"></i> Generar QR de Login
            </a>
        @else
            <a href="{{ route('profile.show') }}" 
               class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                <i class="fas fa-eye-slash mr-2"></i> Ocultar QR
            </a>
        @endif
    </div>
    
    @if(isset($qrCode) && isset($token))
        {{-- MOSTRAR QR CUANDO EXISTE --}}
        <div class="qr-container text-center">
            <p class="text-gray-600 mb-4">Escanea este código QR con otro dispositivo para iniciar sesión</p>
            
            <div class="qr-code inline-block p-4 bg-white rounded-lg shadow-md" style="min-width: 320px; min-height: 320px;">
                @if(isset($qrCode) && !empty($qrCode))
                    {!! $qrCode !!}
                @else
                    <p class="text-red-500">Error al generar el código QR</p>
                @endif
            </div>
            
            <p class="text-sm text-gray-500 mt-2">🕐 El código expira en 5 minutos - Al escanearlo iniciarás sesión automáticamente</p>
        </div>
    @else
        {{-- MOSTRAR CUANDO NO HAY QR --}}
        <div class="text-center p-6 bg-gray-50 rounded-lg">
            <div class="text-6xl mb-4">📱</div>
            <h4 class="text-lg font-medium text-gray-900 mb-2">QR Login</h4>
            <p class="text-gray-600">
                Genera un código QR para iniciar sesión desde otro dispositivo de forma rápida y segura.
            </p>
        </div>
    @endif
</div>

            <!-- Botón de logout -->
            <div class="event-card mt-8">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-black rounded-xl flex items-center justify-center">
                            <span class="text-2xl text-white">🚪</span>
                        </div>
                        <div>
                            <h2 class="event-title text-2xl">Cerrar Sesión</h2>
                            <p class="event-description mt-1">Termina tu sesión actual de forma segura</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="flex flex-col sm:flex-row gap-6 items-center">
                        @csrf
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex-grow">
                            <p class="event-description text-sm">
                                Al cerrar sesión, serás redirigido a la página de inicio. Asegúrate de haber guardado todos tus cambios.
                            </p>
                        </div>
                        <button type="submit" 
                                class="view-all-btn whitespace-nowrap"
                                onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                            <span class="text-xl mr-2">🔓</span>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradientes corporativos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }
    
    /* Event cards - Aplicando el estilo profesional del CSS proporcionado */
    .event-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }
    
    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -12px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
    }
    
    .event-content {
        padding: 32px;
    }
    
    .event-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1A0046;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .event-description {
        color: #32004E;
        opacity: 0.8;
        margin-bottom: 16px;
        line-height: 1.6;
    }
    
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }
    
    .event-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #32004E;
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    .view-all-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
        border: none;
        cursor: pointer;
    }
    
    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
        color: #FFFFFF;
    }

    /* Form inputs styling */
    .form-input {
        box-shadow: 0 2px 8px rgba(26, 0, 70, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-input:focus {
        box-shadow: 0 4px 16px rgba(26, 0, 70, 0.15);
        transform: translateY(-1px);
    }

    .form-group {
        position: relative;
    }

    .form-group label {
        color: #1A0046;
        font-weight: 600;
    }
    .qr-container {
        text-align: center;
        padding: 20px;
        max-width: 400px;
        margin: 20px auto;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .qr-code {
        margin: 20px 0;
        display: inline-block;
    }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .status-success { background-color: #d4edda; color: #155724; }
    .status-error { background-color: #f8d7da; color: #721c24; }
</style>

@include('layouts.footer')
@endsection
