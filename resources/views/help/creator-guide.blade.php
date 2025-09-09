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

    .info-box-purple {
        background: linear-gradient(135deg, rgba(147, 51, 234, 0.1), rgba(124, 58, 237, 0.1));
        border: 1px solid rgba(147, 51, 234, 0.2);
    }

    .info-box-green {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(22, 163, 74, 0.1));
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .info-box-blue {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .info-box-yellow {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .info-box-red {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
        border: 1px solid rgba(239, 68, 68, 0.2);
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

    /* Action cards */
    .action-card {
        background: #FFFFFF;
        border: 1px solid rgba(26, 0, 70, 0.1);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.2);
        border-color: #1A0046;
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Guía para <span class="text-[#32004E]">Creadores</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            Aprende a crear y gestionar eventos exitosos en EventHub
        </p>
    </div>

    <!-- Navegación de la guía -->
    <div class="gradient-bg rounded-2xl p-8 mb-12 animate-fadeInUp">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <a href="#registro-creador" class="nav-pill">
                <span class="nav-pill-number">1</span>
                <span>Registro como Creador</span>
            </a>
            <a href="#crear-evento" class="nav-pill">
                <span class="nav-pill-number">2</span>
                <span>Crear tu Primer Evento</span>
            </a>
            <a href="#gestionar-eventos" class="nav-pill">
                <span class="nav-pill-number">3</span>
                <span>Gestionar Eventos</span>
            </a>
            <a href="#mejores-practicas" class="nav-pill">
                <span class="nav-pill-number">4</span>
                <span>Mejores Prácticas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Registro como Creador -->
    <div id="registro-creador" class="mb-16">
        <div class="guide-card animate-fadeInUp">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h2 class="section-title">Registro como Creador</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-purple-500 pl-6">
                        <h3 class="subsection-title">Crear cuenta de creador</h3>
                        <p class="guide-text">Para poder crear eventos en EventHub, necesitas registrarte como creador:</p>
                        <ol class="list-decimal list-inside space-y-2 guide-text ml-4">
                            <li>Haz clic en "Register" en la barra de navegación</li>
                            <li>Selecciona "Registrarse como Creador"</li>
                            <li>Completa el formulario con tu información personal</li>
                            <li>Proporciona información adicional sobre tu experiencia como organizador</li>
                            <li>Verifica tu correo electrónico</li>
                            <li>¡Ya puedes empezar a crear eventos!</li>
                        </ol>
                    </div>

                    <div class="info-box info-box-purple">
                        <h4 class="font-semibold text-purple-900 mb-2">💡 Información importante</h4>
                        <p class="text-purple-800">Como creador, tendrás acceso a herramientas especiales para gestionar tus eventos y llegar a más personas interesadas.</p>
                    </div>

                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Panel de creador</h3>
                        <p class="guide-text">Una vez registrado como creador, tendrás acceso a tu panel especializado:</p>
                        <ul class="list-disc list-inside space-y-2 guide-text ml-4">
                            <li><strong>Vista general:</strong> Resumen de tus eventos y estadísticas</li>
                            <li><strong>Gestión de eventos:</strong> Crear, editar y eliminar eventos</li>
                            <li><strong>Perfil de creador:</strong> Gestionar tu información como organizador</li>
                            <li><strong>Herramientas avanzadas:</strong> Funciones específicas para creadores</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 2: Crear tu Primer Evento -->
    <div id="crear-evento" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h2 class="section-title">Crear tu Primer Evento</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Proceso de creación</h3>
                        <p class="guide-text">Sigue estos pasos para crear un evento exitoso:</p>

                        <div class="space-y-6 mt-6">
                            <div class="info-box info-box-green">
                                <h4 class="font-semibold text-green-900 mb-2">1. Acceder al formulario</h4>
                                <p class="text-green-800 text-sm">Desde tu panel de creador, haz clic en "Crear Evento" o navega a la sección de eventos.</p>
                            </div>

                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">2. Información básica</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• <strong>Nombre del evento:</strong> Título atractivo y descriptivo</li>
                                    <li>• <strong>Descripción:</strong> Detalles completos sobre el evento</li>
                                    <li>• <strong>Fecha y hora:</strong> Cuándo se realizará</li>
                                    <li>• <strong>Ubicación:</strong> Dónde tendrá lugar</li>
                                </ul>
                            </div>

                            <div class="info-box info-box-purple">
                                <h4 class="font-semibold text-purple-900 mb-2">3. Categorización</h4>
                                <ul class="text-purple-800 text-sm space-y-1">
                                    <li>• <strong>Categoría:</strong> Selecciona la que mejor describa tu evento</li>
                                    <li>• <strong>Tipo de evento:</strong> Especifica si es presencial, virtual o híbrido</li>
                                    <li>• <strong>Etiquetas:</strong> Agrega palabras clave relevantes</li>
                                </ul>
                            </div>

                            <div class="info-box info-box-orange">
                                <h4 class="font-semibold text-orange-900 mb-2">4. Publicar</h4>
                                <p class="text-orange-800 text-sm">Revisa toda la información y haz clic en "Crear Evento" para publicarlo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-box-yellow">
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
    </div>

    <!-- Sección 3: Gestionar Eventos -->
    <div id="gestionar-eventos" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.2s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h2 class="section-title">Gestionar Eventos</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-blue-500 pl-6">
                        <h3 class="subsection-title">Panel de gestión</h3>
                        <p class="guide-text">Desde tu panel de creador puedes gestionar todos tus eventos:</p>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">📋 Lista de eventos</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Ver todos tus eventos</li>
                                    <li>• Filtrar por estado</li>
                                    <li>• Buscar eventos específicos</li>
                                    <li>• Ordenar por fecha</li>
                                </ul>
                            </div>

                            <div class="info-box info-box-green">
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
                        <h3 class="subsection-title">Acciones disponibles</h3>
                        <p class="guide-text">Para cada evento puedes realizar las siguientes acciones:</p>

                        <div class="grid md:grid-cols-3 gap-6 mt-6">
                            <div class="action-card">
                                <div class="text-3xl mb-3">👁️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Ver</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Ver cómo se ve tu evento públicamente</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">✏️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Editar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Modificar la información del evento</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">🗑️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Eliminar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Eliminar el evento permanentemente</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-box-red">
                        <h4 class="font-semibold text-red-900 mb-2">⚠️ Importante sobre eliminación</h4>
                        <p class="text-red-800">Al eliminar un evento, esta acción no se puede deshacer. Asegúrate de que realmente quieres eliminar el evento antes de confirmar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección 4: Mejores Prácticas -->
    <div id="mejores-practicas" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <h2 class="section-title">Mejores Prácticas</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-orange-500 pl-6">
                        <h3 class="subsection-title">Crear eventos atractivos</h3>
                        <p class="guide-text">Sigue estas recomendaciones para maximizar el éxito de tus eventos:</p>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="space-y-6">
                                <div class="info-box info-box-orange">
                                    <h4 class="font-semibold text-orange-900 mb-2">📝 Contenido</h4>
                                    <ul class="text-orange-800 text-sm space-y-1">
                                        <li>• Títulos claros y atractivos</li>
                                        <li>• Descripciones detalladas</li>
                                        <li>• Información de contacto clara</li>
                                        <li>• Detalles logísticos completos</li>
                                    </ul>
                                </div>

                                <div class="info-box info-box-green">
                                    <h4 class="font-semibold text-green-900 mb-2">📅 Planificación</h4>
                                    <ul class="text-green-800 text-sm space-y-1">
                                        <li>• Publica con anticipación</li>
                                        <li>• Actualiza información regularmente</li>
                                        <li>• Responde consultas rápidamente</li>
                                        <li>• Mantén eventos actualizados</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="info-box info-box-purple">
                                    <h4 class="font-semibold text-purple-900 mb-2">🎯 Promoción</h4>
                                    <ul class="text-purple-800 text-sm space-y-1">
                                        <li>• Usa categorías apropiadas</li>
                                        <li>• Agrega etiquetas relevantes</li>
                                        <li>• Comparte en redes sociales</li>
                                        <li>• Colabora con otros creadores</li>
                                    </ul>
                                </div>

                                <div class="info-box info-box-blue">
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

                    <div class="gradient-bg rounded-2xl p-8 text-white">
                        <h4 class="font-semibold mb-4 text-xl">🚀 Consejos avanzados</h4>
                        <ul class="space-y-3">
                            <li>• <strong>Analiza el rendimiento:</strong> Revisa qué eventos tienen más éxito</li>
                            <li>• <strong>Experimenta con formatos:</strong> Prueba diferentes tipos de eventos</li>
                            <li>• <strong>Construye una marca:</strong> Mantén consistencia en tus eventos</li>
                            <li>• <strong>Networking:</strong> Conecta con otros creadores y asistentes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navegación entre secciones -->
    <div class="flex justify-between items-center gradient-bg rounded-2xl p-8 animate-fadeInUp">
        <a href="{{ route('help.user-guide') }}" class="nav-link">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Guía para Usuarios
        </a>
        <a href="{{ route('help.admin-guide') }}" class="nav-link">
            Guía para Administradores
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
