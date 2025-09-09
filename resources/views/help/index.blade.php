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

    /* Help cards */
    .help-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }

    .help-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.4), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
    }

    .help-icon {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #1A0046, #32004E);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .help-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1A0046;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .help-description {
        color: #32004E;
        opacity: 0.8;
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .help-link {
        color: #1A0046;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .help-link:hover {
        color: #32004E;
        transform: translateX(4px);
    }

    .action-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }

    .action-btn:hover {
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

<div class="max-w-6xl mx-auto">
    <!-- Back Button -->
    <div class="mb-8 animate-fadeInUp">
        <button onclick="goBack()" class="inline-flex items-center px-6 py-3 bg-white border-2 border-[#1A0046] text-[#1A0046] rounded-xl font-semibold hover:bg-[#1A0046] hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver Atrás
        </button>
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 ml-4 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-xl font-semibold hover:from-[#32004E] hover:to-[#1A0046] transition-all duration-300 transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Página Principal
        </a>
    </div>

    <!-- Header de la página de ayuda -->
    <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full mb-6">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Centro de <span class="text-[#32004E]">Ayuda</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            Encuentra toda la información que necesitas para aprovechar al máximo EventHub
        </p>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-12 animate-fadeInUp">
        <div class="max-w-md mx-auto">
            <div class="relative">
                <input type="text" id="searchHelp" placeholder="Buscar en la ayuda..."
                       class="w-full px-6 py-4 pl-14 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1A0046] focus:border-transparent shadow-lg text-lg">
                <svg class="absolute left-5 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Secciones principales -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Guía para Usuarios -->
        <div class="help-card animate-fadeInUp">
            <div class="p-8">
                <div class="help-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="help-title">Guía para Usuarios</h3>
                <p class="help-description">Aprende a navegar por eventos, crear tu perfil y aprovechar todas las funcionalidades disponibles.</p>
                <a href="{{ route('help.user-guide') }}" class="help-link">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Guía para Creadores -->
        <div class="help-card animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="p-8">
                <div class="help-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="help-title">Guía para Creadores</h3>
                <p class="help-description">Descubre cómo crear y gestionar eventos, configurar tu perfil de creador y maximizar el alcance.</p>
                <a href="{{ route('help.creator-guide') }}" class="help-link">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Guía para Administradores -->
        <div class="help-card animate-fadeInUp" style="animation-delay: 0.2s;">
            <div class="p-8">
                <div class="help-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="help-title">Guía para Administradores</h3>
                <p class="help-description">Herramientas y funciones avanzadas para la gestión completa de la plataforma.</p>
                <a href="{{ route('help.admin-guide') }}" class="help-link">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Preguntas Frecuentes -->
        <div class="help-card animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="p-8">
                <div class="help-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="help-title">Preguntas Frecuentes</h3>
                <p class="help-description">Resuelve tus dudas más comunes sobre el uso de la plataforma.</p>
                <a href="{{ route('help.faq') }}" class="help-link">
                    Ver FAQ
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Contacto y Soporte -->
        <div class="help-card animate-fadeInUp" style="animation-delay: 0.4s;">
            <div class="p-8">
                <div class="help-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="help-title">Contacto y Soporte</h3>
                <p class="help-description">¿Necesitas ayuda adicional? Contacta con nuestro equipo de soporte.</p>
                <a href="{{ route('help.contact') }}" class="help-link">
                    Contactar
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Sección de navegación rápida -->
    <div class="gradient-bg rounded-2xl p-12 text-white animate-fadeInUp">
        <h2 class="text-3xl font-bold mb-8 text-center">¿Qué necesitas hacer?</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('register.user') }}" class="action-btn">
                <span>👤</span>
                <span>Registrarme</span>
            </a>
            <a href="{{ route('events.public') }}" class="action-btn">
                <span>🎉</span>
                <span>Ver Eventos</span>
            </a>
            <a href="{{ route('register.creator') }}" class="action-btn">
                <span>🎨</span>
                <span>Crear Eventos</span>
            </a>
            <a href="{{ route('contact') }}" class="action-btn">
                <span>📞</span>
                <span>Contactar</span>
            </a>
        </div>
    </div>
</div>

<script>
// Función para volver atrás
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '{{ route("home") }}';
    }
}

// Búsqueda en tiempo real
document.getElementById('searchHelp').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.help-card');

    cards.forEach(card => {
        const title = card.querySelector('.help-title').textContent.toLowerCase();
        const description = card.querySelector('.help-description').textContent.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection
