@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mis Eventos</h1>
                    <p class="text-gray-600 mt-2">Gestiona todos tus eventos creados</p>
                </div>
                <a href="{{ route('events.create') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                    + Crear Nuevo Evento
                </a>
            </div>
            <!-- Botones de navegación -->
            <div class="mt-4 flex items-center gap-4">
                <button onclick="if (history.length > 1) { history.back(); } else { window.location.href='{{ url('/') }}'; }"
                        class="inline-flex items-center gap-2 bg-white text-gray-800 px-5 py-2.5 rounded-xl shadow-sm hover:shadow-md border border-gray-200 transition">
                    <span class="text-lg">‹</span>
                    <span>Volver Atrás</span>
                </button>
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center gap-2 bg-white text-gray-800 px-5 py-2.5 rounded-xl shadow-sm hover:shadow-md border border-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Página Principal</span>
                </a>
            </div>
        </div>

        <!-- Eventos -->
        @if($events->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        <a href="{{ route('events.show', $event) }}" class="block focus:outline-none">
                            <!-- Imagen del evento -->
                            <div class="h-48 bg-gray-200 relative">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-6xl text-gray-400">📷</span>
                                    </div>
                                @endif
                                <!-- Badge de estado -->
                                <div class="absolute top-4 right-4">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full 
                                        {{ $event->status === 'published' ? 'bg-green-500' : ($event->status === 'draft' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido del evento -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">{{ $event->title }}</h3>
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($event->description, 120) }}</p>

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
                                        <span class="mr-2">🗂</span>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full"
                                              @if($event->category?->color)
                                                  style="background-color: {{ $event->category->color }}"
                                              @else
                                                  style="background-color: #6366f1"
                                              @endif>
                                            {{ $event->category ? $event->category->name : ucfirst($event->category_type) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Acciones -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200 px-6 pb-6">
                            <div class="flex space-x-2">
                                <a href="{{ route('events.edit', $event) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    ✏️ Editar
                                </a>
                                <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline" 
                                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                            <span class="text-xs text-gray-500">
                                Creado {{ $event->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-16">
                <div class="text-8xl mb-6">🎨</div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">No tienes eventos aún</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Comienza creando tu primer evento para compartir con tu audiencia
                </p>
                <a href="{{ route('events.create') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-lg transition duration-200 font-semibold text-lg">
                    Crear Mi Primer Evento
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
