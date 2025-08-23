@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-2xl p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl font-bold text-black mb-2">Mi Perfil</h1>
                        <p class="text-gray-600">Gestiona tu información personal y configuración de cuenta</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('welcome') }}" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-2">
                            <span class="text-xl">🏠</span>
                            <span class="font-medium">Ir al Inicio</span>
                        </a>
                        <a href="{{ route('dashboard.user') }}" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-lg flex items-center gap-2">
                            <span class="text-xl">📊</span>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="bg-white border-l-4 border-black text-black px-6 py-4 rounded-xl mb-8 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Formulario de Información Personal -->
                <div class="bg-white rounded-2xl shadow-2xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📝</span>
                        </div>
                        <h2 class="text-2xl font-bold text-black">Información Personal</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-black mb-3">Nombre Completo</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-300 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                   placeholder="Ingresa tu nombre completo"
                                   required>
                            @error('name')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <span>⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-black mb-3">Correo Electrónico</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-300 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                   placeholder="tu@email.com"
                                   required>
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <span>⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-black hover:bg-gray-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-xl flex items-center justify-center gap-3">
                            <span class="text-xl">💾</span>
                            <span>Actualizar Información</span>
                        </button>
                    </form>
                </div>

                <!-- Formulario de Cambio de Contraseña -->
                <div class="bg-white rounded-2xl shadow-2xl p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🔒</span>
                        </div>
                        <h2 class="text-2xl font-bold text-black">Cambiar Contraseña</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-black mb-3">Contraseña Actual</label>
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password"
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-300 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                   placeholder="Ingresa tu contraseña actual"
                                   required>
                            @error('current_password')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <span>⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-semibold text-black mb-3">Nueva Contraseña</label>
                            <input type="password" 
                                   id="password" 
                                   name="password"
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-300 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                   placeholder="Ingresa tu nueva contraseña"
                                   required>
                            @error('password')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-2">
                                    <span>⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-black mb-3">Confirmar Nueva Contraseña</label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation"
                                   class="w-full px-4 py-4 bg-white border-2 border-gray-300 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                   placeholder="Confirma tu nueva contraseña"
                                   required>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-black hover:bg-gray-800 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 hover:shadow-xl flex items-center justify-center gap-3">
                            <span class="text-xl">🔐</span>
                            <span>Cambiar Contraseña</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Información de la cuenta -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                        <span class="text-2xl">ℹ️</span>
                    </div>
                    <h2 class="text-2xl font-bold text-black">Información de la Cuenta</h2>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                        <p class="text-sm font-semibold text-gray-600 mb-2">Rol en el Sistema</p>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">👤</span>
                            <span class="text-xl font-bold text-black capitalize">{{ $user->role }}</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                        <p class="text-sm font-semibold text-gray-600 mb-2">Miembro Desde</p>
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">📅</span>
                            <span class="text-xl font-bold text-black">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de logout -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🚪</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-black">Cerrar Sesión</h2>
                        <p class="text-gray-600 mt-1">Termina tu sesión actual de forma segura</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="flex flex-col sm:flex-row gap-4 items-center">
                    @csrf
                    <div class="bg-gray-50 rounded-xl p-4 border-2 border-gray-200 flex-grow">
                        <p class="text-gray-700 text-sm">
                            Al cerrar sesión, serás redirigido a la página de inicio. Asegúrate de haber guardado todos tus cambios.
                        </p>
                    </div>
                    <button type="submit" 
                            class="bg-black hover:bg-gray-800 text-white font-bold px-8 py-4 rounded-xl transition-all duration-300 hover:shadow-xl flex items-center gap-3 whitespace-nowrap"
                            onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                        <span class="text-xl">🔓</span>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection