@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Todos los Eventos</h1>
            <p class="text-gray-600 text-lg">Descubre eventos increíbles creados por nuestra comunidad</p>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form method="GET" action="{{ route('events.public') }}" class="filter-form space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Búsqueda por texto -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            Buscar eventos
                        </label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Título, descripción o ubicación..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Filtro por categoría -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Categoría
                        </label>
                        <select id="category" 
                                name="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                            <option value="concierto" {{ request('category') == 'concierto' ? 'selected' : '' }}>
                                Concierto
                            </option>
                            <option value="evento" {{ request('category') == 'evento' ? 'selected' : '' }}>
                                Evento
                            </option>
                        </select>
                    </div>

                    <!-- Fecha desde -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">
                            Desde
                        </label>
                        <input type="date" 
                               id="date_from" 
                               name="date_from" 
                               value="{{ request('date_from') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <!-- Fecha hasta -->
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">
                            Hasta
                        </label>
                        <input type="date" 
                               id="date_to" 
                               name="date_to" 
                               value="{{ request('date_to') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-wrap gap-4 pt-4">
                    <button type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition duration-200 font-semibold">
                        🔍 Buscar
                    </button>
                    <a href="{{ route('events.public') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200 font-semibold">
                        🗑️ Limpiar Filtros
                    </a>
                </div>
            </form>
        </div>

        <!-- Resultados -->
        @if($events->count() > 0)
            <div class="mb-6">
                <p class="text-gray-600">
                    Mostrando {{ $events->firstItem() }} - {{ $events->lastItem() }} de {{ $events->total() }} eventos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <!-- Imagen del evento -->
                        <div class="h-48 bg-gray-200 relative">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-400 to-purple-600">
                                    <span class="text-4xl text-white">🎭</span>
                                </div>
                            @endif
                            <!-- Badge de fecha -->
                            <div class="absolute top-4 right-4 bg-purple-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                                {{ $event->date->format('d M') }}
                            </div>
                        </div>

                        <!-- Contenido del evento -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $event->description }}</p>

                            <!-- Información del evento -->
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-2">📅</span>
                                    <span>{{ $event->date->format('d/m/Y') }} a las {{ $event->time }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-2">📍</span>
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-2">👤</span>
                                    <span>Por {{ $event->creator->name }}</span>
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div class="flex justify-between items-center">
                                <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full" 
                                      style="background-color: {{ $event->category ? $event->category->color : '#8B5CF6' }}">
                                    {{ $event->category ? $event->category->name : ucfirst($event->category_type) }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $event->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="flex justify-center">
                {{ $events->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-16">
                <div class="text-8xl mb-6">🔍</div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">No se encontraron eventos</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    No hay eventos que coincidan con tus criterios de búsqueda. Intenta ajustar los filtros.
                </p>
                <a href="{{ route('events.public') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-lg transition duration-200 font-semibold text-lg">
                    Ver Todos los Eventos
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .filter-form {
        transition: all 0.3s ease;
    }

    .loading {
        opacity: 0.7;
        pointer-events: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.filter-form');
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');

    let searchTimeout;

    // Función para enviar el formulario automáticamente
    function autoSubmit() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            form.submit();
        }, 500); // Esperar 500ms después de que el usuario deje de escribir
    }

    // Agregar event listeners para búsqueda automática
    if (searchInput) {
        searchInput.addEventListener('input', autoSubmit);
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', () => {
            form.submit();
        });
    }

    if (dateFromInput) {
        dateFromInput.addEventListener('change', () => {
            form.submit();
        });
    }

    if (dateToInput) {
        dateToInput.addEventListener('change', () => {
            form.submit();
        });
    }

    // Mostrar indicador de carga durante la búsqueda
    form.addEventListener('submit', function() {
        form.classList.add('loading');
    });
});
</script>
@endsection
