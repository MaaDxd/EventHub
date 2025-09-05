@extends('layouts.app')

@section('content')
<!-- Fondo con gradiente corporativo -->
<div class="min-h-screen" style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header con diseño mejorado -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl shadow-2xl mb-6 animate-float"
                     style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                    <span class="text-5xl">💜</span>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 tracking-tight animate-slide-up">Mis Eventos Favoritos</h1>
                <p class="text-white text-xl opacity-90 max-w-3xl mx-auto leading-relaxed animate-slide-up-delay">
                    Aquí tienes todos los eventos que has guardado como favoritos para no perderte de nada
                </p>
            </div>

            <!-- Estadísticas de favoritos -->
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 mb-8">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                            💜
                        </div>
                        <div>
                            <p class="text-lg font-semibold">
                                {{ $favoriteEvents->total() }} evento{{ $favoriteEvents->total() != 1 ? 's' : '' }} favorito{{ $favoriteEvents->total() != 1 ? 's' : '' }}
                            </p>
                            <p class="text-sm opacity-75">Tu colección personalizada de eventos</p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <a href="{{ route('events.public') }}" 
                           class="inline-flex items-center px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                           style="background: linear-gradient(135deg, #FFFFFF 20%, rgba(255, 255, 255, 0.9) 100%); color: #1A0046;">
                            <i class="fas fa-plus mr-2"></i>
                            <span>Explorar Más Eventos</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            @if($favoriteEvents->count() > 0)
                <!-- Grid de eventos favoritos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($favoriteEvents as $event)
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

                                <!-- Badge de favorito -->
                                <div class="absolute top-4 left-4 px-3 py-2 rounded-xl text-white text-sm font-bold shadow-lg backdrop-blur-sm"
                                     style="background: linear-gradient(135deg, rgba(147, 51, 234, 0.9) 0%, rgba(126, 34, 206, 0.9) 100%);">
                                    <i class="fas fa-heart mr-1"></i>
                                    Favorito
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
                                            {{ $event->category ? $event->category->name : 'Sin categoría' }}
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
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('events.show', $event) }}" 
                                           class="inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold transition-all duration-300 hover:scale-105 text-sm"
                                           style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                                            <i class="fas fa-eye mr-2"></i>
                                            Ver Detalles
                                        </a>
                                        <button onclick="removeFavorite({{ $event->id }})" 
                                                class="inline-flex items-center px-4 py-2 rounded-lg text-white font-semibold transition-all duration-300 hover:scale-105 text-sm bg-red-500 hover:bg-red-600">
                                            <i class="fas fa-heart-broken mr-2"></i>
                                            Quitar
                                        </button>
                                    </div>
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $event->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                @if($favoriteEvents->hasPages())
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="flex justify-center">
                            {{ $favoriteEvents->links() }}
                        </div>
                    </div>
                @endif
            @else
                <!-- Estado vacío -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-3xl shadow-2xl mb-8"
                         style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                        <span class="text-6xl">💔</span>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">No tienes eventos favoritos aún</h2>
                    <p class="text-white text-lg opacity-75 mb-8 max-w-md mx-auto leading-relaxed">
                        Explora eventos increíbles y guarda tus favoritos haciendo clic en el corazón morado.
                    </p>
                    <a href="{{ route('events.public') }}" 
                       class="inline-flex items-center px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                       style="background: linear-gradient(135deg, #FFFFFF 20%, rgba(255, 255, 255, 0.9) 100%); color: #1A0046;">
                        <i class="fas fa-search mr-3"></i>
                        <span>Explorar Eventos</span>
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

    /* Efectos para las cards */
    .group:hover {
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.2);
    }

    /* Animaciones suaves */
    .transform {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Backdrop blur para mejor legibilidad */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
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

    /* Mejoras para los botones de paginación */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
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
</style>

<!-- JavaScript para manejar favoritos -->
<script>
    const baseUrl = '{{ url("/") }}';
    function removeFavorite(eventId) {
        if (confirm('¿Estás seguro de que quieres quitar este evento de tus favoritos?')) {
            fetch(baseUrl + `events/${eventId}/favorite`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recargar la página para actualizar la lista
                    location.reload();
                } else {
                    alert('Error al quitar el evento de favoritos: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al quitar el evento de favoritos');
            });
        }
    }

    // Agregar efectos hover a las cards
    document.addEventListener('DOMContentLoaded', function() {
        const eventCards = document.querySelectorAll('.group');
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
@endsection
