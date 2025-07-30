@extends('layouts.app')

@section('content')
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
