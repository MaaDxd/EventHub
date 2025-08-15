@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header del Dashboard -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Panel del Creador</h1>
                    <p class="text-gray-600 mt-2">Bienvenido, {{ auth()->user()->name }}! Gestiona tus eventos aquí.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('events.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                        🎨 Crear Nuevo Evento
                    </a>
                    <a href="{{ route('welcome') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        🏠 Ir al Inicio
                    </a>
                </div>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="grid md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ auth()->user()->createdEvents()->count() }}</div>
                <div class="text-gray-600">Total de Eventos</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ auth()->user()->createdEvents()->where('status', 'published')->count() }}</div>
                <div class="text-gray-600">Eventos Publicados</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ auth()->user()->createdEvents()->where('status', 'draft')->count() }}</div>
                <div class="text-gray-600">Borradores</div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ auth()->user()->createdEvents()->where('date', '>=', now()->toDateString())->count() }}</div>
                <div class="text-gray-600">Próximos Eventos</div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Crear Evento -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Crear Evento</h3>
                    <p class="text-gray-600 mb-4">Crea un nuevo evento para tu audiencia</p>
                    <a href="{{ route('events.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Crear Evento
                    </a>
                </div>
            </div>

            <!-- Gestionar Eventos -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">📋</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mis Eventos</h3>
                    <p class="text-gray-600 mb-4">Gestiona todos tus eventos creados</p>
                    <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Ver Eventos
                    </a>
                </div>
            </div>

            <!-- Perfil -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200">
                <div class="text-center">
                    <div class="text-4xl mb-4">👤</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mi Perfil</h3>
                    <p class="text-gray-600 mb-4">Actualiza tu información personal</p>
                    <a href="{{ route('profile.show') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                        Ver Perfil
                    </a>
                </div>
            </div>
        </div>

        <!-- Eventos Recientes -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📅 Eventos Recientes</h2>
            @php
                $recentEvents = auth()->user()->createdEvents()->with('category')->latest()->take(5)->get();
            @endphp
            
            @if($recentEvents->count() > 0)
                <div class="space-y-4">
                    @foreach($recentEvents as $event)
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex items-center space-x-4">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-500">📷</span>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $event->date->format('d/m/Y') }} a las {{ $event->time }}</p>
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full" style="background-color: {{ $event->category->color }}">
                                        {{ $event->category->name }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('events.edit', $event) }}" class="text-blue-600 hover:text-blue-800">✏️</a>
                                <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">🎨</div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">No tienes eventos aún</h3>
                    <p class="text-gray-600 mb-4">Comienza creando tu primer evento</p>
                    <a href="{{ route('events.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition duration-200 font-semibold">
                        Crear Mi Primer Evento
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection