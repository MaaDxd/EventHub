@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-[#1A0046] mb-4">Preguntas Frecuentes</h1>
        <p class="text-lg text-gray-600">Resuelve tus dudas más comunes sobre EventHub</p>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-8">
        <div class="max-w-md mx-auto">
            <div class="relative">
                <input type="text" id="searchFAQ" placeholder="Buscar en las FAQ..." 
                       class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent">
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Categorías de preguntas -->
    <div class="grid md:grid-cols-3 gap-4 mb-8">
        <button onclick="filterFAQ('general')" class="filter-btn active bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
            General
        </button>
        <button onclick="filterFAQ('usuarios')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
            Usuarios
        </button>
        <button onclick="filterFAQ('creadores')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">
            Creadores
        </button>
    </div>

    <!-- Preguntas Frecuentes -->
    <div class="space-y-6">
        <!-- Preguntas Generales -->
        <div class="faq-category" data-category="general">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-6">Preguntas Generales</h2>
                
                <div class="space-y-4">
                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Qué es EventHub?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">EventHub es una plataforma que conecta a organizadores de eventos con personas interesadas en asistir. Permite crear, descubrir y gestionar eventos de todo tipo, desde conciertos hasta conferencias profesionales.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Es gratis usar EventHub?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Sí, EventHub es completamente gratuito para usuarios y creadores. Puedes registrarte, crear eventos y explorar eventos sin ningún costo.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Qué tipos de eventos puedo encontrar?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">EventHub incluye una amplia variedad de eventos: conciertos, conferencias, talleres, networking, eventos deportivos, exposiciones, festivales y mucho más. Los eventos pueden ser presenciales, virtuales o híbridos.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Cómo puedo contactar soporte?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Puedes contactar nuestro equipo de soporte a través de la página de contacto, enviando un correo electrónico o utilizando el formulario de ayuda. Estamos disponibles para ayudarte con cualquier consulta.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas para Usuarios -->
        <div class="faq-category" data-category="usuarios">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-6">Preguntas para Usuarios</h2>
                
                <div class="space-y-4">
                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Cómo me registro como usuario?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Para registrarte como usuario, haz clic en "Register" en la barra de navegación, selecciona "Registrarse como Usuario" y completa el formulario con tu información personal. Recibirás un correo de confirmación.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Puedo ver eventos sin registrarme?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Sí, puedes explorar eventos públicos sin necesidad de registrarte. Sin embargo, para acceder a funciones adicionales como guardar eventos favoritos o recibir notificaciones, necesitarás crear una cuenta.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Cómo puedo encontrar eventos cerca de mí?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Actualmente puedes explorar eventos por categoría y fecha. Estamos trabajando en funcionalidades de geolocalización para que puedas encontrar eventos cercanos a tu ubicación.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Puedo cambiar mi contraseña?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Sí, puedes cambiar tu contraseña desde tu perfil. Accede a "Mi Perfil" desde el menú de usuario y selecciona la opción para cambiar contraseña. Te pediremos tu contraseña actual por seguridad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas para Creadores -->
        <div class="faq-category" data-category="creadores">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-6">Preguntas para Creadores</h2>
                
                <div class="space-y-4">
                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Cómo me registro como creador?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Para registrarte como creador, haz clic en "Register" en la barra de navegación, selecciona "Registrarse como Creador" y completa el formulario. Necesitarás proporcionar información adicional sobre tu experiencia como organizador.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Puedo crear eventos gratuitos y de pago?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Actualmente EventHub está enfocado en eventos gratuitos. Estamos trabajando en funcionalidades para eventos de pago que estarán disponibles próximamente.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Puedo editar un evento después de publicarlo?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Sí, puedes editar tus eventos en cualquier momento desde tu panel de creador. Simplemente encuentra el evento en tu lista, haz clic en "Editar" y actualiza la información necesaria.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Qué pasa si necesito cancelar un evento?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Si necesitas cancelar un evento, puedes eliminarlo desde tu panel de creador. Te recomendamos actualizar la descripción del evento con la información de cancelación antes de eliminarlo para informar a los interesados.</p>
                        </div>
                    </div>

                    <div class="faq-item border border-gray-200 rounded-lg">
                        <button class="faq-question w-full px-6 py-4 text-left hover:bg-gray-50 transition-colors flex justify-between items-center">
                            <span class="font-semibold text-gray-900">¿Puedo ver estadísticas de mis eventos?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-answer hidden px-6 pb-4">
                            <p class="text-gray-600">Actualmente puedes ver información básica de tus eventos. Estamos desarrollando un sistema de analytics más completo que incluirá estadísticas de visualizaciones, interacciones y más métricas útiles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de contacto -->
    <div class="bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-xl p-8 text-white mt-12">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">¿No encontraste tu respuesta?</h2>
            <p class="text-lg mb-6">Si tienes alguna pregunta específica que no está cubierta aquí, no dudes en contactarnos.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('help.contact') }}" class="bg-white text-[#1A0046] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Contactar Soporte
                </a>
                <a href="{{ route('help.index') }}" class="border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#1A0046] transition-colors">
                    Centro de Ayuda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Funcionalidad de filtros
function filterFAQ(category) {
    // Actualizar botones
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-blue-500', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    
    event.target.classList.remove('bg-gray-200', 'text-gray-700');
    event.target.classList.add('active', 'bg-blue-500', 'text-white');
    
    // Mostrar/ocultar categorías
    document.querySelectorAll('.faq-category').forEach(cat => {
        if (cat.dataset.category === category || category === 'general') {
            cat.style.display = 'block';
        } else {
            cat.style.display = 'none';
        }
    });
}

// Funcionalidad de acordeón para las preguntas
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('svg');
            
            // Toggle respuesta
            answer.classList.toggle('hidden');
            
            // Rotar icono
            if (answer.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
});

// Búsqueda en tiempo real
document.getElementById('searchFAQ').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question span').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.style.display = 'block';
            // Mostrar la categoría padre
            item.closest('.faq-category').style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    // Si no hay término de búsqueda, mostrar todas las categorías
    if (searchTerm === '') {
        document.querySelectorAll('.faq-category').forEach(cat => {
            cat.style.display = 'block';
        });
        document.querySelectorAll('.faq-item').forEach(item => {
            item.style.display = 'block';
        });
    }
});
</script>
@endsection 