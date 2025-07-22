@extends('layouts.app')

@section('content')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #4f3a65 0%, #704b8c 25%, #9b59b6 50%, #3498db 75%, #2c3e50 100%);
        color: white;
        font-family: 'Poppins', sans-serif;
    }
    .hero-section {
        padding: 120px 0;
        text-align: center;
    }
    .hero-section h1 {
        font-size: 4rem;
        font-weight: 700;
        animation: fadeInDown 1s ease-in-out;
    }
    .hero-section p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        animation: fadeInUp 1s ease-in-out;
    }
    .event-slider {
        padding: 80px 0;
        position: relative;
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
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }
    .swiper-slide:hover {
        transform: scale(1.05);
    }
    .swiper-slide .event-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.6);
        color: white;
        padding: 20px;
        text-align: left;
    }
    .event-info h5 {
        font-size: 1.25rem;
        font-weight: 600;
    }
    .event-info p {
        font-size: 0.9rem;
        margin: 0;
    }
    .swiper-button-next, .swiper-button-prev {
        background-color: rgba(0,0,0,0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 18px;
    }
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.6;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: #9b59b6;
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
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
</style>

<div class="gradient-bg">
    <div class="hero-section">
        <div class="container">
            <h1>Welcome to EventHub</h1>
            <p>Your ultimate platform for discovering and creating events.</p>
        </div>
    </div>

    <div class="event-slider">
        <div class="container">
            <h2 class="text-center mb-5">Upcoming Events</h2>
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
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
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
        });

        // Botones para cambiar dirección del autoplay
        document.querySelector('.swiper-button-next').addEventListener('click', function() {
            swiper.autoplay.stop();
            swiper.params.autoplay.reverseDirection = false;
            swiper.autoplay.start();
        });

        document.querySelector('.swiper-button-prev').addEventListener('click', function() {
            swiper.autoplay.stop();
            swiper.params.autoplay.reverseDirection = true;
            swiper.autoplay.start();
        });
    });
</script>
@endsection
