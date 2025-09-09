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

    /* Contact cards */
    .contact-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.4), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
    }

    .contact-icon {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #1A0046, #32004E);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .contact-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1A0046;
        margin-bottom: 0.5rem;
    }

    .contact-text {
        color: #32004E;
        opacity: 0.8;
        line-height: 1.6;
        margin-bottom: 0.25rem;
    }

    .contact-subtitle {
        color: #32004E;
        opacity: 0.6;
        font-size: 0.875rem;
    }

    /* Form styles */
    .form-input {
        width: 100%;
        padding: 1rem 1rem;
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #FFFFFF;
    }

    .form-input:focus {
        outline: none;
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
    }

    .form-textarea {
        width: 100%;
        padding: 1rem 1rem;
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #FFFFFF;
        resize: vertical;
        min-height: 120px;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 1rem 1rem;
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #FFFFFF;
    }

    .form-select:focus {
        outline: none;
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
    }

    .form-checkbox {
        width: 1rem;
        height: 1rem;
        border: 2px solid rgba(26, 0, 70, 0.2);
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-checkbox:checked {
        background: linear-gradient(135deg, #1A0046, #32004E);
        border-color: #1A0046;
    }

    .submit-btn {
        width: 100%;
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }

    /* Support channel cards */
    .support-card {
        background: #FFFFFF;
        border: 1px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .support-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.2);
        border-color: #1A0046;
    }

    .support-icon {
        width: 4rem;
        height: 4rem;
        background: linear-gradient(135deg, #1A0046, #32004E);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
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

    /* Modal styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 50;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: #FFFFFF;
        border-radius: 16px;
        max-width: 28rem;
        width: 100%;
        margin: 1rem;
        transform: scale(0.9);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-overlay.show .modal-content {
        transform: scale(1);
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Contacto y <span class="text-[#32004E]">Soporte</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            ¿Necesitas ayuda? Estamos aquí para asistirte
        </p>
    </div>

    <!-- Información de contacto y formulario -->
    <div class="grid lg:grid-cols-2 gap-12 mb-16">
        <!-- Información de contacto -->
        <div class="contact-card animate-fadeInUp">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-8">Información de Contacto</h2>

                <div class="space-y-8">
                    <div class="flex items-start space-x-6">
                        <div class="contact-icon">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="contact-title">Correo Electrónico</h3>
                            <p class="contact-text">soporte@eventhub.com</p>
                            <p class="contact-subtitle">Respuesta en 24-48 horas</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div class="contact-icon">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="contact-title">Horarios de Atención</h3>
                            <p class="contact-text">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                            <p class="contact-text">Sábados: 10:00 AM - 2:00 PM</p>
                            <p class="contact-subtitle">Horario del Pacífico (PST)</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div class="contact-icon">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="contact-title">Ubicación</h3>
                            <p class="contact-text">EventHub Headquarters</p>
                            <p class="contact-text">123 Tech Street, Suite 100</p>
                            <p class="contact-text">San Francisco, CA 94105</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6">
                        <div class="contact-icon">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="contact-title">Teléfono</h3>
                            <p class="contact-text">+1 (555) 123-4567</p>
                            <p class="contact-subtitle">Solo para consultas urgentes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="contact-card animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="p-8">
                <h2 class="text-2xl font-bold text-[#1A0046] mb-8">Envíanos un Mensaje</h2>

                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#1A0046] mb-2">Nombre Completo</label>
                        <input type="text" id="name" name="name" required class="form-input">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-[#1A0046] mb-2">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required class="form-input">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-[#1A0046] mb-2">Asunto</label>
                        <select id="subject" name="subject" required class="form-select">
                            <option value="">Selecciona un asunto</option>
                            <option value="technical">Problema Técnico</option>
                            <option value="account">Problema con mi Cuenta</option>
                            <option value="event">Consulta sobre Eventos</option>
                            <option value="billing">Facturación</option>
                            <option value="feature">Sugerencia de Funcionalidad</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-[#1A0046] mb-2">Mensaje</label>
                        <textarea id="message" name="message" rows="5" required class="form-textarea"
                                  placeholder="Describe tu consulta o problema..."></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="urgent" name="urgent" class="form-checkbox">
                        <label for="urgent" class="ml-3 text-sm text-[#32004E]">Marcar como urgente</label>
                    </div>

                    <button type="submit" class="submit-btn">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Canales de soporte -->
    <div class="contact-card mb-16 animate-fadeInUp" style="animation-delay: 0.2s;">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-[#1A0046] mb-8 text-center">Canales de Soporte</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="support-card">
                    <div class="support-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#1A0046] mb-3">Centro de Ayuda</h3>
                    <p class="text-[#32004E] opacity-80 mb-4">Encuentra respuestas rápidas a las preguntas más comunes</p>
                    <a href="{{ route('help.index') }}" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                        Visitar Centro de Ayuda
                    </a>
                </div>

                <div class="support-card">
                    <div class="support-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#1A0046] mb-3">Preguntas Frecuentes</h3>
                    <p class="text-[#32004E] opacity-80 mb-4">Resuelve tus dudas consultando nuestras FAQ</p>
                    <a href="{{ route('help.faq') }}" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                        Ver Preguntas Frecuentes
                    </a>
                </div>

                <div class="support-card">
                    <div class="support-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#1A0046] mb-3">Chat en Vivo</h3>
                    <p class="text-[#32004E] opacity-80 mb-4">Obtén ayuda inmediata con nuestro chat</p>
                    <button onclick="openChat()" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                        Iniciar Chat
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="gradient-bg rounded-2xl p-12 text-white animate-fadeInUp" style="animation-delay: 0.3s;">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-6">¿Necesitas Ayuda Inmediata?</h2>
            <p class="text-xl mb-8 opacity-90">Para problemas urgentes o críticos, puedes contactarnos directamente</p>

            <div class="grid md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                <div class="bg-white bg-opacity-10 rounded-xl p-6">
                    <h3 class="font-semibold mb-3 text-lg">📞 Línea de Emergencia</h3>
                    <p class="text-sm opacity-90">+1 (555) 999-8888</p>
                    <p class="text-xs opacity-75">24/7 para problemas críticos</p>
                </div>

                <div class="bg-white bg-opacity-10 rounded-xl p-6">
                    <h3 class="font-semibold mb-3 text-lg">🚨 Reportar Bug</h3>
                    <p class="text-sm opacity-90">bugs@eventhub.com</p>
                    <p class="text-xs opacity-75">Incluye capturas de pantalla</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Chat -->
<div id="chatModal" class="modal-overlay">
    <div class="modal-content">
        <div class="p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-[#1A0046]">Chat de Soporte</h3>
                <button onclick="closeChat()" class="text-[#32004E] opacity-60 hover:opacity-100 transition-opacity">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h4 class="text-xl font-semibold text-[#1A0046] mb-4">Chat en Vivo</h4>
                <p class="text-[#32004E] opacity-80 mb-8">Nuestro equipo de soporte está disponible para ayudarte en tiempo real.</p>

                <div class="space-y-4">
                    <button onclick="startChat()" class="w-full bg-gradient-to-r from-[#1A0046] to-[#32004E] text-white py-4 px-8 rounded-xl font-semibold hover:from-[#32004E] hover:to-[#1A0046] transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Iniciar Conversación
                    </button>
                    <button onclick="closeChat()" class="w-full border-2 border-[#1A0046] text-[#1A0046] py-4 px-8 rounded-xl font-semibold hover:bg-[#1A0046] hover:text-white transition-all duration-300">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Función para volver atrás
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '{{ route("help.index") }}';
    }
}

function openChat() {
    document.getElementById('chatModal').classList.add('show');
}

function closeChat() {
    document.getElementById('chatModal').classList.remove('show');
}

function startChat() {
    alert('Funcionalidad de chat en desarrollo. Por favor, utiliza el formulario de contacto o envía un correo electrónico.');
    closeChat();
}

// Cerrar modal al hacer clic fuera
document.getElementById('chatModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeChat();
    }
});

// Manejo del formulario
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Aquí iría la lógica para enviar el formulario
    alert('Gracias por tu mensaje. Te responderemos en las próximas 24-48 horas.');

    // Limpiar formulario
    this.reset();
});
</script>
@endsection
