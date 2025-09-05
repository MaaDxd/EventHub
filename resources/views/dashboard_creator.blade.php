@extends('layouts.app')

@section('content')
<style>
    /* Gradientes corporativos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }
    
    .gradient-card {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.05), rgba(50, 0, 78, 0.1));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(50, 0, 78, 0.1);
    }
    
    .stat-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.1), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.05);
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.2);
    }
    
    .action-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.05);
        position: relative;
        overflow: hidden;
    }
    
    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #1A0046, #32004E);
    }
    
    .action-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(26, 0, 70, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
        color: #FFFFFF;
    }
    
    .btn-secondary {
        background: rgba(50, 0, 78, 0.1);
        color: #32004E;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.2);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-secondary:hover {
        background: rgba(50, 0, 78, 0.15);
        transform: translateY(-1px);
        color: #1A0046;
    }
    
    .event-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid rgba(50, 0, 78, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(26, 0, 70, 0.15);
        border-color: rgba(50, 0, 78, 0.2);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    
    .stat-label {
        color: #32004E;
        font-weight: 600;
        opacity: 0.8;
    }
    
    .icon-container {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.1), rgba(50, 0, 78, 0.15));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .icon-container {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        transform: scale(1.1);
    }
    
    .empty-state {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        border: 1px solid rgba(50, 0, 78, 0.1);
    }
    
    .welcome-banner {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.05), rgba(50, 0, 78, 0.1));
        border: 1px solid rgba(50, 0, 78, 0.15);
        border-radius: 24px;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(135deg, #1A0046, #32004E);
    }
    
    /* Animations */
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
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .animate-fadeInLeft {
        animation: fadeInLeft 0.6s ease-out;
    }
    
    /* Staggered animation delays */
    .delay-100 { animation-delay: 0.1s; animation-fill-mode: both; }
    .delay-200 { animation-delay: 0.2s; animation-fill-mode: both; }
    .delay-300 { animation-delay: 0.3s; animation-fill-mode: both; }
    .delay-400 { animation-delay: 0.4s; animation-fill-mode: both; }
</style>

<div class="gradient-bg min-h-screen">
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Banner -->
            <div class="welcome-banner p-8 mb-8 animate-fadeInUp">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="flex-1">
                        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tight">
                            Panel del Creador
                        </h1>
                        <p class="text-xl text-white opacity-80 mb-6">
                            Bienvenido, <span class="font-bold text-white">{{ auth()->user()->name }}</span>! 
                            Gestiona tus eventos y haz que cobren vida.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <span class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full text-[#32004E] font-semibold border border-[#32004E]/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Creador Verificado
                            </span>
                                <a href="{{ route('events.create') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Crear Nuevo Evento
                        </a>
                        <a href="{{ route('welcome') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0V9a1 1 0 011-1h2a1 1 0 011 1v12m0 0h3a1 1 0 001-1V10M9 21h6"></path>
                            </svg>
                            Ir al Inicio
                        </a>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                <div class="stat-card text-center animate-fadeInUp delay-100">
                    <div class="stat-number text-[#1A0046]">
                        {{ auth()->user()->createdEvents()->count() }}
                    </div>
                    <div class="stat-label">Total de Eventos</div>
                    <div class="mt-4 w-12 h-1 bg-gradient-to-r from-[#1A0046] to-[#32004E] mx-auto rounded-full"></div>
                </div>
                
                <div class="stat-card text-center animate-fadeInUp delay-200">
                    <div class="stat-number text-green-600">
                        {{ auth()->user()->createdEvents()->where('status', 'published')->count() }}
                    </div>
                    <div class="stat-label">Eventos Publicados</div>
                    <div class="mt-4 w-12 h-1 bg-gradient-to-r from-green-500 to-green-600 mx-auto rounded-full"></div>
                </div>
                
                <div class="stat-card text-center animate-fadeInUp delay-300">
                    <div class="stat-number text-amber-600">
                        {{ auth()->user()->createdEvents()->where('status', 'draft')->count() }}
                    </div>
                    <div class="stat-label">Borradores</div>
                    <div class="mt-4 w-12 h-1 bg-gradient-to-r from-amber-500 to-amber-600 mx-auto rounded-full"></div>
                </div>
                
                <div class="stat-card text-center animate-fadeInUp delay-400">
                    <div class="stat-number text-blue-600">
                        {{ auth()->user()->createdEvents()->where('date', '>=', now()->toDateString())->count() }}
                    </div>
                    <div class="stat-label">Próximos Eventos</div>
                    <div class="mt-4 w-12 h-1 bg-gradient-to-r from-blue-500 to-blue-600 mx-auto rounded-full"></div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-8">
                <!-- Create Event -->
                <div class="action-card animate-fadeInLeft delay-100">
                    <div class="icon-container">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A0046] mb-3 text-center">Crear Evento</h3>
                    <p class="text-[#32004E] opacity-80 mb-6 text-center leading-relaxed">
                        Da vida a tu próximo evento y compártelo con el mundo
                    </p>
                    <div class="text-center">
                        <a href="{{ route('events.create') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Crear Evento
                        </a>
                    </div>
                </div>

                <!-- Manage Events -->
                <div class="action-card animate-fadeInLeft delay-200">
                    <div class="icon-container">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A0046] mb-3 text-center">Mis Eventos</h3>
                    <p class="text-[#32004E] opacity-80 mb-6 text-center leading-relaxed">
                        Administra y edita todos tus eventos en un solo lugar
                    </p>
                    <div class="text-center">
                        <a href="{{ route('events.index') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Ver Eventos
                        </a>
                    </div>
                </div>

                <!-- Favorites -->
                <div class="action-card animate-fadeInLeft delay-300">
                    <div class="icon-container">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A0046] mb-3 text-center">Mis Favoritos</h3>
                    <p class="text-[#32004E] opacity-80 mb-6 text-center leading-relaxed">
                        Explora tus eventos favoritos guardados
                    </p>
                    <div class="text-center">
                        <a href="{{ route('favorites.index') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Ver Favoritos
                        </a>
                    </div>
                </div>

                <!-- Profile -->
                <div class="action-card animate-fadeInLeft delay-400">
                    <div class="icon-container">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A0046] mb-3 text-center">Mi Perfil</h3>
                    <p class="text-[#32004E] opacity-80 mb-6 text-center leading-relaxed">
                        Actualiza tu información personal y preferencias
                    </p>
                    <div class="text-center">
                        <a href="{{ route('profile.show') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Ver Perfil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Events -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 animate-fadeInUp delay-400">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-[#1A0046] flex items-center">
                        <svg class="w-8 h-8 mr-3 text-[#32004E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Eventos Recientes
                    </h2>
                    <a href="{{ route('events.index') }}" class="btn-secondary">
                        Ver Todos
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                @php
                    $recentEvents = auth()->user()->createdEvents()->with('category')->latest()->take(5)->get();
                @endphp
                
                @if($recentEvents->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentEvents as $event)
                            <div class="event-card p-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-6">
                                        @if($event->image && Storage::exists($event->image))
                                            <div class="relative">
                                                <img src="{{ Storage::url($event->image) }}" 
                                                     alt="{{ $event->title }}" 
                                                     class="w-20 h-20 object-cover rounded-xl shadow-lg">
                                                <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center shadow-lg">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-[#1A0046] mb-2">{{ $event->title }}</h3>
                                            <div class="flex items-center gap-4 text-[#32004E] opacity-80 mb-3">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                                </span>
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $event->time }}
                                                </span>
                                            </div>
                                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white rounded-full" 
                                                  style="background: linear-gradient(135deg, {{ $event->category ? $event->category->color : '#1A0046' }}, {{ $event->category ? $event->category->color.'99' : '#32004E' }})">
                                                {{ $event->category ? $event->category->name : ucfirst($event->category_type) }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('events.edit', $event) }}" 
                                           class="p-3 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-xl transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline" 
                                              onsubmit="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="text-8xl mb-6">🎨</div>
                        <h3 class="text-3xl font-bold text-[#1A0046] mb-4">¡Es hora de crear tu primer evento!</h3>
                        <p class="text-xl text-[#32004E] opacity-80 mb-8 max-w-md mx-auto">
                            Comparte tu pasión con el mundo y conecta con personas que comparten tus intereses
                        </p>
                        <a href="{{ route('events.create') }}" class="btn-primary text-lg px-8 py-4">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Crear Mi Primer Evento
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection