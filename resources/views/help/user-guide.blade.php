@extends('layouts.app')

@section('content')
<style>
    /* Gradientes corporativos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }

    .gradient-overlay {
        background: linear-gradient(45deg, rgba(26, 0, 70, 0.9) 0%, rgba(50, 0, 78, 0.9) 100%);
    }

    /* Guide cards */
    .guide-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }

    .guide-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.4), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
    }

    .section-icon {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #1A0046, #32004E);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1A0046;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .subsection-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1A0046;
        margin-bottom: 0.5rem;
    }

    .guide-text {
        color: #32004E;
        opacity: 0.8;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.05), rgba(50, 0, 78, 0.05));
        border: 1px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1rem 0;
    }

    .info-box-blue {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .info-box-green {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(22, 163, 74, 0.1));
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .info-box-yellow {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .info-box-orange {
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(234, 88, 12, 0.1));
        border: 1px solid rgba(249, 115, 22, 0.2);
    }

    .nav-link {
        color: #1A0046;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-link:hover {
        color: #32004E;
        transform: translateX(4px);
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

    /* Navigation pills */
    .nav-pill {
        background: #FFFFFF;
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #32004E;
        font-weight: 600;
    }

    .nav-pill:hover {
        border-color: #1A0046;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.2);
    }

    .nav-pill-number {
        width: 2rem;
        height: 2rem;
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }
</style>

<div class="max-w-6xl mx-auto">
    <!-- Back Button -->
    <div class="mb-8 animate-fadeInUp">
        <button onclick="goBack()" class="inline-flex items-center px-6 py-3 bg-white border-2 border-[#1A0046] text-[#1A0046] rounded-xl font-semibold hover:bg-[#1A0046] hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver Atrás
        </button>
        <a href="{{ route('help.index') }}" class="inline-flex items-center px-6 py-3 ml-4 bg-gradient-to-r from-[#1A0046] to-[#32004E] text-black rounded-xl font-semibold hover:from-[#32004E] hover:to-[#1A0046] transition-all duration-300 transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Centro de Ayuda
        </a>
    </div>

    <!-- Header -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full mb-6">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Guía para <span class="text-[#32004E]">Usuarios</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            Aprende a aprovechar al máximo EventHub como usuario
        </p>
    </div>

    <!-- Navegación de la guía -->
    <div class="gradient-bg rounded-2xl p-8 mb-12 animate-fadeInUp">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <a href="#registro" class="nav-pill">
                <span class="nav-pill-number">1</span>
                <span>Registro y Primeros Pasos</span>
            </a>
            <a href="#explorar" class="nav-pill">
                <span class="nav-pill-number">2</span>
                <span>Explorar Eventos</span>
            </a>
            <a href="#perfil" class="nav-pill">
                <span class="nav-pill-number">3</span>
                <span>Gestionar Perfil</span>
            </a>
            <a href="#funciones" class="nav-pill">
                <span class="nav-pill-number">4</span>
                <span>Funciones Avanzadas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Registro y Primeros Pasos -->
    <div id="registro" class="mb-16">
        <div class="guide-card animate-fadeInUp">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h2 class="section-title">Registro y Primeros Pasos</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-[#1A0046] pl-6">
                        <h3 class="subsection-title">Crear tu cuenta</h3>
                        <p class="guide-text">Para empezar a usar EventHub, necesitas crear una cuenta de usuario:</p>
                        <ol class="list-decimal list-inside space-y-2 guide-text ml-4">
                            <li>Haz clic en "Register" en la barra de navegación</li>
                            <li>Selecciona "Registrarse como Usuario"</li>
                            <li>Completa el formulario con tu información personal</li>
                            <li>Verifica tu correo electrónico</li>
                            <li>¡Ya puedes empezar a explorar eventos!</li>
                        </ol>
                    </div>

                    <div class="info-box info-box-blue">
                        <h4 class="font-semibold text-blue-900 mb-2">💡 Consejo</h4>
                        <p class="text-blue-800">Usa un correo electrónico válido para recibir notificaciones importantes sobre eventos que te interesen.</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Acceder a tu cuenta</h3>
                        <p class="guide-text">Una vez registrado, puedes acceder a tu cuenta desde cualquier momento:</p>
                        <ul class="list-disc list-inside space-y-2 guide-text ml-4">
                            <li>Haz clic en "Login" en la barra de navegación</li>
                            <li>Ingresa tu correo electrónico y contraseña</li>
                            <li>Serás redirigido a tu panel de usuario</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 2: Explorar Eventos -->
    <div id="explorar" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h2 class="section-title">Explorar Eventos</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-purple-500 pl-6">
                        <h3 class="subsection-title">Navegar por eventos</h3>
                        <p class="guide-text">EventHub te ofrece múltiples formas de descubrir eventos interesantes:</p>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">🏠 Página Principal</h4>
                                <p class="text-blue-800 text-sm">Encuentra eventos destacados y populares en la página de inicio.</p>
                            </div>
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">🎉 Sección de Eventos</h4>
                                <p class="text-blue-800 text-sm">Accede a todos los eventos públicos desde el menú "Eventos".</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Información de eventos</h3>
                        <p class="guide-text">Cada evento muestra información detallada:</p>
                        <ul class="list-disc list-inside space-y-2 guide-text ml-4">
                            <li><strong>Nombre y descripción:</strong> Conoce de qué trata el evento</li>
                            <li><strong>Fecha y hora:</strong> Cuándo se realizará</li>
                            <li><strong>Ubicación:</strong> Dónde tendrá lugar</li>
                            <li><strong>Categoría:</strong> Tipo de evento (concierto, conferencia, etc.)</li>
                            <li><strong>Creador:</strong> Quién organiza el evento</li>
                        </ul>
                    </div>

                    <div class="info-box info-box-yellow">
                        <h4 class="font-semibold text-yellow-900 mb-2">⚠️ Importante</h4>
                        <p class="text-yellow-800">Los eventos son públicos y pueden ser vistos por cualquier usuario. Para crear eventos, necesitas registrarte como creador.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 3: Gestionar Perfil -->
    <div id="perfil" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.2s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h2 class="section-title">Gestionar tu Perfil</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Acceder a tu perfil</h3>
                        <p class="guide-text">Para gestionar tu información personal:</p>
                        <ol class="list-decimal list-inside space-y-2 guide-text ml-4">
                            <li>Haz clic en el ícono de usuario en la barra de navegación</li>
                            <li>Selecciona "Mi Perfil" del menú desplegable</li>
                            <li>Aquí podrás ver y editar tu información</li>
                        </ol>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-6">
                        <h3 class="subsection-title">Información del perfil</h3>
                        <p class="guide-text">Puedes gestionar la siguiente información:</p>
                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">Información Personal</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Nombre completo</li>
                                    <li>• Correo electrónico</li>
                                    <li>• Número de teléfono</li>
                                </ul>
                            </div>
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">Seguridad</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Cambiar contraseña</li>
                                    <li>• Configurar sesión</li>
                                    <li>• Cerrar sesión</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-box-green">
                        <h4 class="font-semibold text-green-900 mb-2">✅ Buenas prácticas</h4>
                        <ul class="text-green-800 space-y-1">
                            <li>• Mantén tu información actualizada</li>
                            <li>• Usa una contraseña segura</li>
                            <li>• Cierra sesión cuando termines de usar la plataforma</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 4: Funciones Avanzadas -->
    <div id="funciones" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <h2 class="section-title">Funciones Avanzadas</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-orange-500 pl-6">
                        <h3 class="subsection-title">Panel de usuario</h3>
                        <p class="guide-text">Tu panel personal te ofrece acceso rápido a las funciones principales:</p>
                        <ul class="list-disc list-inside space-y-2 guide-text ml-4">
                            <li>Vista general de tu cuenta</li>
                            <li>Acceso rápido a tu perfil</li>
                            <li>Navegación a eventos</li>
                            <li>Configuración de sesión</li>
                        </ul>
                    </div>

                    <div class="border-l-4 border-red-500 pl-6">
                        <h3 class="subsection-title">Gestión de sesión</h3>
                        <p class="guide-text">EventHub incluye un sistema de gestión de sesión para tu seguridad:</p>
                        <ul class="list-disc list-inside space-y-2 guide-text ml-4">
                            <li><strong>Timeout automático:</strong> La sesión se cierra automáticamente por inactividad</li>
                            <li><strong>Extensión de sesión:</strong> Puedes extender tu sesión si lo necesitas</li>
                            <li><strong>Cierre manual:</strong> Cierra sesión cuando termines</li>
                        </ul>
                    </div>

                    <div class="info-box info-box-orange">
                        <h4 class="font-semibold text-orange-900 mb-2">🚀 Próximamente</h4>
                        <p class="text-orange-800">Estamos trabajando en nuevas funcionalidades como favoritos, notificaciones y recomendaciones personalizadas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre secciones -->
    <div class="flex justify-between items-center gradient-bg rounded-2xl p-8 animate-fadeInUp">
        <a href="{{ route('help.index') }}" class="nav-link">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al Centro de Ayuda
        </a>
        <a href="{{ route('help.creator-guide') }}" class="nav-link">
            Guía para Creadores
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>

<script>
// Función para volver atrás
function goBack() {
    try {
        if (document.referrer && document.referrer !== window.location.href) {
            window.history.back();
        } else {
            window.location.href = '{{ route("help.index") }}';
        }
    } catch (e) {
        window.location.href = '{{ route("help.index") }}';
    }
}

// Smooth scrolling para los enlaces internos
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endsection
