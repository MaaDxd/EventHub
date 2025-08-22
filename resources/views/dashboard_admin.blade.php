@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header del Dashboard -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Panel de Administración</h1>
                    <p class="text-gray-600 mt-2">Bienvenido, {{ auth()->user()->name }}! Gestiona usuarios y eventos desde aquí.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🏠 Ir al Inicio
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            🚪 Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Estadísticas Generales -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Usuarios -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mr-4">👥</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Usuarios</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalUsers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Usuarios Activos -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mr-4">✅</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Usuarios Activos</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $activeUsers ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Eventos -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mr-4">🎉</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Eventos</h3>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalEvents ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Eventos Activos -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="text-3xl mr-4">🎊</div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Eventos Activos</h3>
                        <p class="text-2xl font-bold text-indigo-600">{{ $activeEvents ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Opciones de Gestión -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Gestión de Usuarios -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-6xl mb-4">👥</div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Gestión de Usuarios</h3>
                    <p class="text-gray-600 mb-6">Administra usuarios, roles y permisos. Realiza eliminado lógico y restauración de cuentas.</p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.users') }}" class="block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                            📋 Ver Todos los Usuarios
                        </a>
                        <a href="{{ route('admin.users', ['status' => 'active']) }}" class="block bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200">
                            ✅ Usuarios Activos
                        </a>
                        <a href="{{ route('admin.users', ['status' => 'deleted']) }}" class="block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition duration-200">
                            🗑️ Usuarios Eliminados ({{ $deletedUsers ?? 0 }})
                        </a>
                    </div>
                </div>
            </div>

            <!-- Gestión de Eventos -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-6xl mb-4">🎉</div>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Gestión de Eventos</h3>
                    <p class="text-gray-600 mb-6">Supervisa eventos, modera contenido y gestiona el eliminado lógico de eventos.</p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.events') }}" class="block bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                            📋 Ver Todos los Eventos
                        </a>
                        <a href="{{ route('admin.events', ['status' => 'active']) }}" class="block bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200">
                            ✅ Eventos Activos
                        </a>
                        <a href="{{ route('admin.events', ['status' => 'deleted']) }}" class="block bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition duration-200">
                            🗑️ Eventos Eliminados ({{ $deletedEvents ?? 0 }})
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">🚀 Acciones Rápidas</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <a href="{{ route('admin.users', ['role' => 'admin']) }}" class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg transition duration-200 text-center">
                    <div class="text-2xl mb-2">⚙️</div>
                    <div class="font-semibold">Administradores</div>
                </a>
                <a href="{{ route('admin.users', ['role' => 'creator']) }}" class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg transition duration-200 text-center">
                    <div class="text-2xl mb-2">🎨</div>
                    <div class="font-semibold">Creadores</div>
                </a>
                <a href="{{ route('admin.users', ['role' => 'user']) }}" class="bg-gray-100 hover:bg-gray-200 p-4 rounded-lg transition duration-200 text-center">
                    <div class="text-2xl mb-2">👤</div>
                    <div class="font-semibold">Usuarios</div>
                </a>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection