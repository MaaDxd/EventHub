@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

<style>
    /* Gradientes corporativos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }
    
    .gradient-overlay {
        background: linear-gradient(45deg, rgba(26, 0, 70, 0.9) 0%, rgba(50, 0, 78, 0.9) 100%);
    }
    
    /* Swiper customization */
    .swiper-button-next, .swiper-button-prev {
        background-color: rgba(255, 255, 255, 0.1);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .swiper-button-next:hover, .swiper-button-prev:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 18px;
        font-weight: 600;
        color: #FFFFFF;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5);
        opacity: 0.6;
        width: 8px;
        height: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
        background: #FFFFFF;
        width: 24px;
        border-radius: 4px;
        transform: scale(1.2);
    }
    
    /* Event cards */
    .event-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }
    
    .event-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.4), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
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
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(26, 0, 70, 0.3);
    }
    
    .event-content {
        padding: 24px;
    }
    
    .event-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1A0046;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .event-description {
        color: #32004E;
        opacity: 0.8;
        margin-bottom: 16px;
        line-height: 1.6;
    }
    
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }
    
    .event-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #32004E;
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    .event-category {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #FFFFFF;
        background: linear-gradient(135deg, #1A0046, #32004E);
    }
    
    .view-all-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }
    
    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
        color: #FFFFFF;
    }
    
    /* Animations */
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
    
    .animate-fadeInDown {
        animation: fadeInDown 1s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
    }
</style>

<!-- Hero Section -->
<div class="gradient-bg min-h-screen">
    <div class="hero-section py-32 text-center relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-6xl md:text-8xl font-black text-white mb-6 animate-fadeInDown tracking-tight">
                Event<span class="text-gray-300">Hub</span>
            </h1>
            <p class="text-xl md:text-2xl text-white opacity-90 mb-12 animate-fadeInUp max-w-2xl mx-auto leading-relaxed">
                Tu plataforma definitiva para descubrir y crear eventos extraordinarios
            </p>
            <div class="animate-fadeInUp">
                <a href="{{ route('events.public') }}" class="inline-flex items-center gap-3 bg-white text-[#1A0046] px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-xl">
                    Explorar Eventos
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Decorative elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full blur-xl"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white opacity-5 rounded-full blur-xl"></div>
    </div>

    <!-- Event Slider Section -->
    <div class="event-slider py-24 relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Próximos Eventos</h2>
                <p class="text-xl text-white opacity-80">Los mejores eventos te están esperando</p>
            </div>
            
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if(isset($events) && count($events) > 0)
                        @foreach($events as $event)
                            <div class="swiper-slide relative rounded-2xl overflow-hidden shadow-2xl" style="background-image: url('{{ $event['image'] }}'); background-size: cover; background-position: center; width:340px; height:450px;">
                                <div class="gradient-overlay absolute inset-0"></div>
                                <div class="event-info absolute bottom-0 left-0 right-0 text-white p-8 text-left relative z-10">
                                    <h5 class="text-2xl font-bold mb-4 text-white">{{ $event['title'] }}</h5>
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-3 text-white opacity-90">
                                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $event['location'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-3 text-white opacity-90">
                                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $event['date'] }}@if(!empty($event['time'])) - {{ $event['time'] }}@endif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center w-full text-white text-xl opacity-80">
                            No hay eventos para mostrar en este momento.
                        </div>
                    @endif
                </div>
                <div class="swiper-pagination mt-12"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Events Section -->
<div class="featured-events bg-white py-24">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-[#1A0046] mb-6">Eventos Destacados</h2>
            <p class="text-xl text-[#32004E] opacity-80 max-w-2xl mx-auto">
                Descubre los mejores eventos creados por nuestra comunidad
            </p>
        </div>

        @if($featuredEvents && count($featuredEvents) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16">
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

                            <div class="event-category">
                                {{ $event->category ? $event->category->name : ($event->category_type ? ucfirst($event->category_type) : 'Sin categoría') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-8xl mb-8">🎭</div>
                <h3 class="text-3xl font-bold text-[#1A0046] mb-4">¡Próximamente eventos increíbles!</h3>
                <p class="text-xl text-[#32004E] opacity-70 mb-8 max-w-md mx-auto">
                    Los creadores están preparando eventos fantásticos para ti
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-[#1A0046] to-[#32004E] mx-auto rounded-full"></div>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('events.public') }}" class="view-all-btn">
                Ver Todos los Eventos
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                delay: 4000,
                disableOnInteraction: false,
                reverseDirection: false,
            },
            coverflowEffect: {
                rotate: 25,
                stretch: 0,
                depth: 120,
                modifier: 1.8,
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
            speed: 800,
            direction: 'horizontal',
            allowTouchMove: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 'auto',
                },
            }
        });

        // Control de navegación mejorado
        document.querySelector('.swiper-button-next').addEventListener('click', function() {
            swiper.autoplay.stop();
            setTimeout(() => {
                swiper.params.autoplay.reverseDirection = false;
                swiper.autoplay.start();
            }, 500);
        });

        document.querySelector('.swiper-button-prev').addEventListener('click', function() {
            swiper.autoplay.stop();
            setTimeout(() => {
                swiper.params.autoplay.reverseDirection = true;
                swiper.autoplay.start();
            }, 500);
        });

        // Pausar autoplay al hover
        const swiperContainer = document.querySelector('.swiper-container');
        swiperContainer.addEventListener('mouseenter', () => {
            swiper.autoplay.stop();
        });

        swiperContainer.addEventListener('mouseleave', () => {
            swiper.autoplay.start();
        });
    });
</script>
@endsection
