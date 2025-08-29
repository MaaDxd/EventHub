@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header con animación de entrada -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 border-4 border-black transform transition-all duration-700 hover:scale-105 animate-fade-in-down">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left animate-fade-in-left">
                        <h1 class="text-5xl font-black text-black mb-3 animate-bounce-in">Mi Perfil</h1>
                        <p class="text-lg text-gray-700 font-medium animate-slide-in-up">Gestiona tu información personal y configuración de cuenta</p>
                    </div>
                    <div class="flex flex-wrap gap-4 animate-fade-in-right">
                        <a href="{{ route('welcome') }}" class="bg-black hover:bg-gray-900 text-white px-8 py-4 rounded-2xl transition-all duration-500 hover:shadow-2xl flex items-center gap-3 font-bold text-lg border-2 border-black hover:scale-110 hover:-translate-y-2 hover:rotate-1 transform">
                            <span class="text-2xl animate-bounce">🏠</span>
                            <span>Ir al Inicio</span>
                        </a>
                        <a href="{{ route('dashboard.user') }}" class="bg-black hover:bg-gray-900 text-white px-8 py-4 rounded-2xl transition-all duration-500 hover:shadow-2xl flex items-center gap-3 font-bold text-lg border-2 border-black hover:scale-110 hover:-translate-y-2 hover:-rotate-1 transform">
                            <span class="text-2xl animate-pulse">📊</span>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito con animación -->
            @if(session('success'))
                <div class="bg-white border-4 border-black text-black px-8 py-6 rounded-3xl mb-8 shadow-2xl animate-bounce-in transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <span class="text-3xl animate-spin">✅</span>
                        <span class="font-bold text-lg">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Formulario de Información Personal con animaciones -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 border-4 border-black transform transition-all duration-700 hover:scale-105 animate-slide-in-left hover:shadow-3xl hover:-translate-y-2">
                    <div class="flex items-center gap-4 mb-8 animate-fade-in">
                        <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center border-2 border-black transform transition-all duration-300 hover:rotate-12 hover:scale-110">
                            <span class="text-3xl animate-pulse">📝</span>
                        </div>
                        <h2 class="text-3xl font-black text-black animate-slide-in-right">Información Personal</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                            <label for="name" class="block text-base font-black text-black mb-4 transform transition-all duration-300 hover:scale-105 hover:text-gray-800">Nombre Completo</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-6 py-5 bg-white border-4 border-black rounded-2xl text-black placeholder-gray-600 focus:outline-none focus:border-gray-800 transition-all duration-500 text-lg font-medium transform hover:scale-105 focus:scale-105 focus:-translate-y-1 focus:shadow-xl"
                                   placeholder="Ingresa tu nombre completo"
                                   required>
                            @error('name')
                                <p class="text-red-700 text-base mt-3 flex items-center gap-2 font-bold animate-shake">
                                    <span class="animate-bounce">⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                            <label for="email" class="block text-base font-black text-black mb-4 transform transition-all duration-300 hover:scale-105 hover:text-gray-800">Correo Electrónico</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-6 py-5 bg-white border-4 border-black rounded-2xl text-black placeholder-gray-600 focus:outline-none focus:border-gray-800 transition-all duration-500 text-lg font-medium transform hover:scale-105 focus:scale-105 focus:-translate-y-1 focus:shadow-xl"
                                   placeholder="tu@email.com"
                                   required>
                            @error('email')
                                <p class="text-red-700 text-base mt-3 flex items-center gap-2 font-bold animate-shake">
                                    <span class="animate-bounce">⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-black hover:bg-gray-900 text-white font-black py-6 px-8 rounded-2xl transition-all duration-500 hover:shadow-2xl flex items-center justify-center gap-4 text-lg border-2 border-black transform hover:scale-110 hover:-translate-y-3 hover:rotate-1 animate-fade-in-up group"
                                style="animation-delay: 0.3s;">
                            <span class="text-2xl group-hover:animate-spin">💾</span>
                            <span>Actualizar Información</span>
                        </button>
                    </form>
                </div>

                <!-- Formulario de Cambio de Contraseña con animaciones -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 border-4 border-black transform transition-all duration-700 hover:scale-105 animate-slide-in-right hover:shadow-3xl hover:-translate-y-2">
                    <div class="flex items-center gap-4 mb-8 animate-fade-in">
                        <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center border-2 border-black transform transition-all duration-300 hover:rotate-12 hover:scale-110">
                            <span class="text-3xl animate-pulse">🔒</span>
                        </div>
                        <h2 class="text-3xl font-black text-black animate-slide-in-left">Cambiar Contraseña</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                            <label for="current_password" class="block text-base font-black text-black mb-4 transform transition-all duration-300 hover:scale-105 hover:text-gray-800">Contraseña Actual</label>
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password"
                                   class="w-full px-6 py-5 bg-white border-4 border-black rounded-2xl text-black placeholder-gray-600 focus:outline-none focus:border-gray-800 transition-all duration-500 text-lg font-medium transform hover:scale-105 focus:scale-105 focus:-translate-y-1 focus:shadow-xl"
                                   placeholder="Ingresa tu contraseña actual"
                                   required>
                            @error('current_password')
                                <p class="text-red-700 text-base mt-3 flex items-center gap-2 font-bold animate-shake">
                                    <span class="animate-bounce">⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                            <label for="password" class="block text-base font-black text-black mb-4 transform transition-all duration-300 hover:scale-105 hover:text-gray-800">Nueva Contraseña</label>
                            <input type="password" 
                                   id="password" 
                                   name="password"
                                   class="w-full px-6 py-5 bg-white border-4 border-black rounded-2xl text-black placeholder-gray-600 focus:outline-none focus:border-gray-800 transition-all duration-500 text-lg font-medium transform hover:scale-105 focus:scale-105 focus:-translate-y-1 focus:shadow-xl"
                                   placeholder="Ingresa tu nueva contraseña"
                                   required>
                            @error('password')
                                <p class="text-red-700 text-base mt-3 flex items-center gap-2 font-bold animate-shake">
                                    <span class="animate-bounce">⚠️</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="animate-fade-in-up" style="animation-delay: 0.3s;">
                            <label for="password_confirmation" class="block text-base font-black text-black mb-4 transform transition-all duration-300 hover:scale-105 hover:text-gray-800">Confirmar Nueva Contraseña</label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation"
                                   class="w-full px-6 py-5 bg-white border-4 border-black rounded-2xl text-black placeholder-gray-600 focus:outline-none focus:border-gray-800 transition-all duration-500 text-lg font-medium transform hover:scale-105 focus:scale-105 focus:-translate-y-1 focus:shadow-xl"
                                   placeholder="Confirma tu nueva contraseña"
                                   required>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-black hover:bg-gray-900 text-white font-black py-6 px-8 rounded-2xl transition-all duration-500 hover:shadow-2xl flex items-center justify-center gap-4 text-lg border-2 border-black transform hover:scale-110 hover:-translate-y-3 hover:-rotate-1 animate-fade-in-up group"
                                style="animation-delay: 0.4s;">
                            <span class="text-2xl group-hover:animate-spin">🔐</span>
                            <span>Cambiar Contraseña</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Información de la cuenta con animaciones -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mt-8 border-4 border-black transform transition-all duration-700 hover:scale-105 animate-fade-in-up hover:shadow-3xl hover:-translate-y-2">
                <div class="flex items-center gap-4 mb-8 animate-fade-in">
                    <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center border-2 border-black transform transition-all duration-300 hover:rotate-12 hover:scale-110">
                        <span class="text-3xl animate-pulse">ℹ️</span>
                    </div>
                    <h2 class="text-3xl font-black text-black animate-slide-in-right">Información de la Cuenta</h2>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gray-100 rounded-2xl p-8 border-4 border-black transform transition-all duration-500 hover:scale-105 hover:-translate-y-1 hover:rotate-1 animate-slide-in-left">
                        <p class="text-base font-black text-gray-800 mb-4">Rol en el Sistema</p>
                        <div class="flex items-center gap-4">
                            <span class="text-3xl animate-bounce">👤</span>
                            <span class="text-2xl font-black text-black capitalize">{{ $user->role }}</span>
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-2xl p-8 border-4 border-black transform transition-all duration-500 hover:scale-105 hover:-translate-y-1 hover:-rotate-1 animate-slide-in-right">
                        <p class="text-base font-black text-gray-800 mb-4">Miembro Desde</p>
                        <div class="flex items-center gap-4">
                            <span class="text-3xl animate-pulse">📅</span>
                            <span class="text-2xl font-black text-black">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de logout con animaciones -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mt-8 border-4 border-black transform transition-all duration-700 hover:scale-105 animate-fade-in-up hover:shadow-3xl hover:-translate-y-2">
                <div class="flex items-center gap-4 mb-8 animate-fade-in">
                    <div class="w-16 h-16 bg-black rounded-2xl flex items-center justify-center border-2 border-black transform transition-all duration-300 hover:rotate-12 hover:scale-110">
                        <span class="text-3xl animate-bounce">🚪</span>
                    </div>
                    <div class="animate-slide-in-right">
                        <h2 class="text-3xl font-black text-black">Cerrar Sesión</h2>
                        <p class="text-gray-700 mt-2 text-lg font-medium">Termina tu sesión actual de forma segura</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="flex flex-col sm:flex-row gap-6 items-center">
                    @csrf
                    <div class="bg-gray-100 rounded-2xl p-6 border-4 border-black flex-grow transform transition-all duration-500 hover:scale-105 hover:-translate-y-1 animate-slide-in-left">
                        <p class="text-gray-800 text-base font-bold">
                            Al cerrar sesión, serás redirigido a la página de inicio. Asegúrate de haber guardado todos tus cambios.
                        </p>
                    </div>
                    <button type="submit" 
                            class="bg-black hover:bg-gray-900 text-white font-black px-10 py-6 rounded-2xl transition-all duration-500 hover:shadow-2xl flex items-center gap-4 whitespace-nowrap text-lg border-2 border-black transform hover:scale-110 hover:-translate-y-3 hover:rotate-2 animate-slide-in-right group"
                            onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                        <span class="text-2xl group-hover:animate-spin">🔓</span>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translate3d(0, -30px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translate3d(0, 30px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes fade-in-left {
    from {
        opacity: 0;
        transform: translate3d(-30px, 0, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes fade-in-right {
    from {
        opacity: 0;
        transform: translate3d(30px, 0, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes slide-in-left {
    from {
        opacity: 0;
        transform: translate3d(-100px, 0, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes slide-in-right {
    from {
        opacity: 0;
        transform: translate3d(100px, 0, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes slide-in-up {
    from {
        opacity: 0;
        transform: translate3d(0, 20px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes bounce-in {
    0%, 20%, 40%, 60%, 80%, 100% {
        animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
    }
    0% {
        opacity: 0;
        transform: scale3d(.3, .3, .3);
    }
    20% {
        transform: scale3d(1.1, 1.1, 1.1);
    }
    40% {
        transform: scale3d(.9, .9, .9);
    }
    60% {
        opacity: 1;
        transform: scale3d(1.03, 1.03, 1.03);
    }
    80% {
        transform: scale3d(.97, .97, .97);
    }
    100% {
        opacity: 1;
        transform: scale3d(1, 1, 1);
    }
}

@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(5px);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.8s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
    opacity: 0;
    animation-fill-mode: both;
}

.animate-fade-in-left {
    animation: fade-in-left 0.8s ease-out forwards;
}

.animate-fade-in-right {
    animation: fade-in-right 0.8s ease-out forwards;
}

.animate-slide-in-left {
    animation: slide-in-left 1s ease-out forwards;
}

.animate-slide-in-right {
    animation: slide-in-right 1s ease-out forwards;
}

.animate-slide-in-up {
    animation: slide-in-up 0.6s ease-out forwards;
}

.animate-bounce-in {
    animation: bounce-in 1.2s ease-out forwards;
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}

.animate-fade-in {
    animation: fade-in-up 1s ease-out forwards;
}
</style>

@include('layouts.footer')
@endsection