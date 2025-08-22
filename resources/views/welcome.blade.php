@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        color: white;
        font-family: 'Poppins', sans-serif;
    }
    .hero-section {
        padding: 120px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(50, 0, 78, 0.3) 0%, rgba(26, 0, 70, 0.6) 100%);
        z-index: 1;
    }
    .hero-section > .container {
        position: relative;
        z-index: 2;
    }
    .hero-section h1 {
        font-size: 4.5rem;
        font-weight: 800;
        background: linear-gradient(to right, #fff, #e0e0e0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        animation: fadeInDown 1.2s ease-out;
        margin-bottom: 1rem;
    }
    .hero-section p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        animation: fadeInUp 1.2s ease-out 0.3s;
        opacity: 0;
        animation-fill-mode: forwards;
        color: rgba(255, 255, 255, 0.9);
    }
    .event-slider {
        padding: 80px 0;
        position: relative;
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
    }
    .event-slider h2 {
        color: white;
        font-weight: 700;
        margin-bottom: 3rem;
        text-align: center;
        font-size: 2.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .swiper-container {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
        overflow: hidden;
    }
    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 320px;
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        transition: all 0.4s ease;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }
    .swiper-slide:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        border-color: rgba(255, 255, 255, 0.2);
    }
    .swiper-slide .event-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(26, 0, 70, 0.95), rgba(50, 0, 78, 0.8), transparent);
        color: white;
        padding: 30px 20px 20px;
        text-align: left;
    }
    .event-info h5 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .event-info p {
        font-size: 1rem;
        margin: 0;
        opacity: 0.9;
    }
    .swiper-button-next, .swiper-button-prev {
        background-color: rgba(255, 255, 255, 0.15);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
        background-color: rgba(255, 255, 255, 0.25);
        transform: scale(1.1);
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 20px;
        font-weight: bold;
        color: white;
    }
    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.6);
        opacity: 0.6;
        width: 10px;
        height: 10px;
        transition: all 0.3s ease;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: #fff;
        width: 30px;
        border-radius: 5px;
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Estilos para la sección de eventos destacados */
    .featured-events {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 80px 0;
    }

    .event-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
    }

    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .event-image {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .event-date-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(139, 92, 246, 0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .event-content {
        padding: 24px;
    }

    .event-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .event-description {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .event-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
        font-size: 13px;
        color: #64748b;
    }

    .event-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .event-category {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .view-all-btn {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
    }

    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.4);
        color: white;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .featured-events {
            padding: 40px 0;
        }

        .event-card {
            margin-bottom: 20px;
        }

        .event-image {
            height: 160px;
        }

        .event-content {
            padding: 16px;
        }

        .event-title {
            font-size: 16px;
        }

        .event-meta {
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
        }

        .view-all-btn {
            padding: 12px 24px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 60px 0;
        }

        .hero-section h1 {
            font-size: 2rem;
        }

        .event-slider h2 {
            font-size: 1.5rem;
        }

        .featured-events h2 {
            font-size: 2rem;
        }
    }
</style>

<div class="gradient-bg">
    <div class="hero-section">
        <div class="container">
            <h1>Bienvenido a EventHub</h1>
            <p>Tu plataforma definitiva para descubrir y crear eventos.</p>
        </div>
    </div>

    <div class="event-slider">
        <div class="container">
            <h2 class="text-center mb-5">Proximos Eventos</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if(isset($events) && count($events) > 0)
                        @foreach($events as $event)
                            <div class="swiper-slide" style="background-image: url('{{ $event['image'] }}')">
                                <div class="event-info">
                                    <h5>{{ $event['title'] }}</h5>
                                    <p>{{ $event['date'] }} - {{ $event['location'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center w-full">No events to display.</div>
                    @endif
                </div>
                <!-- Agregar controles de navegación -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next" style="color: white;"></div>
                <div class="swiper-button-prev" style="color: white;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Sección de Eventos Destacados -->
<div class="featured-events">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Eventos Destacados</h2>
            <p class="text-gray-600 text-lg">Descubre los mejores eventos creados por nuestra comunidad</p>
        </div>

        @if($featuredEvents && count($featuredEvents) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($featuredEvents as $event)
                    <div class="event-card">
                        @php
                            $imageUrl = $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <div class="event-image" style="background-image: url('{{ $imageUrl }}')">
                            <div class="event-date-badge">
                                {{ $event->date->format('d M') }}
                            </div>
                        </div>
                        <div class="event-content">
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-description">{{ Str::limit($event->description, 100) }}</p>

                            <div class="event-meta">
                                <span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $event->location }}
                                </span>
                                <span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $event->time }}
                                </span>
                            </div>

                            <div class="event-category" style="background-color: {{ $event->category ? $event->category->color : '#8B5CF6' }}">
                                {{ $event->category ? $event->category->name : ucfirst($event->category_type) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-6">🎭</div>
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">¡Próximamente eventos increíbles!</h3>
                <p class="text-gray-500 mb-8">Los creadores están preparando eventos fantásticos para ti</p>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('events.public') }}" class="view-all-btn">
                Ver Todos los Eventos
                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            initialSlide: 1,
            loop: true,
            loopAdditionalSlides: 3,
            loopedSlides: 5,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                reverseDirection: false,
            },
            coverflowEffect: {
                rotate: 30,
                stretch: 0,
                depth: 100,
                modifier: 1.5,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            mousewheel: {
                invert: false,
            },
            speed: 1000,
            direction: 'horizontal',
            allowTouchMove: true,
        });

        // Botones para cambiar dirección del autoplay con efecto suave
        document.querySelector('.swiper-button-next').addEventListener('click', function() {
            swiper.autoplay.stop();
            setTimeout(() => {
                swiper.params.autoplay.reverseDirection = false;
                swiper.autoplay.start();
            }, 300);
        });

        document.querySelector('.swiper-button-prev').addEventListener('click', function() {
            swiper.autoplay.stop();
            setTimeout(() => {
                swiper.params.autoplay.reverseDirection = true;
                swiper.autoplay.start();
            }, 300);
        });
    });
</script>
@endsection
