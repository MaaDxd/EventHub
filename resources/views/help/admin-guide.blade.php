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

    .info-box-red {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .info-box-blue {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .info-box-green {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(22, 163, 74, 0.1));
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .info-box-yellow {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .info-box-purple {
        background: linear-gradient(135deg, rgba(147, 51, 234, 0.1), rgba(124, 58, 237, 0.1));
        border: 1px solid rgba(147, 51, 234, 0.2);
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        <h1 class="text-5xl md:text-6xl font-black text-[#1A0046] mb-6 animate-fadeInDown tracking-tight">
            Guía para <span class="text-[#32004E]">Administradores</span>
        </h1>
        <p class="text-xl md:text-2xl text-[#32004E] opacity-80 max-w-2xl mx-auto leading-relaxed animate-fadeInUp">
            Herramientas y funciones avanzadas para la gestión completa de EventHub
        </p>
    </div>

    <!-- Navegación de la guía -->
    <div class="gradient-bg rounded-2xl p-8 mb-12 animate-fadeInUp">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Contenido de la guía</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <a href="#panel-admin" class="nav-pill">
                <span class="nav-pill-number">1</span>
                <span>Panel de Administración</span>
            </a>
            <a href="#gestion-usuarios" class="nav-pill">
                <span class="nav-pill-number">2</span>
                <span>Gestión de Usuarios</span>
            </a>
            <a href="#gestion-eventos" class="nav-pill">
                <span class="nav-pill-number">3</span>
                <span>Gestión de Eventos</span>
            </a>
            <a href="#herramientas" class="nav-pill">
                <span class="nav-pill-number">4</span>
                <span>Herramientas Avanzadas</span>
            </a>
        </div>
    </div>

    <!-- Sección 1: Panel de Administración -->
    <div id="panel-admin" class="mb-16">
        <div class="guide-card animate-fadeInUp">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h2 class="section-title">Panel de Administración</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-red-500 pl-6">
                        <h3 class="subsection-title">Acceso al panel</h3>
                        <p class="guide-text">Como administrador, tienes acceso a un panel especializado con herramientas avanzadas:</p>
                        <ol class="list-decimal list-inside space-y-2 guide-text ml-4">
                            <li>Inicia sesión con tu cuenta de administrador</li>
                            <li>Haz clic en el ícono de usuario en la barra de navegación</li>
                            <li>Selecciona "Panel Admin" del menú desplegable</li>
                            <li>Accede a todas las funciones de administración</li>
                        </ol>
                    </div>

                    <div class="info-box info-box-red">
                        <h4 class="font-semibold text-red-900 mb-2">🔐 Acceso restringido</h4>
                        <p class="text-red-800">El panel de administración solo está disponible para usuarios con rol de administrador. Las funciones son sensibles y requieren permisos especiales.</p>
                    </div>

                    <div class="border-l-4 border-blue-500 pl-6">
                        <h3 class="subsection-title">Vista general del panel</h3>
                        <p class="guide-text">El panel de administración incluye:</p>
                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="info-box info-box-blue">
                                <h4 class="font-semibold text-blue-900 mb-2">📊 Estadísticas</h4>
                                <ul class="text-blue-800 text-sm space-y-1">
                                    <li>• Total de usuarios registrados</li>
                                    <li>• Número de eventos activos</li>
                                    <li>• Actividad reciente</li>
                                    <li>• Métricas de uso</li>
                                </ul>
                            </div>
                            <div class="info-box info-box-green">
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
    </div>

    <!-- Sección 2: Gestión de Usuarios -->
    <div id="gestion-usuarios" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.1s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h2 class="section-title">Gestión de Usuarios</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-blue-500 pl-6">
                        <h3 class="subsection-title">Acceso a gestión de usuarios</h3>
                        <p class="guide-text">Para gestionar usuarios del sistema:</p>
                        <ol class="list-decimal list-inside space-y-2 guide-text ml-4">
                            <li>Desde el panel de administración, haz clic en "Usuarios"</li>
                            <li>Visualiza la lista completa de usuarios registrados</li>
                            <li>Utiliza filtros para encontrar usuarios específicos</li>
                            <li>Realiza acciones de moderación según sea necesario</li>
                        </ol>
                    </div>

                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Acciones disponibles</h3>
                        <p class="guide-text">Como administrador, puedes realizar las siguientes acciones sobre usuarios:</p>

                        <div class="grid md:grid-cols-3 gap-6 mt-6">
                            <div class="action-card">
                                <div class="text-3xl mb-3">👁️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Ver Detalles</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Ver información completa del usuario</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">🗑️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Eliminar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Eliminar usuario del sistema</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">🔄</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Restaurar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Restaurar usuario eliminado</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-box-yellow">
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
    </div>

    <!-- Sección 3: Gestión de Eventos -->
    <div id="gestion-eventos" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.2s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h2 class="section-title">Gestión de Eventos</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-green-500 pl-6">
                        <h3 class="subsection-title">Moderación de eventos</h3>
                        <p class="guide-text">Como administrador, puedes moderar todos los eventos de la plataforma:</p>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="info-box info-box-green">
                                <h4 class="font-semibold text-green-900 mb-2">📋 Lista de eventos</h4>
                                <ul class="text-green-800 text-sm space-y-1">
                                    <li>• Ver todos los eventos del sistema</li>
                                    <li>• Filtrar por creador o categoría</li>
                                    <li>• Buscar eventos específicos</li>
                                    <li>• Ordenar por fecha de creación</li>
                                </ul>
                            </div>

                            <div class="info-box info-box-blue">
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
                        <h3 class="subsection-title">Acciones de moderación</h3>
                        <p class="guide-text">Para cada evento puedes realizar las siguientes acciones:</p>

                        <div class="grid md:grid-cols-3 gap-6 mt-6">
                            <div class="action-card">
                                <div class="text-3xl mb-3">👁️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Ver Evento</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Ver detalles completos del evento</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">🗑️</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Eliminar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Eliminar evento del sistema</p>
                            </div>

                            <div class="action-card">
                                <div class="text-3xl mb-3">🔄</div>
                                <h4 class="font-semibold text-[#1A0046] mb-2">Restaurar</h4>
                                <p class="text-[#32004E] text-sm opacity-80">Restaurar evento eliminado</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-box-red">
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
    </div>

    <!-- Sección 4: Herramientas Avanzadas -->
    <div id="herramientas" class="mb-16">
        <div class="guide-card animate-fadeInUp" style="animation-delay: 0.3s;">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="section-icon">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <h2 class="section-title">Herramientas Avanzadas</h2>
                </div>

                <div class="space-y-8">
                    <div class="border-l-4 border-purple-500 pl-6">
                        <h3 class="subsection-title">Funciones especializadas</h3>
                        <p class="guide-text">El panel de administración incluye herramientas avanzadas para la gestión del sistema:</p>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div class="space-y-6">
                                <div class="info-box info-box-purple">
                                    <h4 class="font-semibold text-purple-900 mb-2">📊 Analytics</h4>
                                    <ul class="text-purple-800 text-sm space-y-1">
                                        <li>• Estadísticas de usuarios</li>
                                        <li>• Métricas de eventos</li>
                                        <li>• Análisis de actividad</li>
                                        <li>• Reportes de rendimiento</li>
                                    </ul>
                                </div>

                                <div class="info-box info-box-blue">
                                    <h4 class="font-semibold text-blue-900 mb-2">🔧 Mantenimiento</h4>
                                    <ul class="text-blue-800 text-sm space-y-1">
                                        <li>• Limpieza de datos</li>
                                        <li>• Optimización del sistema</li>
                                        <li>• Respaldo de información</li>
                                        <li>• Monitoreo de rendimiento</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="info-box info-box-green">
                                    <h4 class="font-semibold text-green-900 mb-2">👥 Gestión de roles</h4>
                                    <ul class="text-green-800 text-sm space-y-1">
                                        <li>• Asignar roles de usuario</li>
                                        <li>• Gestionar permisos</li>
                                        <li>• Crear administradores</li>
                                        <li>• Control de acceso</li>
                                    </ul>
                                </div>

                                <div class="info-box info-box-orange">
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

                    <div class="gradient-bg rounded-2xl p-8 text-white">
                        <h4 class="font-semibold mb-4 text-xl">🚨 Responsabilidades del administrador</h4>
                        <ul class="space-y-3">
                            <li>• <strong>Seguridad:</strong> Mantener la integridad y seguridad de la plataforma</li>
                            <li>• <strong>Moderación:</strong> Asegurar que el contenido cumpla con las políticas</li>
                            <li>• <strong>Soporte:</strong> Ayudar a usuarios con problemas técnicos</li>
                            <li>• <strong>Mantenimiento:</strong> Mantener el sistema funcionando correctamente</li>
                        </ul>
                    </div>
                </div>
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
