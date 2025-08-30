@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header de la página de ayuda -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full mb-6">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-4xl font-bold text-[#1A0046] mb-4">Centro de Ayuda</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Encuentra toda la información que necesitas para aprovechar al máximo EventHub
        </p>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-8">
        <div class="max-w-md mx-auto">
            <div class="relative">
                <input type="text" id="searchHelp" placeholder="Buscar en la ayuda..." 
                       class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Secciones principales -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <!-- Guía para Usuarios -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Guía para Usuarios</h3>
                <p class="text-gray-600 mb-4">Aprende a navegar por eventos, crear tu perfil y aprovechar todas las funcionalidades disponibles.</p>
                <a href="{{ route('help.user-guide') }}" class="inline-flex items-center text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Guía para Creadores -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Guía para Creadores</h3>
                <p class="text-gray-600 mb-4">Descubre cómo crear y gestionar eventos, configurar tu perfil de creador y maximizar el alcance.</p>
                <a href="{{ route('help.creator-guide') }}" class="inline-flex items-center text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Guía para Administradores -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Guía para Administradores</h3>
                <p class="text-gray-600 mb-4">Herramientas y funciones avanzadas para la gestión completa de la plataforma.</p>
                <a href="{{ route('help.admin-guide') }}" class="inline-flex items-center text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Ver guía
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Preguntas Frecuentes -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Preguntas Frecuentes</h3>
                <p class="text-gray-600 mb-4">Resuelve tus dudas más comunes sobre el uso de la plataforma.</p>
                <a href="{{ route('help.faq') }}" class="inline-flex items-center text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Ver FAQ
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Contacto y Soporte -->
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="p-6">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Contacto y Soporte</h3>
                <p class="text-gray-600 mb-4">¿Necesitas ayuda adicional? Contacta con nuestro equipo de soporte.</p>
                <a href="{{ route('help.contact') }}" class="inline-flex items-center text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Contactar
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>


    </div>

    <!-- Sección de navegación rápida -->
    <div class="bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-xl p-8 text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">¿Qué necesitas hacer?</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('register.user') }}" class="bg-white bg-opacity-10 rounded-lg p-4 hover:bg-opacity-20 transition-all duration-200 text-center">
                <div class="text-2xl mb-2">👤</div>
                <div class="font-semibold">Registrarme</div>
            </a>
            <a href="{{ route('events.public') }}" class="bg-white bg-opacity-10 rounded-lg p-4 hover:bg-opacity-20 transition-all duration-200 text-center">
                <div class="text-2xl mb-2">🎉</div>
                <div class="font-semibold">Ver Eventos</div>
            </a>
            <a href="{{ route('register.creator') }}" class="bg-white bg-opacity-10 rounded-lg p-4 hover:bg-opacity-20 transition-all duration-200 text-center">
                <div class="text-2xl mb-2">🎨</div>
                <div class="font-semibold">Crear Eventos</div>
            </a>
            <a href="{{ route('contact') }}" class="bg-white bg-opacity-10 rounded-lg p-4 hover:bg-opacity-20 transition-all duration-200 text-center">
                <div class="text-2xl mb-2">📞</div>
                <div class="font-semibold">Contactar</div>
            </a>
        </div>
    </div>
</div>

<script>
// Búsqueda en tiempo real
document.getElementById('searchHelp').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.bg-white.rounded-xl');
    
    cards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection 