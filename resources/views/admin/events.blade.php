@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Gestión de Eventos</h1>
                    <p class="text-gray-600 mt-2">Supervisa y modera eventos del sistema</p>
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
            <form method="GET" action="{{ route('admin.events') }}" class="grid md:grid-cols-3 gap-4">
                <!-- Búsqueda -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Título, descripción o ubicación..." 
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

                <!-- Botones -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🔍 Buscar
                    </button>
                    <a href="{{ route('admin.events') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
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

        <!-- Tabla de Eventos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creador</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha/Hora</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($events as $event)
                            <tr class="{{ $event->trashed() ? 'bg-red-50' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-start">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" 
                                                 class="w-16 h-16 object-cover rounded-lg mr-4">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg mr-4 flex items-center justify-center text-2xl">
                                                🎉
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                            <div class="text-sm text-gray-500 mt-1">{{ Str::limit($event->description, 100) }}</div>
                                            <div class="text-sm text-gray-500 mt-1">📍 {{ $event->location }}</div>
                                            @if($event->category)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                                    {{ $event->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-2">
                                            @if($event->creator->role === 'admin') ⚙️
                                            @elseif($event->creator->role === 'creator') 🎨
                                            @else 👤
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $event->creator->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $event->creator->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div>📅 {{ $event->date->format('d/m/Y') }}</div>
                                    <div>🕐 {{ $event->time->format('H:i') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Creado: {{ $event->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($event->trashed())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            🗑️ Eliminado
                                        </span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $event->deleted_at->format('d/m/Y H:i') }}
                                        </div>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($event->status === 'published') bg-green-100 text-green-800
                                            @elseif($event->status === 'draft') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            @if($event->status === 'published') ✅ Publicado
                                            @elseif($event->status === 'draft') 📝 Borrador
                                            @else ❌ Cancelado
                                            @endif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($event->trashed())
                                        <!-- Evento eliminado - opciones de restaurar o eliminar permanentemente -->
                                        <div class="flex flex-col space-y-1">
                                            <form method="POST" action="{{ route('admin.events.restore', $event->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 bg-green-100 hover:bg-green-200 px-2 py-1 rounded text-xs w-full"
                                                        onclick="return confirm('¿Estás seguro de que quieres restaurar este evento?')">
                                                    ↩️ Restaurar
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.events.force-delete', $event->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-2 py-1 rounded text-xs w-full"
                                                        onclick="return confirm('¿Estás seguro? Esta acción eliminará permanentemente el evento y NO se puede deshacer.')">
                                                    🗑️ Eliminar Permanentemente
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Evento activo - opción de eliminar lógicamente -->
                                        <form method="POST" action="{{ route('admin.events.delete', $event->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-2 py-1 rounded text-xs"
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este evento? Podrás restaurarlo después.')">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron eventos con los filtros aplicados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($events->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $events->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
