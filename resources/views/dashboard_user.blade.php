@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header del Dashboard -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard Usuario</h1>
                    <p class="text-gray-600 mt-2">Bienvenido, {{ auth()->user()->name }}! Este es tu panel de control.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🏠 Ir al Inicio
                    </a>
                </div>
            </div>
        </div>

        <!-- Opciones del Dashboard -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Perfil -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">👤</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mi Perfil</h3>
                    <p class="text-gray-600 mb-4">Actualiza tu información personal y contraseña</p>
                    <a href="{{ route('profile.show') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Ver Perfil
                    </a>
                </div>
            </div>

            <!-- Eventos -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">🎫</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mis Eventos</h3>
                    <p class="text-gray-600 mb-4">Ve los eventos a los que te has registrado</p>
                    <button class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                        Próximamente
                    </button>
                </div>
            </div>

            <!-- Configuración -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">⚙️</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Configuración</h3>
                    <p class="text-gray-600 mb-4">Ajusta las preferencias de tu cuenta</p>
                    <button class="bg-gray-400 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                        Próximamente
                    </button>
                </div>
            </div>
        </div>

        <!-- Información de la cuenta -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📊 Resumen de la Cuenta</h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ auth()->user()->role }}</div>
                    <div class="text-sm text-gray-600">Tipo de Usuario</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ auth()->user()->created_at->format('d/m/Y') }}</div>
                    <div class="text-sm text-gray-600">Miembro desde</div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">0</div>
                    <div class="text-sm text-gray-600">Eventos Registrados</div>
                </div>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">🚀 Acciones Rápidas</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    🏠 Explorar Eventos
                </a>
                <a href="{{ route('profile.show') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    ✏️ Editar Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200"
                            onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                        🔓 Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection