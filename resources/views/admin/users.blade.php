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
                    <span class="text-5xl">👥</span>
                </div>
                <h1 class="text-5xl font-bold text-white mb-4 tracking-tight animate-slide-up">Gestión de Usuarios</h1>
                <p class="text-white text-xl opacity-90 max-w-3xl mx-auto leading-relaxed animate-slide-up-delay">
                    Administra usuarios, roles y permisos del sistema
                </p>
            </div>

            <!-- Acciones rápidas en header -->
            <div class="flex justify-center mb-12">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-4 shadow-xl">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('dashboard.admin') }}"
                           class="flex items-center px-6 py-3 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                           style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>← Volver al Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-white rounded-3xl shadow-2xl p-6 mb-12 border border-white border-opacity-20">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-xl shadow-lg"
                         style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                        🔍
                    </div>
                    <h2 class="text-xl font-bold ml-3" style="color: #1A0046;">Buscar y Filtrar Usuarios</h2>
                </div>

                <form method="GET" action="{{ route('admin.users') }}" class="grid md:grid-cols-4 gap-4 mb-6">
                    <!-- Búsqueda -->
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold" style="color: #32004E;">
                            <i class="fas fa-search mr-2"></i>Buscar Usuario
                        </label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Nombre o email..."
                                   class="w-full px-3 py-2 pl-10 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Filtro por Estado -->
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold" style="color: #32004E;">
                            <i class="fas fa-toggle-on mr-2"></i>Estado
                        </label>
                        <div class="relative">
                            <select name="status" class="w-full px-3 py-2 pl-10 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300 appearance-none">
                                <option value="">Todos los estados</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>✅ Activos</option>
                                <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>🗑️ Eliminados</option>
                            </select>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-toggle-on"></i>
                            </div>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Filtro por Rol -->
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold" style="color: #32004E;">
                            <i class="fas fa-user-tag mr-2"></i>Rol
                        </label>
                        <div class="relative">
                            <select name="role" class="w-full px-3 py-2 pl-10 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300 appearance-none">
                                <option value="">Todos los roles</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>⚙️ Administrador</option>
                                <option value="creator" {{ request('role') === 'creator' ? 'selected' : '' }}>🎨 Creador</option>
                                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>👤 Usuario</option>
                            </select>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Espacio vacío para alineación -->
                    <div></div>
                    <!-- Botones de acción -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="flex items-center px-6 py-2 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform animate-pulse-gentle"
                                style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                            <i class="fas fa-search mr-2"></i>
                            <span>Buscar Usuarios</span>
                        </button>
                        <a href="{{ route('admin.events.create') }}"
                           class="flex items-center px-6 py-2 rounded-xl text-white font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                           style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            <i class="fas fa-plus mr-2"></i>
                            <span>+ Crear Nuevo Evento</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="bg-green-100 bg-opacity-10 backdrop-blur-sm border border-green-400 border-opacity-30 text-green-200 px-6 py-4 rounded-2xl mb-8 shadow-xl animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center mr-4"
                             style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 bg-opacity-10 backdrop-blur-sm border border-red-400 border-opacity-30 text-red-200 px-6 py-4 rounded-2xl mb-8 shadow-xl animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center mr-4"
                             style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Información de resultados -->
            @if($users->count() > 0)
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-between text-white">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-white bg-opacity-20 flex items-center justify-center">
                                📊
                            </div>
                            <div>
                                <p class="text-lg font-semibold">
                                    Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }} usuarios
                                </p>
                                <p class="text-sm opacity-75">Gestiona los usuarios del sistema</p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-center space-x-2 text-sm opacity-75">
                                <i class="fas fa-users"></i>
                                <span>Usuarios encontrados</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Grid de usuarios -->
            @if($users->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($users as $user)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 transform group animate-stagger">
                            <!-- Header del card -->
                            <div class="h-24 relative overflow-hidden {{ $user->trashed() ? 'bg-red-100' : 'bg-gradient-to-r from-blue-500 to-purple-600' }}">
                                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                                <div class="absolute top-4 right-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-lg"
                                         style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                                        @if($user->role === 'admin') ⚙️
                                        @elseif($user->role === 'creator') 🎨
                                        @else 👤
                                        @endif
                                    </div>
                                </div>
                                <div class="absolute bottom-4 left-4 text-white">
                                    <h3 class="text-lg font-bold">{{ $user->name }}</h3>
                                    <p class="text-sm opacity-90">{{ $user->email }}</p>
                                </div>
                            </div>

                            <!-- Contenido del card -->
                            <div class="p-6">
                                <!-- Información del usuario -->
                                <div class="space-y-4 mb-6">
                                    <!-- Rol -->
                                    <div class="flex items-center text-sm">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #E0E7FF 0%, #C7D2FE 100%);">
                                            🏷️
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-800">Rol:</span>
                                            <span class="inline-block px-3 py-1 text-xs font-bold text-white rounded-full ml-2
                                                @if($user->role === 'admin') bg-red-500
                                                @elseif($user->role === 'creator') bg-purple-500
                                                @else bg-green-500
                                                @endif">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Eventos creados -->
                                    <div class="flex items-center text-sm">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);">
                                            🎉
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $user->createdEvents->count() }} eventos creados</span>
                                    </div>

                                    <!-- Fecha de registro -->
                                    <div class="flex items-center text-sm">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                             style="background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);">
                                            📅
                                        </div>
                                        <span class="font-medium text-gray-800">Registrado: {{ $user->created_at->format('d/m/Y') }}</span>
                                    </div>

                                    <!-- Teléfono -->
                                    @if($user->phone)
                                        <div class="flex items-center text-sm">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                                 style="background: linear-gradient(135deg, #FED7D7 0%, #FEB2B2 100%);">
                                                📞
                                            </div>
                                            <span class="font-medium text-gray-800">{{ $user->phone }}</span>
                                        </div>
                                    @endif

                                    <!-- Estado -->
                                    <div class="flex items-center text-sm">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3
                                            {{ $user->trashed() ? 'bg-red-100' : 'bg-green-100' }}">
                                            {{ $user->trashed() ? '🗑️' : '✅' }}
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-800">Estado:</span>
                                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full ml-2
                                                {{ $user->trashed() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $user->trashed() ? 'Eliminado' : 'Activo' }}
                                            </span>
                                            @if($user->trashed())
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $user->deleted_at->format('d/m/Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Acciones -->
                                <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                                    @if($user->trashed())
                                        <!-- Usuario eliminado - opciones de restaurar o eliminar permanentemente -->
                                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    class="flex items-center px-4 py-2 rounded-xl text-white font-semibold text-sm transition-all duration-300 hover:shadow-lg hover:scale-105 transform"
                                                    style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);"
                                                    onclick="return confirm('¿Estás seguro de que quieres restaurar este usuario?')">
                                                <i class="fas fa-undo mr-2"></i>
                                                <span>Restaurar</span>
                                            </button>
                                        </form>
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="flex items-center px-4 py-2 rounded-xl text-white font-semibold text-sm transition-all duration-300 hover:shadow-lg hover:scale-105 transform"
                                                        style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);"
                                                        onclick="return confirm('¿Estás seguro? Esta acción eliminará permanentemente al usuario y NO se puede deshacer.')">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <!-- Usuario activo - opción de eliminar lógicamente -->
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="flex items-center px-4 py-2 rounded-xl text-white font-semibold text-sm transition-all duration-300 hover:shadow-lg hover:scale-105 transform"
                                                        style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario? Podrás restaurarlo después.')">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        @else
                                            <div class="w-full text-center">
                                                <span class="text-gray-400 text-sm font-medium">No puedes eliminarte</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación mejorada -->
                @if($users->hasPages())
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="flex justify-center">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            @else
                <!-- Estado vacío mejorado -->
                <div class="text-center py-20">
                    <div class="inline-flex items-center justify-center w-32 h-32 rounded-3xl shadow-2xl mb-8"
                         style="background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);">
                        <span class="text-6xl">👥</span>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">No se encontraron usuarios</h2>
                    <p class="text-white text-lg opacity-75 mb-8 max-w-md mx-auto leading-relaxed">
                        No hay usuarios que coincidan con tus criterios de búsqueda. Intenta ajustar los filtros.
                    </p>
                    <a href="{{ route('admin.users') }}"
                       class="inline-flex items-center px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:shadow-xl hover:scale-105 transform"
                       style="background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);">
                        <i class="fas fa-users mr-3"></i>
                        <span>Ver Todos los Usuarios</span>
                    </a>
                </div>
            @endif
    </div>
</div>

<!-- Espacio adicional para bajar el footer -->
<div class="py-20"></div>

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

    /* Animación de pulso suave */
    .animate-pulse-gentle {
        animation: pulseGentle 2s ease-in-out infinite;
    }

    @keyframes pulseGentle {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
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

        .grid.lg\\:grid-cols-3 {
            grid-template-columns: 1fr;
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

    /* Estilos para select personalizado */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    /* Mejorar apariencia de inputs */
    input:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
    }

    /* Estilos para cards de usuario */
    .user-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .user-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(26, 0, 70, 0.15);
    }

    /* Gradientes personalizados */
    .gradient-purple {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }

    .gradient-blue-purple {
        background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
    }

    /* Mejorar paginación */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination a, .pagination span {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.05);
    }

    /* Estilos para estados de carga */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Mejorar tooltips */
    [title] {
        position: relative;
    }

    [title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        white-space: nowrap;
        z-index: 1000;
    }
</style>
@endsection
