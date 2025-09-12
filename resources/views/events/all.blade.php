@extends('layouts.app')

@section('content')
<!-- Fondo con gradiente corporativo -->
<div class="min-h-screen" style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Botón Volver -->
            <div class="mb-6 animate-fade-in">
                <button onclick="if (history.length > 1) { history.back(); } else { window.location.href='{{ url('/') }}'; }" 
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform glass-effect backdrop-blur-sm"
                        style="border: 1px solid rgba(255,255,255,0.25);">
                    <span class="text-lg">‹</span>
                    <span>Volver</span>
                </button>
            </div>
            <!-- Header con diseño mejorado -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl shadow-2xl mb-6 animate-float"
                     style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                    <span class="text-5xl">🎭</span>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 tracking-tight animate-slide-up">Todos los Eventos</h1>
                <p class="text-white text-xl opacity-90 max-w-3xl mx-auto leading-relaxed animate-slide-up-delay">
                    Descubre eventos increíbles creados por nuestra comunidad y vive experiencias únicas
                </p>
            </div>

            <!-- Filtros con diseño mejorado -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 mb-12 border border-white border-opacity-20">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl shadow-lg"
                         style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                        🔍
                    </div>
                    <h2 class="text-2xl font-bold ml-4" style="color: #1A0046;">Encuentra tu evento perfecto</h2>
                </div>

                <form method="GET" action="{{ route('events.public') }}" class="filter-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Búsqueda por texto -->
                        <div class="space-y-2">
                            <label for="search" class="block text-sm font-semibold" style="color: #32004E;">
                                <i class="fas fa-search mr-2"></i>Buscar eventos
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Título, descripción o ubicación..."
                                       class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300"
                                       >
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Filtro por categoría -->
                        <div class="space-y-2">
                            <label for="category" class="block text-sm font-semibold" style="color: #32004E;">
                                <i class="fas fa-tags mr-2"></i>Categoría
                            </label>
                            <div class="relative">
                                <select id="category" 
                                        name="category" 
                                        class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300 appearance-none"
                                           >
                                    <option value="">Todas las categorías</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Fecha desde -->
                        <div class="space-y-2">
                            <label for="date_from" class="block text-sm font-semibold" style="color: #32004E;">
                                <i class="fas fa-calendar-alt mr-2"></i>Desde
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       id="date_from" 
                                       name="date_from" 
                                       value="{{ request('date_from') }}"
                                       class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300"
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Fecha hasta -->
                        <div class="space-y-2">
                            <label for="date_to" class="block text-sm font-semibold" style="color: #32004E;">
                                <i class="fas fa-calendar-check mr-2"></i>Hasta
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       id="date_to" 
                                       name="date_to" 
                                       value="{{ request('date_to') }}"
                                       class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-100">
                        <button type="submit"
                                class="flex items-center px-8 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform animate-pulse-gentle"
                                style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                            <i class="fas fa-search mr-2"></i>
                            <span>Buscar Eventos</span>
                        </button>
                        <a href="{{ route('events.public') }}"
                           class="flex items-center px-8 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                           style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);">
                            <i class="fas fa-sync-alt mr-2"></i>
                            <span>Limpiar Filtros</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Indicador de carga -->
            <div id="loading-indicator" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl p-8 shadow-2xl">
                    <div class="flex items-center space-x-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-4 border-purple-500 border-t-transparent"></div>
                        <span class="text-lg font-semibold" style="color: #1A0046;">Buscando eventos...</span>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            @if($events->count() > 0)
                <br>
                <!-- Información de resultados -->
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-between text-white">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                                📊
                            </div>
                            <div>
                                <p class="text-lg font-semibold">
                                    Mostrando {{ $events->firstItem() }} - {{ $events->lastItem() }} de {{ $events->total() }} eventos
                                </p>
                                <p class="text-sm opacity-75">Encuentra el evento perfecto para ti</p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-center space-x-2 text-sm opacity-75">
                                <i class="fas fa-filter"></i>
                                <span>Filtros aplicados</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid de eventos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($events as $event)
                        <a href="{{ route('events.show', $event) }}" class="block">
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group cursor-pointer animate-stagger">
                            <!-- Imagen del evento -->
                            <div class="h-56 bg-gray-200 relative overflow-hidden">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"
                                         style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                                        <span class="text-6xl text-white opacity-90">🎭</span>
                                    </div>
                                @endif
                                
                                <!-- Badge de fecha -->
                                <div class="absolute top-4 right-4 px-3 py-2 rounded-xl text-white text-sm font-bold shadow-lg backdrop-blur-sm"
                                     style="background: linear-gradient(135deg, rgba(26, 0, 70, 0.9) 0%, rgba(50, 0, 78, 0.9) 100%);">
                                    <div class="text-center">
                                        <div class="text-lg leading-tight">{{ $event->date->format('d') }}</div>
                                        <div class="text-xs uppercase">{{ $event->date->format('M') }}</div>
                                    </div>
                                </div>
                                
                                <!-- Overlay gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black from-0% via-transparent to-transparent opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                            </div>

                            <!-- Contenido del evento -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-xl font-bold line-clamp-2 flex-1" style="color: #1A0046;">{{ $event->title }}</h3>
                                    <div class="ml-3 flex-shrink-0">
                                        <span class="inline-block px-3 py-1 text-xs font-bold text-white rounded-full shadow-sm"
                                              @if($event->category && $event->category->color && Str::startsWith($event->category->color, 'linear-gradient'))
                                                  style="background-image: {{ $event->category->color }};"
                                              @elseif($event->category && $event->category->color)
                                                  style="background: {{ $event->category->color }};"
                                              @else
                                                  style="background-image: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);"
                                              @endif>

                                        </span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">{{ $event->description }}</p>

                                <!-- Información del evento -->
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-sm" style="color: #32004E;">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #E0E7FF 0%, #C7D2FE 100%);">
                                            📅
                                        </div>
                                        <span class="font-medium">{{ $event->date->format('d/m/Y') }} a las {{ $event->time }}</span>
                                    </div>
                                    <div class="flex items-center text-sm" style="color: #32004E;">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);">
                                            📍
                                        </div>
                                        <span class="font-medium truncate">{{ $event->location }}</span>
                                    </div>
                                    <div class="flex items-center text-sm" style="color: #32004E;">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);">
                                            👤
                                        </div>
                                        <span class="font-medium">Por {{ $event->creator->name }}</span>
                                    </div>
                                </div>

                                <!-- Footer del card -->
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $event->created_at->diffForHumans() }}
                                    </span>
                                    <div class="flex items-center space-x-3">
                                        @auth
                                            <!-- Botón de favoritos mejorado -->
                                            <button onclick="toggleFavorite({{ $event->id }}, this)" 
                                                    class="favorite-btn group relative w-9 h-9 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 transform shadow-lg border-2 border-white/30 backdrop-blur-sm"
                                                    data-event-id="{{ $event->id }}"
                                                    data-is-favorite="{{ Auth::user()->hasFavorite($event->id) ? 'true' : 'false' }}"
                                                    style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                                
                                                <!-- Corazón SVG -->
                                                <svg class="w-4 h-4 transition-all duration-300 {{ Auth::user()->hasFavorite($event->id) ? 'text-red-500 scale-110' : 'text-gray-600 group-hover:text-red-500' }}" 
                                                     fill="{{ Auth::user()->hasFavorite($event->id) ? 'currentColor' : 'none' }}" 
                                                     stroke="currentColor" 
                                                     viewBox="0 0 24 24" 
                                                     stroke-width="2.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                                
                                                <!-- Efecto de pulso cuando está en favoritos -->
                                                @if(Auth::user()->hasFavorite($event->id))
                                                    <div class="absolute inset-0 rounded-full bg-red-500/40 animate-ping"></div>
                                                @endif
                                                
                                                <!-- Tooltip -->
                                                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-20">
                                                    <div class="bg-gray-900 text-white text-xs px-2 py-1 rounded whitespace-nowrap shadow-lg border border-gray-700">
                                                        {{ Auth::user()->hasFavorite($event->id) ? 'Quitar de favoritos' : 'Agregar a favoritos' }}
                                                    </div>
                                                </div>
                                            </button>
                                        @endauth
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs"
                                                 style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%); color: white;">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                            <span class="text-xs font-medium" style="color: #32004E;">Ver detalles</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>

                <!-- Paginación mejorada -->
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6">
                    <div class="flex justify-center">
                        {{ $events->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-3xl shadow-2xl mb-8"
                         style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                        <span class="text-6xl">🔍</span>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">No se encontraron eventos</h2>
                    <p class="text-white text-lg opacity-75 mb-8 max-w-md mx-auto leading-relaxed">
                        No hay eventos que coincidan con tus criterios de búsqueda. Intenta ajustar los filtros o explora otras opciones.
                    </p>
                    <a href="{{ route('events.public') }}" 
                       class="inline-flex items-center px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                       style="background: linear-gradient(135deg, #FFFFFF 20%, rgba(255, 255, 255, 0.9) 100%); color: #1A0046;">
                        <i class="fas fa-eye mr-3"></i>
                        <span>Ver Todos los Eventos</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@include('layouts.footer')


<!-- Estilos adicionales -->
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

    .filter-form {
        transition: all 0.3s ease;
    }

    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Mejoras para los botones de paginación */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.75rem; /* space-x-3 in Tailwind is 0.75rem */
    }
    
    .pagination a, .pagination span {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.75rem;
        transition-property: all;
        transition-duration: 300ms;
    }
    
    .pagination a {
        background: rgba(255, 255, 255, 0.9);
        color: #1A0046;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }
    
    .pagination a:hover {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        color: white;
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }
    
    .pagination .active span {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%) !important;
        color: white;
        border: 2px solid #1A0046;
    }

    /* Efectos para las cards */
    .group:hover {
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.2);
    }

    /* Animaciones suaves */
    .transform {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Mejoras para inputs */
    input:focus, select:focus {
        border-color: #32004E !important;
        box-shadow: 0 0 0 4px rgba(50, 0, 78, 0.1) !important;
    }

    /* Backdrop blur para mejor legibilidad */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }

    /* Efectos de glassmorphism */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Animación de aparición */
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Nuevas animaciones */
    .animate-slide-up {
        animation: slideUp 0.8s ease-out;
    }

    .animate-slide-up-delay {
        animation: slideUp 0.8s ease-out 0.2s both;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-pulse-gentle {
        animation: pulseGentle 2s ease-in-out infinite;
    }

    .animate-bounce-in {
        animation: bounceIn 0.6s ease-out;
    }

    .animate-stagger {
        animation: fadeInUp 0.6s ease-out both;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulseGentle {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger delays for cards */
    .animate-stagger:nth-child(1) { animation-delay: 0.1s; }
    .animate-stagger:nth-child(2) { animation-delay: 0.2s; }
    .animate-stagger:nth-child(3) { animation-delay: 0.3s; }
    .animate-stagger:nth-child(4) { animation-delay: 0.4s; }
    .animate-stagger:nth-child(5) { animation-delay: 0.5s; }
    .animate-stagger:nth-child(6) { animation-delay: 0.6s; }
    .animate-stagger:nth-child(7) { animation-delay: 0.7s; }
    .animate-stagger:nth-child(8) { animation-delay: 0.8s; }
    .animate-stagger:nth-child(9) { animation-delay: 0.9s; }

    /* Mejorar el spinner */
    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<!-- JavaScript mejorado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.filter-form');
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const dateFromInput = document.getElementById('date_from');
    const dateToInput = document.getElementById('date_to');
    const loadingIndicator = document.getElementById('loading-indicator');

    let searchTimeout;

    // Función para mostrar/ocultar indicador de carga
    function showLoading() {
        if (loadingIndicator) {
            loadingIndicator.classList.remove('hidden');
        }
        form.classList.add('loading');
    }

    function hideLoading() {
        if (loadingIndicator) {
            loadingIndicator.classList.add('hidden');
        }
        form.classList.remove('loading');
    }

    // Función para enviar el formulario automáticamente
    function autoSubmit() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            showLoading();
            form.submit();
        }, 800); // Aumentado a 800ms para mejor UX
    }

    // Event listeners para búsqueda automática
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            // Agregar efecto visual mientras el usuario escribe
            this.style.borderColor = '#32004E';
            this.style.boxShadow = '0 0 0 4px rgba(50, 0, 78, 0.1)';
            autoSubmit();
        });

        searchInput.addEventListener('blur', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            showLoading();
            form.submit();
        });
    }

    if (dateFromInput) {
        dateFromInput.addEventListener('change', function() {
            showLoading();
            form.submit();
        });
    }

    if (dateToInput) {
        dateToInput.addEventListener('change', function() {
            showLoading();
            form.submit();
        });
    }

    // Agregar efectos hover a las cards
    const eventCards = document.querySelectorAll('.group');
    eventCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Animación de aparición para las cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    eventCards.forEach(card => {
        observer.observe(card);
    });

    // Limpiar timeouts al salir de la página
    window.addEventListener('beforeunload', function() {
        clearTimeout(searchTimeout);
    });

    // Función para manejar favoritos
    window.toggleFavorite = function(eventId, button) {
        event.stopPropagation(); // Evitar que se active el enlace del card
        
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';
        const icon = button.querySelector('svg');
        const originalColor = button.style.background;
        
        // Deshabilitar botón mientras se procesa
        button.disabled = true;
        button.style.opacity = '0.7';
        
        const url = `/events/${eventId}/favorite`;
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
                // Actualizar estado del botón
                button.setAttribute('data-is-favorite', data.is_favorite ? 'true' : 'false');
                
                if (data.is_favorite) {
                    // Agregar a favoritos - corazón lleno
                    icon.className = 'w-4 h-4 transition-all duration-300 text-red-500 scale-110';
                    icon.setAttribute('fill', 'currentColor');
                    
                    // Agregar efecto de pulso
                    const pulseEffect = document.createElement('div');
                    pulseEffect.className = 'absolute inset-0 rounded-full bg-red-500/40 animate-ping';
                    button.appendChild(pulseEffect);
                    
                    // Efecto de animación
                    button.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        button.style.transform = 'scale(1)';
                    }, 200);
                } else {
                    // Quitar de favoritos - corazón vacío
                    icon.className = 'w-4 h-4 transition-all duration-300 text-gray-600 group-hover:text-red-500';
                    icon.setAttribute('fill', 'none');
                    
                    // Remover efecto de pulso
                    const pulseEffect = button.querySelector('.animate-ping');
                    if (pulseEffect) {
                        pulseEffect.remove();
                    }
                }
                
                // Mostrar mensaje temporal
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
            // Rehabilitar botón
            button.disabled = false;
            button.style.opacity = '1';
        });
    };

    // Función para mostrar mensajes toast
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
        
        // Animar entrada
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        // Animar salida
        setTimeout(() => {
            toast.style.transform = 'translateX(full)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
});
</script>
@endsection