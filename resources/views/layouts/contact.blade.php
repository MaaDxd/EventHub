@extends('layouts.app')

@section('content')
<style>
    /* Gradientes personalizados y animaciones avanzadas */
    .contact-bg {
        background: linear-gradient(135deg, #1A0046 0%, #2D1B69 50%, #32004E 100%);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
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
    
    .contact-item:hover {
        background: rgba(255,255,255,0.15);
        border-color: rgba(255,215,0,0.3);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 25px rgba(255,215,0,0.15);
    }
    
    
    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .floating-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
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
                <h1 class="contact-title text-6xl md:text-7xl font-black mb-8 tracking-wider uppercase drop-shadow-2xl">
                    Contacto
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-orange-400 mx-auto mb-8 rounded-full"></div>
                <p class="text-xl md:text-2xl mb-4 text-white/90 drop-shadow-lg max-w-3xl mx-auto leading-relaxed">
                    ¿Tienes dudas, sugerencias o quieres colaborar?
                </p>
                <p class="text-lg text-white/75 max-w-2xl mx-auto">
                    ¡Contáctanos a través de los siguientes medios y te responderemos lo antes posible!
                </p>
            </div>
            
            <!-- Información de contacto rediseñada -->
            <div class="max-w-2xl mx-auto">
                <div class="contact-info-box rounded-3xl p-10 md:p-12 text-white relative z-10">
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