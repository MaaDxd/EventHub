@extends('layouts.app')

@section('content')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<!-- Add CSRF token meta tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    .event-detail-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        min-height: 100vh;
    }
    
    .event-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.4);
    }
    
    /* Animación para mensajes flash */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out forwards;
    }
    
    .info-item {
        background: rgba(26, 0, 70, 0.05);
        border: 1px solid rgba(26, 0, 70, 0.1);
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        background: rgba(26, 0, 70, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.15);
    }
    
    .back-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.4);
        color: white;
    }
    
    .event-image {
        border: 3px solid rgba(26, 0, 70, 0.1);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.2);
    }
    
    .category-badge {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        box-shadow: 0 4px 15px rgba(26, 0, 70, 0.3);
    }
    
    .icon-accent {
        color: #1A0046;
    }
    
    .map-placeholder {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.1), rgba(50, 0, 78, 0.05));
        border: 2px dashed rgba(26, 0, 70, 0.3);
    }
</style>

<div class="event-detail-bg">
    <div class="container mx-auto px-4 py-8">
        <!-- Mensajes Flash -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in flex items-center" role="alert">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md animate-fade-in flex items-center" role="alert">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="back-btn inline-flex items-center px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver
            </a>
        </div>

        <!-- Event Header -->
        <div class="text-center mb-8 relative">
            <!-- Botón de favoritos en esquina superior derecha -->
            @auth
                <div class="absolute -top-2 -right-2 z-20">
                    <button onclick="toggleFavorite({{ $event->id }}, this)"
                            class="favorite-btn group relative flex items-center justify-center w-20 h-20 rounded-full transition-all duration-500 hover:scale-110 transform shadow-2xl border-3 border-white/60 backdrop-blur-lg overflow-hidden"
                            data-event-id="{{ $event->id }}"
                            data-is-favorite="{{ Auth::user()->hasFavorite($event->id) ? 'true' : 'false' }}"
                            data-url="{{ route('favorites.store', $event) }}"
                            style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #e0f2fe 100%);">
                        
                        <!-- Fondo con gradiente sutil -->
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-100/20 via-white/10 to-red-100/20 rounded-full"></div>
                        
                        <!-- Corazón principal con diseño mejorado -->
                        <svg class="w-10 h-10 transition-all duration-500 relative z-10 {{ Auth::user()->hasFavorite($event->id) ? 'text-red-500 scale-110 drop-shadow-lg' : 'text-gray-700 group-hover:text-red-500 group-hover:scale-105' }}" 
                             fill="{{ Auth::user()->hasFavorite($event->id) ? 'currentColor' : 'none' }}" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24" 
                             stroke-width="2.5"
                             style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        
                        <!-- Efectos de animación mejorados -->
                        @if(Auth::user()->hasFavorite($event->id))
                            <!-- Pulso principal -->
                            <div class="absolute inset-0 rounded-full bg-red-500/40 animate-ping"></div>
                            <!-- Pulso secundario -->
                            <div class="absolute inset-0 rounded-full bg-red-400/30 animate-pulse"></div>
                            <!-- Brillo giratorio -->
                            <div class="absolute inset-0 rounded-full bg-gradient-to-r from-red-400/30 via-pink-400/30 to-red-400/30 animate-spin" style="animation-duration: 4s;"></div>
                            <!-- Efecto de resplandor -->
                            <div class="absolute inset-0 rounded-full bg-red-400/20 blur-sm"></div>
                        @endif
                        
                        <!-- Efecto de hover mejorado -->
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-red-400/0 via-pink-400/0 to-red-400/0 group-hover:from-red-400/15 group-hover:via-pink-400/15 group-hover:to-red-400/15 transition-all duration-300"></div>
                        
                        <!-- Borde brillante en hover -->
                        <div class="absolute inset-0 rounded-full border-2 border-transparent group-hover:border-red-300/50 transition-all duration-300"></div>
                        
                        <!-- Tooltip mejorado -->
                        <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none z-30">
                            <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white text-sm px-4 py-3 rounded-xl whitespace-nowrap shadow-2xl border border-gray-600 backdrop-blur-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="text-red-400 text-lg">❤️</span>
                                    <span class="font-medium">{{ Auth::user()->hasFavorite($event->id) ? 'Eliminar evento de favoritos' : 'Agregar evento a favoritos' }}</span>
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
            @endauth
            
            <div class="flex justify-center items-center mb-4">
                <h1 class="text-4xl md:text-5xl font-bold text-white">{{ $event->title }}</h1>
            </div>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">{{ $event->description }}</p>
            @auth
                <div class="mt-6 flex flex-col items-center space-y-4">
                    <!-- Primer cuadro - Mensaje principal -->
                    <div class="bg-gradient-to-r from-white/10 to-white/5 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-4 shadow-xl">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></div>
                            <span class="text-white font-medium text-sm drop-shadow-lg">💖 Guarda este evento en tus favoritos</span>
                        </div>
                    </div>
                    
                    <!-- Segundo cuadro - Instrucciones -->
                    <div class="bg-gradient-to-r from-blue-500/10 to-purple-500/10 backdrop-blur-sm border border-blue-400/30 rounded-2xl px-6 py-4 shadow-xl">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-blue-400 animate-pulse"></div>
                            <span class="text-white text-sm drop-shadow-md font-medium">📍 Haz clic en el corazón de la esquina superior derecha</span>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column - Event Image -->
            <div class="lg:col-span-1">
                <div class="event-card rounded-2xl p-6">
                    <div class="event-image rounded-xl overflow-hidden mb-6">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-[#1A0046] to-[#32004E]">
                                <span class="text-6xl text-white opacity-90">🎭</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Category Badge -->
                    <div class="text-center">
                        <span class="category-badge inline-block px-4 py-2 rounded-full text-sm font-bold">
                            {{ $event->category ? $event->category->name : 'Sin categoría' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Event Information -->
            <div class="lg:col-span-2">
                <div class="event-card rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-[#1A0046] mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Información General
                    </h2>
                    
                    <div class="grid md:grid-cols-2 gap-4 mb-8">
                        <!-- Date -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Fecha del Evento</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->date->format('d \d\e M \d\e Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Hora de apertura de puertas</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->time }}</p>
                                </div>
                            </div>
                        </div>



                        <!-- Artist/Creator -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Artista</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->creator->name ?? 'No especificado' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Lugar</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Map Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-[#1A0046] mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                            </svg>
                            Ubicación
                        </h3>
                        <div id="map" class="rounded-xl h-64 overflow-hidden"></div>
                        <p class="text-[#1A0046] font-semibold mt-3 text-center">{{ $event->location }}</p>
                    </div>

                    <!-- Recommendations Section -->
                    <div class="bg-gradient-to-r from-[#1A0046]/5 to-[#32004E]/5 rounded-xl p-6 border border-[#1A0046]/10">
                        <h3 class="text-xl font-bold text-[#1A0046] mb-4">Recomendaciones</h3>
                        <div class="space-y-3 text-sm text-gray-700">
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Evento para mayores de edad, se requiere identificación de seguridad.
                            </p>
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Cupos limitados.
                            </p>
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Advertencia de compra: Advertencia de compra ALL TICKETS TU BOLETA.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Comentarios -->
        <div class="mt-8">
            <div class="event-card rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-[#1A0046] mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Comentarios y Preguntas
                </h3>

                @auth
                    <!-- Formulario para nuevo comentario -->
                    <div class="mb-8 bg-gradient-to-r from-[#1A0046]/5 to-[#32004E]/5 rounded-xl p-6 border border-[#1A0046]/10">
                        <form id="comment-form" action="{{ route('events.comments.store', $event) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-[#1A0046] mb-2">
                                    Deja tu comentario o pregunta sobre el evento
                                </label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="4" 
                                    maxlength="500"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1A0046] focus:border-transparent resize-none"
                                    placeholder="Escribe tu comentario aquí... (máximo 500 caracteres)"
                                    required
                                ></textarea>
                                <div class="text-right mt-2">
                                    <span id="char-count" class="text-sm text-gray-500">0/500</span>
                                </div>
                            </div>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 focus:ring-4 focus:ring-purple-300"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Enviar Comentario
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mb-8 bg-gray-50 rounded-xl p-6 text-center">
                        <p class="text-gray-600 mb-4">Inicia sesión para dejar un comentario o hacer una pregunta</p>
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-[#1A0046] hover:bg-[#32004E] text-white font-semibold rounded-xl transition-all duration-300">
                            Iniciar Sesión
                        </a>
                    </div>
                @endauth

                <!-- Lista de comentarios -->
                <div id="comments-list" class="space-y-6">
                    @forelse($event->mainComments as $comment)
                        <div class="comment-item border border-gray-200 rounded-xl p-6 bg-white">
                            <!-- Comentario principal -->
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-[#1A0046]">{{ $comment->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @auth
                                            @if($comment->user_id === Auth::id() || $event->creator_id === Auth::id())
                                                <button 
                                                    onclick="deleteComment({{ $comment->id }})" 
                                                    class="text-red-500 hover:text-red-700 text-sm"
                                                >
                                                    Eliminar
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                                    
                                    @auth
                                        @if($event->creator_id === Auth::id() && !$comment->replies->count())
                                            <button 
                                                onclick="showReplyForm({{ $comment->id }})" 
                                                class="mt-3 text-purple-600 hover:text-purple-800 text-sm font-medium"
                                            >
                                                Responder
                                            </button>
                                        @endif
                                    @endauth
                                </div>
                            </div>

                            <!-- Formulario de respuesta (oculto por defecto) -->
                            @auth
                                @if($event->creator_id === Auth::id())
                                    <div id="reply-form-{{ $comment->id }}" class="mt-4 ml-14 hidden">
                                        <form class="reply-form" data-comment-id="{{ $comment->id }}">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <div class="mb-4">
                                                <textarea 
                                                    name="content" 
                                                    rows="3" 
                                                    maxlength="500"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                                                    placeholder="Escribe tu respuesta... (máximo 500 caracteres)"
                                                    required
                                                ></textarea>
                                            </div>
                                            <div class="flex space-x-3">
                                                <button 
                                                    type="submit" 
                                                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg transition-all duration-300"
                                                >
                                                    Responder
                                                </button>
                                                <button 
                                                    type="button" 
                                                    onclick="hideReplyForm({{ $comment->id }})" 
                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm font-semibold rounded-lg transition-all duration-300"
                                                >
                                                    Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth

                            <!-- Respuestas del creador -->
                            @if($comment->replies->count())
                                <div class="mt-4 ml-14 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="border-l-4 border-purple-500 pl-4 bg-purple-50 rounded-r-xl p-4">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <div>
                                                            <h5 class="font-semibold text-purple-700">{{ $reply->user->name }} <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full">Organizador</span></h5>
                                                            <p class="text-xs text-purple-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        @auth
                                                            @if($reply->user_id === Auth::id())
                                                                <button 
                                                                    onclick="deleteComment({{ $reply->id }})"
                                                                    class="text-red-500 hover:text-red-700 text-xs"
                                                                >
                                                                    Eliminar
                                                                </button>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                    <p class="text-purple-800 text-sm leading-relaxed">{{ $reply->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="text-lg">Aún no hay comentarios</p>
                            <p class="text-sm">¡Sé el primero en comentar sobre este evento!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    // Set base URL for JavaScript
    const baseUrl = '{{ request()->root() }}/';
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map
        initializeMap();
        
        // Initialize comment functionality
        initializeComments();
    });

    function initializeMap() {
        // Show loading indicator
        document.getElementById('map').innerHTML = `
            <div class="h-full flex items-center justify-center bg-gray-50">
                <div class="text-center p-4">
                    <div class="w-12 h-12 mx-auto border-4 border-[#1A0046] border-t-transparent rounded-full animate-spin mb-2"></div>
                    <p class="text-[#1A0046] font-medium">Cargando mapa...</p>
                </div>
            </div>
        `;
        
        // Initialize map after brief delay
        setTimeout(function() {
            var map = L.map('map', {
                zoomControl: false,
                dragging: false,
                touchZoom: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                keyboard: false,
                tap: false
            }).setView([0, 0], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                className: 'map-tiles'
            }).addTo(map);
            
            var eventLocation = "{{ $event->location }}";
            
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(eventLocation)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lon = parseFloat(data[0].lon);
                        
                        map.setView([lat, lon], 15);
                        
                        var customIcon = L.divIcon({
                            className: 'custom-div-icon',
                            html: `<div class="marker-pin" style="background-color: #1A0046; width: 30px; height: 30px; border-radius: 50%; display: flex; justify-content: center; align-items: center; box-shadow: 0 0 10px rgba(26, 0, 70, 0.5), 0 0 20px rgba(26, 0, 70, 0.3);"><svg style="width: 16px; height: 16px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>`,
                            iconSize: [30, 30],
                            iconAnchor: [15, 15]
                        });
                        
                        L.marker([lat, lon], {icon: customIcon}).addTo(map);
                        
                        L.circle([lat, lon], {
                            color: '#1A0046',
                            fillColor: '#32004E',
                            fillOpacity: 0.2,
                            radius: 200,
                            className: 'pulse-circle'
                        }).addTo(map);
                        
                        L.circle([lat, lon], {
                            color: '#1A0046',
                            fillColor: '#32004E',
                            fillOpacity: 0.4,
                            radius: 50
                        }).addTo(map);
                        
                        // Add CSS for animations
                        var style = document.createElement('style');
                        style.innerHTML = `
                            @keyframes pulse {
                                0% { opacity: 0.6; transform: scale(0.8); }
                                50% { opacity: 0.3; transform: scale(1.2); }
                                100% { opacity: 0.6; transform: scale(0.8); }
                            }
                            .pulse-circle {
                                animation: pulse 2s infinite ease-in-out;
                            }
                            .map-tiles {
                                filter: saturate(0.8) contrast(1.1) brightness(1.05);
                            }
                        `;
                        document.head.appendChild(style);
                    } else {
                        showMapError('No se pudo cargar el mapa para esta ubicación');
                    }
                })
                .catch(error => {
                    console.error('Error al geocodificar la dirección:', error);
                    showMapError('Error al cargar el mapa');
                });
        }, 500);
    }

    function showMapError(message) {
        document.getElementById('map').innerHTML = `
            <div class="h-full flex items-center justify-center bg-gray-100">
                <div class="text-center p-4">
                    <svg class="w-12 h-12 mx-auto text-[#1A0046] opacity-50 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-[#1A0046] font-medium">${message}</p>
                </div>
            </div>
        `;
    }

    function initializeComments() {
        // Character counter
        const contentTextarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');
        
        if (contentTextarea && charCount) {
            contentTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = currentLength + '/500';
                
                if (currentLength > 450) {
                    charCount.style.color = '#ef4444';
                } else if (currentLength > 400) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#6b7280';
                }
            });
        }

        // Main comment form
        const commentForm = document.getElementById('comment-form');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                submitButton.disabled = true;
                submitButton.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Enviando...';
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        // Clear the form
                        document.getElementById('content').value = '';
                        document.getElementById('char-count').textContent = '0/500';
                        document.getElementById('char-count').style.color = '#6b7280';
                        
                        // Show success message
                        showToast(data.message || 'Comentario enviado exitosamente!', 'success');
                        
                        // Reload after a short delay to show the toast
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else if (data && data.error) {
                        alert(data.error);
                    } else {
                        alert('Error al enviar el comentario. Por favor intenta de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Check if it's a network error or server error
                    if (error.message.includes('Failed to fetch')) {
                        alert('Error de conexión. Verifica tu conexión a internet e intenta de nuevo.');
                    } else if (error.message.includes('422')) {
                        alert('Error de validación. Verifica que el comentario no esté vacío y tenga menos de 500 caracteres.');
                    } else if (error.message.includes('401')) {
                        alert('Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
                        window.location.href = '{{ route("login") }}';
                    } else if (error.message.includes('403')) {
                        alert('No tienes permisos para comentar en este evento.');
                    } else {
                        alert('Error al enviar el comentario. Por favor intenta de nuevo.');
                    }
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
            });
        }

        // Reply forms
        document.querySelectorAll('.reply-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                submitButton.disabled = true;
                submitButton.innerHTML = 'Enviando...';
                
                fetch('{{ route("events.comments.store", $event) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 401) {
                            alert('Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
                            window.location.href = baseUrl + 'login';
                            return;
                        }
                        if (response.status === 419) {
                            alert('Token CSRF expirado. La página se recargará.');
                            location.reload();
                            return;
                        }
                        if (response.status === 422) {
                            return response.json().then(data => {
                                let errorMessage = 'Error de validación: ';
                                if (data.errors) {
                                    errorMessage += Object.values(data.errors).flat().join(', ');
                                } else {
                                    errorMessage += data.message || 'Datos inválidos';
                                }
                                alert(errorMessage);
                            });
                        }
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        showToast(data.message || 'Respuesta enviada exitosamente!', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else if (data && data.error) {
                        alert(data.error);
                    } else {
                        alert('Error al enviar la respuesta. Por favor intenta de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al enviar la respuesta. Por favor intenta de nuevo.');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                });
            });
        });
    }

    // Reply form functions
    function showReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm) {
            replyForm.classList.remove('hidden');
        }
    }

    function hideReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm) {
            replyForm.classList.add('hidden');
        }
    }

    // Delete comment function
    function deleteComment(commentId) {
        if (confirm('¿Estás seguro de que quieres eliminar este comentario?')) {
        fetch(baseUrl + `comments/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                // Check if response is ok
                if (!response.ok) {
                    if (response.status === 401) {
                        alert('Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
                        window.location.href = baseUrl + '/login';
                        return;
                    }
                    if (response.status === 403) {
                        alert('No tienes permisos para eliminar este comentario.');
                        return;
                    }
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    location.reload();
                } else if (data && data.error) {
                    alert(data.error);
                } else {
                    alert('Error al eliminar el comentario.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar el comentario. Revisa la consola para más detalles.');
            });
        }
    }

    // Favorite toggle function
    function toggleFavorite(eventId, button) {
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';
        const icon = button.querySelector('svg');
        
        button.disabled = true;
        button.style.opacity = '0.7';
        
        const url = button.getAttribute('data-url');
        const method = isFavorite ? 'DELETE' : 'POST';
        
        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.setAttribute('data-is-favorite', data.is_favorite ? 'true' : 'false');
                
                if (data.is_favorite) {
                    icon.className = 'w-10 h-10 transition-all duration-500 relative z-10 text-red-500 scale-110 drop-shadow-lg';
                    icon.setAttribute('fill', 'currentColor');
                    
                    // Add animation effects
                    const effects = ['animate-ping', 'animate-pulse', 'animate-spin'];
                    effects.forEach((effect, index) => {
                        const element = document.createElement('div');
                        element.className = `absolute inset-0 rounded-full bg-red-500/40 ${effect}`;
                        if (effect === 'animate-spin') {
                            element.style.animationDuration = '4s';
                        }
                        button.appendChild(element);
                    });
                    
                    button.style.transform = 'scale(1.3) rotate(5deg)';
                    setTimeout(() => {
                        button.style.transform = 'scale(1) rotate(0deg)';
                    }, 300);
                } else {
                    icon.className = 'w-10 h-10 transition-all duration-500 relative z-10 text-gray-700 group-hover:text-red-500 group-hover:scale-105';
                    icon.setAttribute('fill', 'none');
                    
                    // Remove animation effects
                    const effects = button.querySelectorAll('.animate-ping, .animate-pulse, .animate-spin, .blur-sm');
                    effects.forEach(effect => effect.remove());
                }
                
                showToast(data.message, data.is_favorite ? 'success' : 'info');
            } else {
                showToast(data.message || 'Error al procesar la solicitud', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error al procesar la solicitud', 'error');
        })
        .finally(() => {
            button.disabled = false;
            button.style.opacity = '1';
        });
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 translate-x-full`;
        
        switch(type) {
            case 'success':
                toast.style.background = 'linear-gradient(135deg, #10B981 0%, #059669 100%)';
                break;
            case 'error':
                toast.style.background = 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)';
                break;
            default:
                toast.style.background = 'linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%)';
        }
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
</script>
@endsection