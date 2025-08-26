@extends('layouts.app')

@section('content')
<style>
    /* Gradientes personalizados y animaciones avanzadas */
    .contact-bg {
        background: linear-gradient(135deg, #1A0046 0%, #2D1B69 50%, #32004E 100%);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        position: relative;
    }
    
    /* Patrón SVG de fondo */
    .contact-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.05)' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
        z-index: 0;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .contact-section::before {
        background: radial-gradient(circle at 30% 20%, rgba(255,215,0,0.15) 0%, rgba(255,255,255,0.08) 40%, rgba(50, 0, 78, 0.25) 70%, rgba(26, 0, 70, 0.8) 100%);
        animation: float 8s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }
    
    
    @keyframes textShine {
        0%, 100% { filter: brightness(1); }
        50% { filter: brightness(1.2); }
    }
    
    .contact-info-box {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 25px 50px rgba(26,0,70,0.3), 0 0 0 1px rgba(255,215,0,0.1);
        animation: boxGlow 4s ease-in-out infinite;
        position: relative;
        overflow: hidden;
    }
    
    /* Efecto de glassmorfismo mejorado */
    .contact-info-box::after {
        content: '';
        position: absolute;
        top: 0;
        left: -50%;
        width: 200%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(255,255,255,0.2) 0%, transparent 70%);
        opacity: 0.4;
        z-index: -1;
        transform: translateY(-50%) rotate(30deg);
        pointer-events: none;
    }
    
    @keyframes boxGlow {
        0%, 100% { box-shadow: 0 25px 50px rgba(26,0,70,0.3), 0 0 0 1px rgba(255,215,0,0.1); }
        50% { box-shadow: 0 30px 60px rgba(26,0,70,0.4), 0 0 0 1px rgba(255,215,0,0.2); }
    }
    
    .contact-info-box::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, transparent, rgba(255,215,0,0.1), transparent);
        border-radius: 32px;
        z-index: -1;
        animation: borderRotate 6s linear infinite;
    }
    
    @keyframes borderRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .contact-item {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        transform: translateY(0);
    }
    
    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(26,0,70,0.2);
        background: rgba(255,255,255,0.12);
    }
    
    .contact-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,215,0,0.1), transparent);
        transition: left 0.6s;
    }
    
    .contact-item:hover::before {
        left: 100%;
    }
    
    
    
    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Animación para los iconos */
    .icon-glow {
        animation: iconPulse 2s ease-in-out infinite;
        filter: drop-shadow(0 0 5px rgba(255, 215, 0, 0.5));
    }
    
    /* Animaciones adicionales */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    .floating-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }
    
    /* Estilo para las partículas */
    .particle {
        position: absolute;
        background: radial-gradient(circle, rgba(255,215,0,0.6) 0%, rgba(255,215,0,0) 70%);
        border-radius: 50%;
        animation: floatUp 15s linear infinite;
        opacity: 0;
    }
    
    /* Elemento decorativo adicional */
    .decorative-circle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,215,0,0.2) 0%, rgba(255,215,0,0) 70%);
        filter: blur(20px);
        z-index: 0;
        animation: pulse 8s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }
    
    
    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(100vh) scale(0);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(-100px) scale(1);
        }
    }
</style>

<div class="contact-bg text-white font-['Poppins'] min-h-screen relative overflow-hidden">
    <!-- Elementos decorativos -->    
    <div class="decorative-circle w-96 h-96 top-[-10%] right-[-10%] animate-pulse"></div>
    <div class="decorative-circle w-64 h-64 bottom-[-5%] left-[-5%]"></div>
    
    <!-- Partículas flotantes -->
    <div class="floating-particles">
        <div class="particle w-2 h-2" style="left: 10%; animation-delay: 0s; animation-duration: 12s;"></div>
        <div class="particle w-1 h-1" style="left: 20%; animation-delay: 2s; animation-duration: 15s;"></div>
        <div class="particle w-3 h-3" style="left: 30%; animation-delay: 4s; animation-duration: 10s;"></div>
        <div class="particle w-1 h-1" style="left: 40%; animation-delay: 6s; animation-duration: 18s;"></div>
        <div class="particle w-2 h-2" style="left: 50%; animation-delay: 8s; animation-duration: 14s;"></div>
        <div class="particle w-1 h-1" style="left: 60%; animation-delay: 10s; animation-duration: 16s;"></div>
        <div class="particle w-2 h-2" style="left: 70%; animation-delay: 12s; animation-duration: 11s;"></div>
        <div class="particle w-3 h-3" style="left: 80%; animation-delay: 14s; animation-duration: 13s;"></div>
        <div class="particle w-1 h-1" style="left: 90%; animation-delay: 16s; animation-duration: 17s;"></div>
    </div>

    <div class="contact-section pt-32 pb-24 text-center relative overflow-hidden before:content-[''] before:absolute before:inset-0 before:z-10">
        <div class="container mx-auto relative z-20 px-6 max-w-6xl">
            <!-- Título principal mejorado -->
            <div class="mb-16">
                <h1 class="contact-title text-6xl md:text-7xl font-black mb-8 tracking-wider uppercase drop-shadow-2xl" style="animation: fadeInDown 1s ease-out;">
                    Contacto
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-white-400 to-orange-400 mx-auto mb-8 rounded-full"></div>
                <p class="text-xl md:text-2xl mb-4 text-white/90 drop-shadow-lg max-w-3xl mx-auto leading-relaxed" style="animation: fadeInUp 1s ease-out 0.3s both;">
                    ¿Tienes dudas, sugerencias o quieres colaborar?
                </p>
                <p class="text-lg text-white/75 max-w-2xl mx-auto" style="animation: fadeInUp 1s ease-out 0.6s both;">
                    ¡Contáctanos a través de los siguientes medios y te responderemos lo antes posible!
                </p>
            </div>
            
            <!-- Información de contacto rediseñada -->
            <div class="max-w-2xl mx-auto">
                <div class="contact-info-box rounded-3xl p-10 md:p-12 text-white relative z-10" style="animation: fadeInUp 1s ease-out 0.9s both;">
                    <h2 class="text-3xl md:text-4xl font-bold mb-10 text-white tracking-wide drop-shadow-lg">
                        <span class="bg-gradient-to-r from-white to-yellow-300 bg-clip-text text-transparent">
                            Información de contacto
                        </span>
                    </h2>
                    
                    <div class="grid gap-6 md:gap-8">
                        <!-- Email -->
                        <div class="contact-item rounded-2xl px-6 py-5 group cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-envelope-fill text-3xl text-yellow-400 icon-glow"></i>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="text-white/70 text-sm font-medium mb-1">Email</div>
                                    <a href="mailto:eventhub@soporte.com" 
                                       class="text-white text-lg font-semibold hover:text-yellow-300 transition-colors duration-300 break-all">
                                        eventhub@soporte.com
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Teléfono -->
                        <div class="contact-item rounded-2xl px-6 py-5 group cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-telephone-fill text-3xl text-yellow-400 icon-glow"></i>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="text-white/70 text-sm font-medium mb-1">Teléfono</div>
                                    <a href="tel:+34123456789" 
                                       class="text-white text-lg font-semibold hover:text-yellow-300 transition-colors duration-300">
                                        +34 123 456 789
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dirección -->
                        <div class="contact-item rounded-2xl px-6 py-5 group cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-geo-alt-fill text-3xl text-yellow-400 icon-glow"></i>
                                </div>
                                <div class="flex-1 text-left">
                                    <div class="text-white/70 text-sm font-medium mb-1">Ubicación</div>
                                    <div class="text-white text-lg font-semibold">
                                        Calle Ficticia 123, Ciudad, País
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Redes sociales -->
                        <div class="grid md:grid-cols-2 gap-4 mt-4">
                            <div class="contact-item rounded-2xl px-6 py-5 group cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <i class="bi bi-instagram text-2xl text-yellow-400 icon-glow"></i>
                                    <div class="text-left">
                                        <div class="text-white/70 text-xs font-medium mb-1">Instagram</div>
                                        <a href="https://instagram.com/eventhub" target="_blank" 
                                           class="text-white text-sm font-semibold hover:text-yellow-300 transition-colors duration-300">
                                            @eventhub
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact-item rounded-2xl px-6 py-5 group cursor-pointer">
                                <div class="flex items-center gap-4">
                                    <i class="bi bi-facebook text-2xl text-yellow-400 icon-glow"></i>
                                    <div class="text-left">
                                        <div class="text-white/70 text-xs font-medium mb-1">Facebook</div>
                                        <a href="https://facebook.com/eventhub" target="_blank" 
                                           class="text-white text-sm font-semibold hover:text-yellow-300 transition-colors duration-300">
                                            /eventhub
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mensaje adicional -->
                    <div class="mt-12 p-6 bg-white/5 rounded-2xl border border-white/10">
                        <p class="text-white/80 text-sm leading-relaxed">
                            <i class="bi bi-clock text-yellow-400 mr-2"></i>
                            Tiempo de respuesta promedio: <span class="text-yellow-300 font-semibold">24 horas</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection