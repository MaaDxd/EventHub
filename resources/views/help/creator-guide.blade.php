@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-[#1A0046] mb-4">Guía para Creadores</h1>
        <p class="text-lg text-gray-600">Aprende a crear y gestionar eventos exitosos en EventHub</p>
    </div>

    <!-- Navegación de la guía -->
    <div class="bg-gray-50 rounded-xl p-6 mb-8">
        <h2 class="text-xl font-bold text-[#1A0046] mb-4">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="#registro-creador" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold mr-3">1</span>
                <span class="font-semibold">Registro como Creador</span>
            </a>
            <a href="#crear-evento" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold mr-3">2</span>
                <span class="font-semibold">Crear tu Primer Evento</span>
            </a>
            <a href="#gestionar-eventos" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold mr-3">3</span>
                <span class="font-semibold">Gestionar Eventos</span>
            </a>
            <a href="#mejores-practicas" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold mr-3">4</span>
                <span class="font-semibold">Mejores Prácticas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Registro como Creador -->
    <div id="registro-creador" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">1</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Registro como Creador</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-purple-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Crear cuenta de creador</h3>
                    <p class="text-gray-600 mb-4">Para poder crear eventos en EventHub, necesitas registrarte como creador:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Haz clic en "Register" en la barra de navegación</li>
                        <li>Selecciona "Registrarse como Creador"</li>
                        <li>Completa el formulario con tu información personal</li>
                        <li>Proporciona información adicional sobre tu experiencia como organizador</li>
                        <li>Verifica tu correo electrónico</li>
                        <li>¡Ya puedes empezar a crear eventos!</li>
                    </ol>
                </div>

                <div class="bg-purple-50 rounded-lg p-6">
                    <h4 class="font-semibold text-purple-900 mb-2">💡 Información importante</h4>
                    <p class="text-purple-800">Como creador, tendrás acceso a herramientas especiales para gestionar tus eventos y llegar a más personas interesadas.</p>
                </div>

                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Panel de creador</h3>
                    <p class="text-gray-600 mb-4">Una vez registrado como creador, tendrás acceso a tu panel especializado:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li><strong>Vista general:</strong> Resumen de tus eventos y estadísticas</li>
                        <li><strong>Gestión de eventos:</strong> Crear, editar y eliminar eventos</li>
                        <li><strong>Perfil de creador:</strong> Gestionar tu información como organizador</li>
                        <li><strong>Herramientas avanzadas:</strong> Funciones específicas para creadores</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 2: Crear tu Primer Evento -->
    <div id="crear-evento" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">2</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Crear tu Primer Evento</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Proceso de creación</h3>
                    <p class="text-gray-600 mb-4">Sigue estos pasos para crear un evento exitoso:</p>
                    
                    <div class="space-y-4">
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-semibold text-green-900 mb-2">1. Acceder al formulario</h4>
                            <p class="text-green-800 text-sm">Desde tu panel de creador, haz clic en "Crear Evento" o navega a la sección de eventos.</p>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">2. Información básica</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• <strong>Nombre del evento:</strong> Título atractivo y descriptivo</li>
                                <li>• <strong>Descripción:</strong> Detalles completos sobre el evento</li>
                                <li>• <strong>Fecha y hora:</strong> Cuándo se realizará</li>
                                <li>• <strong>Ubicación:</strong> Dónde tendrá lugar</li>
                            </ul>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h4 class="font-semibold text-purple-900 mb-2">3. Categorización</h4>
                            <ul class="text-purple-800 text-sm space-y-1">
                                <li>• <strong>Categoría:</strong> Selecciona la que mejor describa tu evento</li>
                                <li>• <strong>Tipo de evento:</strong> Especifica si es presencial, virtual o híbrido</li>
                                <li>• <strong>Etiquetas:</strong> Agrega palabras clave relevantes</li>
                            </ul>
                        </div>
                        
                        <div class="bg-orange-50 rounded-lg p-4">
                            <h4 class="font-semibold text-orange-900 mb-2">4. Publicar</h4>
                            <p class="text-orange-800 text-sm">Revisa toda la información y haz clic en "Crear Evento" para publicarlo.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-6">
                    <h4 class="font-semibold text-yellow-900 mb-2">⚠️ Consejos para un evento exitoso</h4>
                    <ul class="text-yellow-800 space-y-2">
                        <li>• <strong>Nombre atractivo:</strong> Usa un título que capture la atención</li>
                        <li>• <strong>Descripción detallada:</strong> Incluye toda la información relevante</li>
                        <li>• <strong>Imágenes de calidad:</strong> Añade fotos que representen bien tu evento</li>
                        <li>• <strong>Información de contacto:</strong> Facilita que los asistentes te contacten</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 3: Gestionar Eventos -->
    <div id="gestionar-eventos" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">3</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Gestionar Eventos</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-blue-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Panel de gestión</h3>
                    <p class="text-gray-600 mb-4">Desde tu panel de creador puedes gestionar todos tus eventos:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">📋 Lista de eventos</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• Ver todos tus eventos</li>
                                <li>• Filtrar por estado</li>
                                <li>• Buscar eventos específicos</li>
                                <li>• Ordenar por fecha</li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-semibold text-green-900 mb-2">✏️ Editar eventos</h4>
                            <ul class="text-green-800 text-sm space-y-1">
                                <li>• Modificar información</li>
                                <li>• Actualizar detalles</li>
                                <li>• Cambiar fecha/hora</li>
                                <li>• Actualizar ubicación</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border-l-4 border-red-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acciones disponibles</h3>
                    <p class="text-gray-600 mb-4">Para cada evento puedes realizar las siguientes acciones:</p>
                    
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">👁️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Ver</h4>
                            <p class="text-gray-600 text-sm">Ver cómo se ve tu evento públicamente</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">✏️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Editar</h4>
                            <p class="text-gray-600 text-sm">Modificar la información del evento</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">🗑️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Eliminar</h4>
                            <p class="text-gray-600 text-sm">Eliminar el evento permanentemente</p>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 rounded-lg p-6">
                    <h4 class="font-semibold text-red-900 mb-2">⚠️ Importante sobre eliminación</h4>
                    <p class="text-red-800">Al eliminar un evento, esta acción no se puede deshacer. Asegúrate de que realmente quieres eliminar el evento antes de confirmar.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 4: Mejores Prácticas -->
    <div id="mejores-practicas" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">4</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Mejores Prácticas</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-orange-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Crear eventos atractivos</h3>
                    <p class="text-gray-600 mb-4">Sigue estas recomendaciones para maximizar el éxito de tus eventos:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-orange-50 rounded-lg p-4">
                                <h4 class="font-semibold text-orange-900 mb-2">📝 Contenido</h4>
                                <ul class="text-orange-800 text-sm space-y-1">
                                    <li>• Títulos claros y atractivos</li>
                                    <li>• Descripciones detalladas</li>
                                    <li>• Información de contacto clara</li>
                                    <li>• Detalles logísticos completos</li>
                                </ul>
                            </div>
                            
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="font-semibold text-green-900 mb-2">📅 Planificación</h4>
                                <ul class="text-green-800 text-sm space-y-1">
                                    <li>• Publica con anticipación</li>
                                    <li>• Actualiza información regularmente</li>
                                    <li>• Responde consultas rápidamente</li>
                                    <li>• Mantén eventos actualizados</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-purple-50 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-900 mb-2">🎯 Promoción</h4>
                                <ul class="text-purple-800 text-sm space-y-1">
                                    <li>• Usa categorías apropiadas</li>
                                    <li>• Agrega etiquetas relevantes</li>
                                    <li>• Comparte en redes sociales</li>
                                    <li>• Colabora con otros creadores</li>
                                </ul>
                            </div>
                            
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-900 mb-2">👥 Comunidad</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Construye relaciones</li>
                                    <li>• Solicita feedback</li>
                                    <li>• Aprende de otros eventos</li>
                                    <li>• Participa en la comunidad</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                    <h4 class="font-semibold mb-2">🚀 Consejos avanzados</h4>
                    <ul class="space-y-2">
                        <li>• <strong>Analiza el rendimiento:</strong> Revisa qué eventos tienen más éxito</li>
                        <li>• <strong>Experimenta con formatos:</strong> Prueba diferentes tipos de eventos</li>
                        <li>• <strong>Construye una marca:</strong> Mantén consistencia en tus eventos</li>
                        <li>• <strong>Networking:</strong> Conecta con otros creadores y asistentes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre secciones -->
    <div class="flex justify-between items-center bg-gray-50 rounded-xl p-6">
        <a href="{{ route('help.user-guide') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Guía para Usuarios
        </a>
        <a href="{{ route('help.admin-guide') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            Guía para Administradores
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