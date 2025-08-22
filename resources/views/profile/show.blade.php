@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#1A0046] to-[#32004E] py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white/90 rounded-2xl shadow-2xl p-8 mb-8 border border-[#1A0046]/10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-[#1A0046] mb-2 tracking-tight drop-shadow-lg">Mi Perfil</h1>
                <p class="text-lg text-[#32004E] mb-2">Gestiona tu información personal y seguridad.</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('welcome') }}" class="bg-gradient-to-r from-[#1A0046] to-[#32004E] hover:from-[#32004E] hover:to-[#1A0046] text-white px-5 py-2 rounded-xl font-semibold shadow-lg transition-all duration-200 flex items-center gap-2">
                    🏠 Ir al Inicio
                </a>
                <a href="{{ route('dashboard.user') }}" class="bg-white/10 hover:bg-white/30 text-[#1A0046] hover:text-[#32004E] px-5 py-2 rounded-xl font-semibold shadow-lg transition-all duration-200 flex items-center gap-2 backdrop-blur-md border border-[#1A0046]/10">
                    📊 Dashboard
                </a>
            </div>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Formulario de Información Personal -->
            <div class="bg-white/90 rounded-2xl shadow-lg p-8 border border-[#1A0046]/10">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-4 flex items-center gap-2">📝 Información Personal</h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-[#32004E] mb-2">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border border-[#1A0046]/20 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:border-transparent bg-white/80 text-[#1A0046]" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-[#32004E] mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border border-[#1A0046]/20 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:border-transparent bg-white/80 text-[#1A0046]" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-[#1A0046] to-[#32004E] hover:from-[#32004E] hover:to-[#1A0046] text-white font-medium py-2 px-4 rounded-xl shadow-lg transition-all duration-200 flex items-center gap-2 justify-center">
                        💾 Actualizar Información
                    </button>
                </form>
            </div>

            <!-- Formulario de Cambio de Contraseña -->
            <div class="bg-white/90 rounded-2xl shadow-lg p-8 border border-[#1A0046]/10">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-4 flex items-center gap-2">🔒 Cambiar Contraseña</h2>
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-[#32004E] mb-2">Contraseña Actual</label>
                        <input type="password" id="current_password" name="current_password" class="w-full px-3 py-2 border border-[#1A0046]/20 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:border-transparent bg-white/80 text-[#1A0046]" required>
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-[#32004E] mb-2">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-[#1A0046]/20 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:border-transparent bg-white/80 text-[#1A0046]" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-[#32004E] mb-2">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border border-[#1A0046]/20 rounded-md focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:border-transparent bg-white/80 text-[#1A0046]" required>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-700 hover:from-red-700 hover:to-red-500 text-white font-medium py-2 px-4 rounded-xl shadow-lg transition-all duration-200 flex items-center gap-2 justify-center">
                        🔐 Cambiar Contraseña
                    </button>
                </form>
            </div>
        </div>

        <!-- Información de la cuenta -->
        <div class="bg-white/90 rounded-2xl shadow-lg p-8 mt-8 border border-[#1A0046]/10">
            <h2 class="text-2xl font-bold text-[#1A0046] mb-4 flex items-center gap-2">ℹ️ Información de la Cuenta</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Rol:</p>
                    <p class="font-medium text-[#32004E] capitalize">{{ $user->role }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Miembro desde:</p>
                    <p class="font-medium text-[#32004E]">{{ $user->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Botón de logout -->
        <div class="bg-white/90 rounded-2xl shadow-lg p-8 mt-8 border border-[#1A0046]/10">
            <h2 class="text-2xl font-bold text-[#1A0046] mb-4 flex items-center gap-2">🚪 Cerrar Sesión</h2>
            <p class="text-[#32004E] mb-4">Si deseas cerrar tu sesión completamente, puedes hacerlo aquí.</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-red-500 to-red-700 hover:from-red-700 hover:to-red-500 text-white px-6 py-2 rounded-xl font-semibold shadow-lg transition-all duration-200 flex items-center gap-2 justify-center" onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                    🔓 Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection