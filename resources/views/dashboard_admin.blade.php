@extends('layouts.app')

@section('content')
<!-- Fondo con gradiente corporativo -->
<div class="min-h-screen" style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header con diseño mejorado -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl shadow-2xl mb-6 animate-float"
                     style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                    <span class="text-5xl">⚙️</span>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 tracking-tight animate-slide-up">Panel de Administración</h1>
                <p class="text-white text-xl opacity-90 max-w-3xl mx-auto leading-relaxed animate-slide-up-delay">
                    Bienvenido, {{ auth()->user()->name }}! Gestiona usuarios y eventos desde aquí.
                </p>
            </div>

            <!-- Acciones rápidas en header -->
            <div class="flex justify-center mb-12">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('welcome') }}"
                           class="flex items-center px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                           style="background: linear-gradient(135deg, #FFFFFF 20%, rgba(255, 255, 255, 0.9) 100%); color: #1A0046;">
                            <i class="fas fa-home mr-2"></i>
                            <span>🏠 Ir al Inicio</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="flex items-center px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                                    style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span>🚪 Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Estadísticas Generales -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Total Usuarios -->
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Total Usuarios</h3>
                            <p class="text-4xl font-bold text-blue-600">{{ $totalUsers ?? 0 }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                            👥
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            Usuarios registrados
                        </p>
                    </div>
                </div>

                <!-- Usuarios Activos -->
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Usuarios Activos</h3>
                            <p class="text-4xl font-bold text-green-600">{{ $activeUsers ?? 0 }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            ✅
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-user-check mr-2"></i>
                            Usuarios activos
                        </p>
                    </div>
                </div>

                <!-- Total Eventos -->
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Total Eventos</h3>
                            <p class="text-4xl font-bold text-purple-600">{{ $totalEvents ?? 0 }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                            🎉
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Eventos creados
                        </p>
                    </div>
                </div>

                <!-- Eventos Activos -->
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Eventos Activos</h3>
                            <p class="text-4xl font-bold text-indigo-600">{{ $activeEvents ?? 0 }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);">
                            🎊
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Eventos activos
                        </p>
                    </div>
                </div>
            </div>

            <!-- Opciones de Gestión -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <!-- Gestión de Usuarios -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-3xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl shadow-xl mb-6 group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                            <span class="text-4xl">👥</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Gestión de Usuarios</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">Administra usuarios, roles y permisos. Realiza eliminado lógico y restauración de cuentas.</p>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('admin.users') }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                            <i class="fas fa-list mr-3"></i>
                            <span>📋 Ver Todos los Usuarios</span>
                        </a>
                        <a href="{{ route('admin.users', ['status' => 'active']) }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            <i class="fas fa-user-check mr-3"></i>
                            <span>✅ Usuarios Activos</span>
                        </a>
                        <a href="{{ route('admin.users', ['status' => 'deleted']) }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                            <i class="fas fa-trash-restore mr-3"></i>
                            <span>🗑️ Usuarios Eliminados ({{ $deletedUsers ?? 0 }})</span>
                        </a>
                    </div>
                </div>

                <!-- Gestión de Eventos -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 hover:shadow-3xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl shadow-xl mb-6 group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                            <span class="text-4xl">🎉</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Gestión de Eventos</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">Supervisa eventos, modera contenido y gestiona el eliminado lógico de eventos.</p>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('admin.events') }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                            <i class="fas fa-list mr-3"></i>
                            <span>📋 Ver Todos los Eventos</span>
                        </a>
                        <a href="{{ route('admin.events', ['status' => 'active']) }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            <i class="fas fa-calendar-check mr-3"></i>
                            <span>✅ Eventos Activos</span>
                        </a>
                        <a href="{{ route('admin.events', ['status' => 'deleted']) }}"
                           class="flex items-center justify-center px-6 py-4 rounded-2xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform group/btn"
                           style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                            <i class="fas fa-trash-restore mr-3"></i>
                            <span>🗑️ Eventos Eliminados ({{ $deletedEvents ?? 0 }})</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white border-opacity-20">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl shadow-xl mb-4"
                         style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                        <span class="text-3xl">🚀</span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2">Acciones Rápidas</h3>
                    <p class="text-white text-lg opacity-75">Accede rápidamente a las funciones más utilizadas</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <a href="{{ route('admin.users', ['role' => 'admin']) }}"
                       class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group text-center animate-stagger">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-lg mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                            ⚙️
                        </div>
                        <div class="font-bold text-gray-800 text-lg">Administradores</div>
                        <div class="text-sm text-gray-600 mt-2">Gestionar administradores del sistema</div>
                    </a>
                    <a href="{{ route('admin.users', ['role' => 'creator']) }}"
                       class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group text-center animate-stagger">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-lg mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                            🎨
                        </div>
                        <div class="font-bold text-gray-800 text-lg">Creadores</div>
                        <div class="text-sm text-gray-600 mt-2">Gestionar creadores de eventos</div>
                    </a>
                    <a href="{{ route('admin.users', ['role' => 'user']) }}"
                       class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group text-center animate-stagger">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-lg mx-auto mb-4 group-hover:scale-110 transition-transform duration-300"
                             style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            👤
                        </div>
                        <div class="font-bold text-gray-800 text-lg">Usuarios</div>
                        <div class="text-sm text-gray-600 mt-2">Gestionar usuarios regulares</div>
                    </a>
                </div>
            </div>
    </div>
</div>

@include('layouts.footer')

<!-- Estilos adicionales -->
<style>
    /* Animaciones principales */
    .animate-slide-up {
        animation: slideUp 0.8s ease-out;
    }

    .animate-slide-up-delay {
        animation: slideUp 0.8s ease-out 0.2s both;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-stagger {
        animation: fadeInUp 0.6s ease-out both;
    }

    .animate-stagger:nth-child(1) { animation-delay: 0.1s; }
    .animate-stagger:nth-child(2) { animation-delay: 0.2s; }
    .animate-stagger:nth-child(3) { animation-delay: 0.3s; }
    .animate-stagger:nth-child(4) { animation-delay: 0.4s; }
    .animate-stagger:nth-child(5) { animation-delay: 0.5s; }
    .animate-stagger:nth-child(6) { animation-delay: 0.6s; }
    .animate-stagger:nth-child(7) { animation-delay: 0.7s; }
    .animate-stagger:nth-child(8) { animation-delay: 0.8s; }
    .animate-stagger:nth-child(9) { animation-delay: 0.9s; }

    /* Keyframes */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Efectos hover mejorados */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }

    /* Transiciones suaves */
    .transform {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Backdrop blur para mejor legibilidad */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }

    /* Glassmorphism effects */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Mejorar sombras */
    .shadow-3xl {
        box-shadow: 0 35px 60px rgba(26, 0, 70, 0.3);
    }

    /* Efectos para botones */
    .group\/btn:hover {
        transform: scale(1.05);
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .animate-stagger {
            animation-delay: 0s !important;
        }

        .grid.md\\:grid-cols-2 {
            grid-template-columns: 1fr;
        }

        .grid.md\\:grid-cols-3 {
            grid-template-columns: 1fr;
        }

        .grid.md\\:grid-cols-4 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Mejorar el foco en elementos interactivos */
    a:focus, button:focus {
        outline: 2px solid #1A0046;
        outline-offset: 2px;
    }

    /* Animación de carga para elementos */
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
