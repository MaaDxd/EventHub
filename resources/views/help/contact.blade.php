@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-[#1A0046] mb-4">Contacto y Soporte</h1>
        <p class="text-lg text-gray-600">¿Necesitas ayuda? Estamos aquí para asistirte</p>
    </div>

    <!-- Información de contacto -->
    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <!-- Información de contacto -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-[#1A0046] mb-6">Información de Contacto</h2>
            
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Correo Electrónico</h3>
                        <p class="text-gray-600">soporte@eventhub.com</p>
                        <p class="text-sm text-gray-500">Respuesta en 24-48 horas</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Horarios de Atención</h3>
                        <p class="text-gray-600">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                        <p class="text-gray-600">Sábados: 10:00 AM - 2:00 PM</p>
                        <p class="text-sm text-gray-500">Horario del Pacífico (PST)</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Ubicación</h3>
                        <p class="text-gray-600">EventHub Headquarters</p>
                        <p class="text-gray-600">123 Tech Street, Suite 100</p>
                        <p class="text-gray-600">San Francisco, CA 94105</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Teléfono</h3>
                        <p class="text-gray-600">+1 (555) 123-4567</p>
                        <p class="text-sm text-gray-500">Solo para consultas urgentes</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-[#1A0046] mb-6">Envíanos un Mensaje</h2>
            
            <form class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                    <input type="text" id="name" name="name" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent">
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Asunto</label>
                    <select id="subject" name="subject" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent">
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
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                    <textarea id="message" name="message" rows="5" required 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1A0046] focus:border-transparent"
                              placeholder="Describe tu consulta o problema..."></textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="urgent" name="urgent" class="w-4 h-4 text-[#1A0046] border-gray-300 rounded focus:ring-[#1A0046]">
                    <label for="urgent" class="ml-2 text-sm text-gray-700">Marcar como urgente</label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-[#1A0046] to-[#32004E] text-white py-3 px-6 rounded-lg font-semibold hover:from-[#32004E] hover:to-[#1A0046] transition-all duration-200">
                    Enviar Mensaje
                </button>
            </form>
        </div>
    </div>

    <!-- Canales de soporte -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-12">
        <h2 class="text-2xl font-bold text-[#1A0046] mb-6 text-center">Canales de Soporte</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            <div class="text-center p-6 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Centro de Ayuda</h3>
                <p class="text-gray-600 mb-4">Encuentra respuestas rápidas a las preguntas más comunes</p>
                <a href="{{ route('help.index') }}" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Visitar Centro de Ayuda
                </a>
            </div>

            <div class="text-center p-6 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Preguntas Frecuentes</h3>
                <p class="text-gray-600 mb-4">Resuelve tus dudas consultando nuestras FAQ</p>
                <a href="{{ route('help.faq') }}" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Ver Preguntas Frecuentes
                </a>
            </div>

            <div class="text-center p-6 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Chat en Vivo</h3>
                <p class="text-gray-600 mb-4">Obtén ayuda inmediata con nuestro chat</p>
                <button onclick="openChat()" class="text-[#1A0046] font-semibold hover:text-[#32004E] transition-colors">
                    Iniciar Chat
                </button>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-xl p-8 text-white">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">¿Necesitas Ayuda Inmediata?</h2>
            <p class="text-lg mb-6">Para problemas urgentes o críticos, puedes contactarnos directamente</p>
            
            <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <h3 class="font-semibold mb-2">📞 Línea de Emergencia</h3>
                    <p class="text-sm opacity-90">+1 (555) 999-8888</p>
                    <p class="text-xs opacity-75">24/7 para problemas críticos</p>
                </div>
                
                <div class="bg-white bg-opacity-10 rounded-lg p-4">
                    <h3 class="font-semibold mb-2">🚨 Reportar Bug</h3>
                    <p class="text-sm opacity-90">bugs@eventhub.com</p>
                    <p class="text-xs opacity-75">Incluye capturas de pantalla</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Chat -->
<div id="chatModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#1A0046]">Chat de Soporte</h3>
                    <button onclick="closeChat()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <h4 class="font-semibold text-gray-900 mb-2">Chat en Vivo</h4>
                    <p class="text-gray-600 mb-6">Nuestro equipo de soporte está disponible para ayudarte en tiempo real.</p>
                    
                    <div class="space-y-3">
                        <button onclick="startChat()" class="w-full bg-[#1A0046] text-white py-3 px-6 rounded-lg font-semibold hover:bg-[#32004E] transition-colors">
                            Iniciar Conversación
                        </button>
                        <button onclick="closeChat()" class="w-full border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openChat() {
    document.getElementById('chatModal').classList.remove('hidden');
}

function closeChat() {
    document.getElementById('chatModal').classList.add('hidden');
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