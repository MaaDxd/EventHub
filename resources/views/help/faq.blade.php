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

    /* FAQ cards */
    .faq-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }

    .faq-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.4), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
    }

    /* FAQ items */
    .faq-item {
        background: #FFFFFF;
        border: 1px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        margin-bottom: 1rem;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-item:hover {
        border-color: #1A0046;
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.2);
    }

    .faq-question {
        width: 100%;
        padding: 1.5rem;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        color: #1A0046;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-question:hover {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.02), rgba(50, 0, 78, 0.02));
    }

    .faq-answer {
        padding: 0 1.5rem 1.5rem;
        color: #32004E;
        opacity: 0.8;
        line-height: 1.6;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-answer.show {
        max-height: 500px;
    }

    .faq-icon {
        width: 1.25rem;
        height: 1.25rem;
        color: #32004E;
        opacity: 0.6;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .faq-question.active .faq-icon {
        transform: rotate(180deg);
        opacity: 1;
    }

    /* Filter buttons */
    .filter-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid transparent;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        border-color: #1A0046;
    }

    .filter-btn:not(.active) {
        background: #FFFFFF;
        color: #32004E;
        border-color: rgba(26, 0, 70, 0.2);
    }

    .filter-btn:not(.active):hover {
        border-color: #1A0046;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.2);
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

    /* Search bar */
    .search-container {
        position: relative;
        max-width: 28rem;
        margin: 0 auto;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #FFFFFF;
    }

    .search-input:focus {
        outline: none;
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1.25rem;
        height: 1.25rem;
        color: #32004E;
        opacity: 0.6;
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Preguntas <span class="text-[#32004E]">Frecuentes</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            Resuelve tus dudas más comunes sobre EventHub
        </p>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-12 animate-fadeInUp">
        <div class="search-container">
            <input type="text" id="searchFAQ" placeholder="Buscar en las FAQ..."
                   class="search-input">
            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Categorías de preguntas -->
    <div class="grid md:grid-cols-3 gap-6 mb-12 animate-fadeInUp">
        <button onclick="filterFAQ('general')" class="filter-btn active">
            General
        </button>
        <button onclick="filterFAQ('usuarios')" class="filter-btn">
            Usuarios
        </button>
        <button onclick="filterFAQ('creadores')" class="filter-btn">
            Creadores
        </button>
    </div>

    <!-- Preguntas Frecuentes -->
    <div class="space-y-8">
        <!-- Preguntas Generales -->
        <div class="faq-category" data-category="general">
            <div class="faq-card animate-fadeInUp">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-[#1A0046] mb-8">Preguntas Generales</h2>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Qué es EventHub?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>EventHub es una plataforma que conecta a organizadores de eventos con personas interesadas en asistir. Permite crear, descubrir y gestionar eventos de todo tipo, desde conciertos hasta conferencias profesionales.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Es gratis usar EventHub?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Sí, EventHub es completamente gratuito para usuarios y creadores. Puedes registrarte, crear eventos y explorar eventos sin ningún costo.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Qué tipos de eventos puedo encontrar?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>EventHub incluye una amplia variedad de eventos: conciertos, conferencias, talleres, networking, eventos deportivos, exposiciones, festivales y mucho más. Los eventos pueden ser presenciales, virtuales o híbridos.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Cómo puedo contactar soporte?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Puedes contactar nuestro equipo de soporte a través de la página de contacto, enviando un correo electrónico o utilizando el formulario de ayuda. Estamos disponibles para ayudarte con cualquier consulta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas para Usuarios -->
        <div class="faq-category" data-category="usuarios">
            <div class="faq-card animate-fadeInUp" style="animation-delay: 0.1s;">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-[#1A0046] mb-8">Preguntas para Usuarios</h2>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Cómo me registro como usuario?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Para registrarte como usuario, haz clic en "Register" en la barra de navegación, selecciona "Registrarse como Usuario" y completa el formulario con tu información personal. Recibirás un correo de confirmación.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Puedo ver eventos sin registrarme?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Sí, puedes explorar eventos públicos sin necesidad de registrarte. Sin embargo, para acceder a funciones adicionales como guardar eventos favoritos o recibir notificaciones, necesitarás crear una cuenta.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Cómo puedo encontrar eventos cerca de mí?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Actualmente puedes explorar eventos por categoría y fecha. Estamos trabajando en funcionalidades de geolocalización para que puedas encontrar eventos cercanos a tu ubicación.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Puedo cambiar mi contraseña?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Sí, puedes cambiar tu contraseña desde tu perfil. Accede a "Mi Perfil" desde el menú de usuario y selecciona la opción para cambiar contraseña. Te pediremos tu contraseña actual por seguridad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preguntas para Creadores -->
        <div class="faq-category" data-category="creadores">
            <div class="faq-card animate-fadeInUp" style="animation-delay: 0.2s;">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-[#1A0046] mb-8">Preguntas para Creadores</h2>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Cómo me registro como creador?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Para registrarte como creador, haz clic en "Register" en la barra de navegación, selecciona "Registrarse como Creador" y completa el formulario. Necesitarás proporcionar información adicional sobre tu experiencia como organizador.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Puedo crear eventos gratuitos y de pago?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Actualmente EventHub está enfocado en eventos gratuitos. Estamos trabajando en funcionalidades para eventos de pago que estarán disponibles próximamente.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Puedo editar un evento después de publicarlo?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Sí, puedes editar tus eventos en cualquier momento desde tu panel de creador. Simplemente encuentra el evento en tu lista, haz clic en "Editar" y actualiza la información necesaria.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Qué pasa si necesito cancelar un evento?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Si necesitas cancelar un evento, puedes eliminarlo desde tu panel de creador. Te recomendamos actualizar la descripción del evento con la información de cancelación antes de eliminarlo para informar a los interesados.</p>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button class="faq-question">
                                <span>¿Puedo ver estadísticas de mis eventos?</span>
                                <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-answer">
                                <p>Actualmente puedes ver información básica de tus eventos. Estamos desarrollando un sistema de analytics más completo que incluirá estadísticas de visualizaciones, interacciones y más métricas útiles.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de contacto -->
    <div class="gradient-bg rounded-2xl p-12 text-white mt-16 animate-fadeInUp">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-6">¿No encontraste tu respuesta?</h2>
            <p class="text-xl mb-8 opacity-90">Si tienes alguna pregunta específica que no está cubierta aquí, no dudes en contactarnos.</p>
            <div class="flex justify-center flex-wrap gap-4">
                <a href="{{ route('help.contact') }}" class="px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Contactar Soporte
                </a>
                <a href="{{ route('help.index') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-[#1A0046] transition-all duration-300 transform hover:scale-105">
                    Centro de Ayuda
                </a>
            </div>
        </div>
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

// Funcionalidad de filtros
function filterFAQ(category) {
    // Actualizar botones
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('bg-white', 'text-[#32004E]', 'border-[#1A0046]');
    });

    event.target.classList.add('active');
    event.target.classList.remove('bg-white', 'text-[#32004E]', 'border-[#1A0046]');

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
            const isActive = this.classList.contains('active');

            // Cerrar todas las respuestas abiertas
            document.querySelectorAll('.faq-answer').forEach(ans => {
                ans.classList.remove('show');
            });
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('active');
            });

            // Abrir la respuesta seleccionada si no estaba activa
            if (!isActive) {
                this.classList.add('active');
                answer.classList.add('show');
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
