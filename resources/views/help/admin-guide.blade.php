@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-[#1A0046] mb-4">Guía para Administradores</h1>
        <p class="text-lg text-gray-600">Herramientas y funciones avanzadas para la gestión completa de EventHub</p>
    </div>

    <!-- Navegación de la guía -->
    <div class="bg-gray-50 rounded-xl p-6 mb-8">
        <h2 class="text-xl font-bold text-[#1A0046] mb-4">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="#panel-admin" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold mr-3">1</span>
                <span class="font-semibold">Panel de Administración</span>
            </a>
            <a href="#gestion-usuarios" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold mr-3">2</span>
                <span class="font-semibold">Gestión de Usuarios</span>
            </a>
            <a href="#gestion-eventos" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold mr-3">3</span>
                <span class="font-semibold">Gestión de Eventos</span>
            </a>
            <a href="#herramientas" class="flex items-center p-3 bg-white rounded-lg hover:shadow-md transition-shadow">
                <span class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center font-bold mr-3">4</span>
                <span class="font-semibold">Herramientas Avanzadas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Panel de Administración -->
    <div id="panel-admin" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">1</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Panel de Administración</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-red-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acceso al panel</h3>
                    <p class="text-gray-600 mb-4">Como administrador, tienes acceso a un panel especializado con herramientas avanzadas:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Inicia sesión con tu cuenta de administrador</li>
                        <li>Haz clic en el ícono de usuario en la barra de navegación</li>
                        <li>Selecciona "Panel Admin" del menú desplegable</li>
                        <li>Accede a todas las funciones de administración</li>
                    </ol>
                </div>

                <div class="bg-red-50 rounded-lg p-6">
                    <h4 class="font-semibold text-red-900 mb-2">🔐 Acceso restringido</h4>
                    <p class="text-red-800">El panel de administración solo está disponible para usuarios con rol de administrador. Las funciones son sensibles y requieren permisos especiales.</p>
                </div>

                <div class="border-l-4 border-blue-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Vista general del panel</h3>
                    <p class="text-gray-600 mb-4">El panel de administración incluye:</p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">📊 Estadísticas</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• Total de usuarios registrados</li>
                                <li>• Número de eventos activos</li>
                                <li>• Actividad reciente</li>
                                <li>• Métricas de uso</li>
                            </ul>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-semibold text-green-900 mb-2">⚙️ Controles</h4>
                            <ul class="text-green-800 text-sm space-y-1">
                                <li>• Gestión de usuarios</li>
                                <li>• Moderación de eventos</li>
                                <li>• Configuración del sistema</li>
                                <li>• Herramientas de mantenimiento</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 2: Gestión de Usuarios -->
    <div id="gestion-usuarios" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">2</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Gestión de Usuarios</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-blue-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acceso a gestión de usuarios</h3>
                    <p class="text-gray-600 mb-4">Para gestionar usuarios del sistema:</p>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600">
                        <li>Desde el panel de administración, haz clic en "Usuarios"</li>
                        <li>Visualiza la lista completa de usuarios registrados</li>
                        <li>Utiliza filtros para encontrar usuarios específicos</li>
                        <li>Realiza acciones de moderación según sea necesario</li>
                    </ol>
                </div>

                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acciones disponibles</h3>
                    <p class="text-gray-600 mb-4">Como administrador, puedes realizar las siguientes acciones sobre usuarios:</p>
                    
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">👁️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Ver Detalles</h4>
                            <p class="text-gray-600 text-sm">Ver información completa del usuario</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">🗑️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Eliminar</h4>
                            <p class="text-gray-600 text-sm">Eliminar usuario del sistema</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">🔄</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Restaurar</h4>
                            <p class="text-gray-600 text-sm">Restaurar usuario eliminado</p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-6">
                    <h4 class="font-semibold text-yellow-900 mb-2">⚠️ Importante sobre eliminación</h4>
                    <ul class="text-yellow-800 space-y-2">
                        <li>• <strong>Eliminación suave:</strong> Los usuarios se marcan como eliminados pero se pueden restaurar</li>
                        <li>• <strong>Eliminación permanente:</strong> Los usuarios se eliminan definitivamente del sistema</li>
                        <li>• <strong>Consideraciones:</strong> Al eliminar usuarios, también se eliminan sus eventos asociados</li>
                        <li>• <strong>Respaldo:</strong> Siempre verifica antes de realizar eliminaciones permanentes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 3: Gestión de Eventos -->
    <div id="gestion-eventos" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">3</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Gestión de Eventos</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-green-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Moderación de eventos</h3>
                    <p class="text-gray-600 mb-4">Como administrador, puedes moderar todos los eventos de la plataforma:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-semibold text-green-900 mb-2">📋 Lista de eventos</h4>
                            <ul class="text-green-800 text-sm space-y-1">
                                <li>• Ver todos los eventos del sistema</li>
                                <li>• Filtrar por creador o categoría</li>
                                <li>• Buscar eventos específicos</li>
                                <li>• Ordenar por fecha de creación</li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">🔍 Moderación</h4>
                            <ul class="text-blue-800 text-sm space-y-1">
                                <li>• Revisar contenido inapropiado</li>
                                <li>• Eliminar eventos problemáticos</li>
                                <li>• Restaurar eventos eliminados</li>
                                <li>• Contactar a creadores</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border-l-4 border-red-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Acciones de moderación</h3>
                    <p class="text-gray-600 mb-4">Para cada evento puedes realizar las siguientes acciones:</p>
                    
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">👁️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Ver Evento</h4>
                            <p class="text-gray-600 text-sm">Ver detalles completos del evento</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">🗑️</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Eliminar</h4>
                            <p class="text-gray-600 text-sm">Eliminar evento del sistema</p>
                        </div>
                        
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <div class="text-2xl mb-2">🔄</div>
                            <h4 class="font-semibold text-gray-900 mb-1">Restaurar</h4>
                            <p class="text-gray-600 text-sm">Restaurar evento eliminado</p>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 rounded-lg p-6">
                    <h4 class="font-semibold text-red-900 mb-2">⚠️ Políticas de moderación</h4>
                    <ul class="text-red-800 space-y-2">
                        <li>• <strong>Contenido inapropiado:</strong> Elimina eventos que violen las políticas de la plataforma</li>
                        <li>• <strong>Spam:</strong> Elimina eventos duplicados o de baja calidad</li>
                        <li>• <strong>Información falsa:</strong> Verifica la veracidad de la información de los eventos</li>
                        <li>• <strong>Comunicación:</strong> Contacta a los creadores antes de eliminar eventos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 4: Herramientas Avanzadas -->
    <div id="herramientas" class="mb-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-xl">4</span>
                </div>
                <h2 class="text-2xl font-bold text-[#1A0046]">Herramientas Avanzadas</h2>
            </div>

            <div class="space-y-6">
                <div class="border-l-4 border-purple-500 pl-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Funciones especializadas</h3>
                    <p class="text-gray-600 mb-4">El panel de administración incluye herramientas avanzadas para la gestión del sistema:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="bg-purple-50 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-900 mb-2">📊 Analytics</h4>
                                <ul class="text-purple-800 text-sm space-y-1">
                                    <li>• Estadísticas de usuarios</li>
                                    <li>• Métricas de eventos</li>
                                    <li>• Análisis de actividad</li>
                                    <li>• Reportes de rendimiento</li>
                                </ul>
                            </div>
                            
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-900 mb-2">🔧 Mantenimiento</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Limpieza de datos</li>
                                    <li>• Optimización del sistema</li>
                                    <li>• Respaldo de información</li>
                                    <li>• Monitoreo de rendimiento</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-green-50 rounded-lg p-4">
                                <h4 class="font-semibold text-green-900 mb-2">👥 Gestión de roles</h4>
                                <ul class="text-green-800 text-sm space-y-1">
                                    <li>• Asignar roles de usuario</li>
                                    <li>• Gestionar permisos</li>
                                    <li>• Crear administradores</li>
                                    <li>• Control de acceso</li>
                                </ul>
                            </div>
                            
                            <div class="bg-orange-50 rounded-lg p-4">
                                <h4 class="font-semibold text-orange-900 mb-2">📝 Configuración</h4>
                                <ul class="text-orange-800 text-sm space-y-1">
                                    <li>• Ajustes del sistema</li>
                                    <li>• Configuración de categorías</li>
                                    <li>• Personalización de la plataforma</li>
                                    <li>• Gestión de contenido</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-6 text-white">
                    <h4 class="font-semibold mb-2">🚨 Responsabilidades del administrador</h4>
                    <ul class="space-y-2">
                        <li>• <strong>Seguridad:</strong> Mantener la integridad y seguridad de la plataforma</li>
                        <li>• <strong>Moderación:</strong> Asegurar que el contenido cumpla con las políticas</li>
                        <li>• <strong>Soporte:</strong> Ayudar a usuarios con problemas técnicos</li>
                        <li>• <strong>Mantenimiento:</strong> Mantener el sistema funcionando correctamente</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre secciones -->
    <div class="flex justify-between items-center bg-gray-50 rounded-xl p-6">
        <a href="{{ route('help.creator-guide') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Guía para Creadores
        </a>
        <a href="{{ route('help.faq') }}" class="flex items-center text-[#1A0046] hover:text-[#32004E] transition-colors">
            Preguntas Frecuentes
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