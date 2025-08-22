@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Gestión de Usuarios</h1>
                    <p class="text-gray-600 mt-2">Administra usuarios, roles y permisos del sistema</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('dashboard.admin') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        ← Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('admin.users') }}" class="grid md:grid-cols-4 gap-4">
                <!-- Búsqueda -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Nombre o email..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filtro por Estado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activos</option>
                        <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>Eliminados</option>
                    </select>
                </div>

                <!-- Filtro por Rol -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rol</label>
                    <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todos los roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="creator" {{ request('role') === 'creator' ? 'selected' : '' }}>Creador</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>Usuario</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🔍 Buscar
                    </button>
                    <a href="{{ route('admin.users') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🔄 Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de Usuarios -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eventos Creados</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="{{ $user->trashed() ? 'bg-red-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">
                                            @if($user->role === 'admin') ⚙️
                                            @elseif($user->role === 'creator') 🎨
                                            @else 👤
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            @if($user->phone)
                                                <div class="text-sm text-gray-500">📞 {{ $user->phone }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($user->role === 'admin') bg-red-100 text-red-800
                                        @elseif($user->role === 'creator') bg-purple-100 text-purple-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->createdEvents->count() }} eventos
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->trashed())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            🗑️ Eliminado
                                        </span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $user->deleted_at->format('d/m/Y H:i') }}
                                        </div>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            ✅ Activo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($user->trashed())
                                        <!-- Usuario eliminado - opciones de restaurar o eliminar permanentemente -->
                                        <div class="flex space-x-2">
                                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 px-2 py-1 rounded text-xs"
                                                        onclick="return confirm('¿Estás seguro de que quieres restaurar este usuario?')">
                                                    ↩️ Restaurar
                                                </button>
                                            </form>
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-2 py-1 rounded text-xs"
                                                            onclick="return confirm('¿Estás seguro? Esta acción eliminará permanentemente al usuario y NO se puede deshacer.')">
                                                        🗑️ Eliminar Permanentemente
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @else
                                        <!-- Usuario activo - opción de eliminar lógicamente -->
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-2 py-1 rounded text-xs"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario? Podrás restaurarlo después.')">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs">No puedes eliminarte</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron usuarios con los filtros aplicados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($users->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
