@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-[#1A0046] mb-4">Guía para Usuarios</h1>
        <p class="text-lg text-gray-600">Aprende a aprovechar al máximo EventHub como usuario</p>
    </div>

    <!-- Navegación de la guía -->
    <div class="bg-gray-50 rounded-xl p-6 mb-8">
        <h2 class="text-xl font-bold text-[#1A0046] mb-4">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="#registro" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">1</span>
                <span class="font-semibold">Registro y Primeros Pasos</span>
            </a>
            <a href="#explorar" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">2</span>
                <span class="font-semibold">Explorar Eventos</span>
            </a>
            <a href="#perfil" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">3</span>
                <span class="font-semibold">Gestionar Perfil</span>
            </a>
            <a href="#funciones" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">4</span>
                <span class="font-semibold">Funciones Avanzadas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Registro y Primeros Pasos -->
    <div id="registro" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">1</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Registro y Primeros Pasos</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-blue-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Crear tu cuenta</h3>
                    <p class="text-gray-600 mb-4">Para empezar a usar EventHub, necesitas crear una cuenta de usuario:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Haz clic en "Register" en la barra de navegación</li>
                        <li>Selecciona "Registrarse como Usuario"</li>
                        <li>Completa el formulario con tu información personal</li>
                        <li>Verifica tu correo electrónico</li>
                        <li>¡Ya puedes empezar a explorar eventos!</li>
                    </ol>
                </div>

                <div class="bg-blue-50 rounded-lg p-6">
                    <h4 class="font-semibold text-blue-900 mb-2">💡 Consejo</h4>
                    <p class="text-blue-800">Usa un correo electrónico válido para recibir notificaciones importantes sobre eventos que te interesen.</p>
                </div>

                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acceder a tu cuenta</h3>
                    <p class="text-gray-600 mb-4">Una vez registrado, puedes acceder a tu cuenta desde cualquier momento:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>Haz clic en "Login" en la barra de navegación</li>
                        <li>Ingresa tu correo electrónico y contraseña</li>
                        <li>Serás redirigido a tu panel de usuario</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 2: Explorar Eventos -->
    <div id="explorar" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">2</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Explorar Eventos</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-purple-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Navegar por eventos</h3>
                    <p class="text-gray-600 mb-4">EventHub te ofrece múltiples formas de descubrir eventos interesantes:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h4 class="font-semibold text-purple-900 mb-2">🏠 Página Principal</h4>
                            <p class="text-purple-800 text-sm">Encuentra eventos destacados y populares en la página de inicio.</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h4 class="font-semibold text-purple-900 mb-2">🎉 Sección de Eventos</h4>
                            <p class="text-purple-800 text-sm">Accede a todos los eventos públicos desde el menú "Eventos".</p>
                        </div>
                    </div>
                </div>

                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Información de eventos</h3>
                    <p class="text-gray-600 mb-4">Cada evento muestra información detallada:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li><strong>Nombre y descripción:</strong> Conoce de qué trata el evento</li>
                        <li><strong>Fecha y hora:</strong> Cuándo se realizará</li>
                        <li><strong>Ubicación:</strong> Dónde tendrá lugar</li>
                        <li><strong>Categoría:</strong> Tipo de evento (concierto, conferencia, etc.)</li>
                        <li><strong>Creador:</strong> Quién organiza el evento</li>
                    </ul>
                </div>

                <div class="bg-yellow-50 rounded-lg p-6">
                    <h4 class="font-semibold text-yellow-900 mb-2">⚠️ Importante</h4>
                    <p class="text-yellow-800">Los eventos son públicos y pueden ser vistos por cualquier usuario. Para crear eventos, necesitas registrarte como creador.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 3: Gestionar Perfil -->
    <div id="perfil" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">3</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Gestionar tu Perfil</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acceder a tu perfil</h3>
                    <p class="text-gray-600 mb-4">Para gestionar tu información personal:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Haz clic en el ícono de usuario en la barra de navegación</li>
                        <li>Selecciona "Mi Perfil" del menú desplegable</li>
                        <li>Aquí podrás ver y editar tu información</li>
                    </ol>
                </div>

                <div class="border-l-4 border-blue-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Información del perfil</h3>
                    <p class="text-gray-600 mb-4">Puedes gestionar la siguiente información:</p>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">Información Personal</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• Nombre completo</li>
                                <li>• Correo electrónico</li>
                                <li>• Número de teléfono</li>
                            </ul>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">Seguridad</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• Cambiar contraseña</li>
                                <li>• Configurar sesión</li>
                                <li>• Cerrar sesión</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 rounded-lg p-6">
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

    <!-- Sección 4: Funciones Avanzadas -->
    <div id="funciones" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">4</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Funciones Avanzadas</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-orange-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Panel de usuario</h3>
                    <p class="text-gray-600 mb-4">Tu panel personal te ofrece acceso rápido a las funciones principales:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>Vista general de tu cuenta</li>
                        <li>Acceso rápido a tu perfil</li>
                        <li>Navegación a eventos</li>
                        <li>Configuración de sesión</li>
                    </ul>
                </div>

                <div class="border-l-4 border-red-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Gestión de sesión</h3>
                    <p class="text-gray-600 mb-4">EventHub incluye un sistema de gestión de sesión para tu seguridad:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li><strong>Timeout automático:</strong> La sesión se cierra automáticamente por inactividad</li>
                        <li><strong>Extensión de sesión:</strong> Puedes extender tu sesión si lo necesitas</li>
                        <li><strong>Cierre manual:</strong> Cierra sesión cuando termines</li>
                    </ul>
                </div>

                <div class="bg-orange-50 rounded-lg p-6">
                    <h4 class="font-semibold text-orange-900 mb-2">🚀 Próximamente</h4>
                    <p class="text-orange-800">Estamos trabajando en nuevas funcionalidades como favoritos, notificaciones y recomendaciones personalizadas.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre secciones -->
    <div class="flex justify-between items-center bg-gray-50 rounded-xl p-6">
        <a href="{{ route('help.index') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al Centro de Ayuda
        </a>
        <a href="{{ route('help.creator-guide') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            Guía para Creadores
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>

<script>
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