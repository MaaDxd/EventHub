@extends('layouts.app')

@section('content')
<style>
    .admin-events-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        min-height: 100vh;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .admin-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.4);
    }

    .admin-header {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.98));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(26, 0, 70, 0.3);
    }

    .back-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.4);
        color: white;
    }

    .filter-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.2);
    }

    .search-input, .select-input {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(26, 0, 70, 0.2);
        transition: all 0.3s ease;
    }

    .search-input:focus, .select-input:focus {
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.1);
        background: white;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.4);
        color: white;
    }

    .btn-secondary-custom {
        background: rgba(255, 255, 255, 0.9);
        color: #1A0046;
        border: 1px solid rgba(26, 0, 70, 0.2);
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background: #1A0046;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }

    .table-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.4);
    }

    .table-header {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.05), rgba(50, 0, 78, 0.05));
        border-bottom: 1px solid rgba(26, 0, 70, 0.1);
    }

    .table-row {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(26, 0, 70, 0.05);
    }

    .table-row:hover {
        background: rgba(26, 0, 70, 0.02);
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(26, 0, 70, 0.1);
    }

    .event-image {
        border: 2px solid rgba(26, 0, 70, 0.1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.15);
        transition: all 0.3s ease;
    }

    .event-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(26, 0, 70, 0.25);
    }

    .status-badge {
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(26, 0, 70, 0.2);
    }

    .action-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 0, 70, 0.3);
    }

    .icon-accent {
        color: #1A0046;
    }

    .pagination-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.2);
    }
</style>

<div class="admin-events-bg">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="admin-header rounded-2xl p-8 mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold text-[#1A0046] mb-2 flex items-center">
                            <svg class="w-8 h-8 mr-3 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Gestión de Eventos
                        </h1>
                        <p class="text-gray-600 text-lg">Supervisa y modera eventos del sistema</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('dashboard.admin') }}" class="back-btn inline-flex items-center px-6 py-3 rounded-xl font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="filter-card rounded-2xl p-8 mb-8">
                <form method="GET" action="{{ route('admin.events') }}" class="grid md:grid-cols-3 gap-6">
                    <!-- Búsqueda -->
                    <div>
                        <label class="block text-sm font-semibold text-[#1A0046] mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Buscar
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Título, descripción o ubicación..."
                               class="search-input w-full px-4 py-3 rounded-xl focus:outline-none">
                    </div>

                    <!-- Filtro por Estado -->
                    <div>
                        <label class="block text-sm font-semibold text-[#1A0046] mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Estado
                        </label>
                        <select name="status" class="select-input w-full px-4 py-3 rounded-xl focus:outline-none">
                            <option value="">Todos</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activos</option>
                            <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>Eliminados</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-end space-x-3">
                        <button type="submit" class="btn-primary-custom px-6 py-3 rounded-xl font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Buscar
                        </button>
                        <a href="{{ route('admin.events') }}" class="btn-secondary-custom px-6 py-3 rounded-xl font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-lg">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-lg">
                    <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Tabla de Eventos -->
            <div class="table-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="table-header">
                            <tr class="flex flex-col md:flex-row">
                                <th class="px-8 py-4 text-left text-xs font-bold text-[#1A0046] uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Evento
                                </th>
                                <th class="px-8 py-4 text-left text-xs font-bold text-[#1A0046] uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Creador
                                </th>
                                <th class="px-8 py-4 text-left text-xs font-bold text-[#1A0046] uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Fecha/Hora
                                </th>
                                <th class="px-8 py-4 text-left text-xs font-bold text-[#1A0046] uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Estado
                                </th>
                                <th class="px-8 py-4 text-left text-xs font-bold text-[#1A0046] uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="table-row {{ $event->trashed() ? 'bg-red-50/50' : '' }}">
                                    <td class="px-8 py-6">
                                        <div class="flex items-start">
                                            @if($event->image)
                                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                                     class="event-image w-16 h-16 object-cover rounded-xl mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-[#1A0046]/20 to-[#32004E]/20 rounded-xl mr-4 flex items-center justify-center text-2xl">
                                                    🎭
                                                </div>
                                            @endif
                                            <div class="flex-1">
                                                <div class="text-base font-bold text-[#1A0046] mb-1">{{ $event->title }}</div>
                                                <div class="text-sm text-gray-600 mb-2">{{ Str::limit($event->description, 120) }}</div>
                                                <div class="text-sm text-gray-600 mb-2 flex items-center">
                                                    <svg class="w-4 h-4 mr-1 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $event->location }}
                                                </div>
                                                @if($event->category)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-[#1A0046] to-[#32004E]  mt-2 shadow-md">
                                                        {{ $event->category->name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4 shadow-md">
                                                @if($event->creator->role === 'admin')
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                @elseif($event->creator->role === 'creator')
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-[#1A0046]">{{ $event->creator->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $event->creator->email }}</div>
                                                <div class="text-xs text-[#1A0046] font-medium mt-1">
                                                    @if($event->creator->role === 'admin') Administrador
                                                    @elseif($event->creator->role === 'creator') Creador
                                                    @else Usuario
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="space-y-2">
                                            <div class="flex items-center text-sm font-semibold text-[#1A0046]">
                                                <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $event->date->format('d/m/Y') }}
                                            </div>
                                            <div class="flex items-center text-sm font-semibold text-[#1A0046]">
                                                <svg class="w-4 h-4 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $event->time->format('H:i') }}
                                            </div>
                                            <div class="text-xs text-gray-500 ml-6">
                                                Creado: {{ $event->created_at->format('d/m/Y') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        @if($event->trashed())
                                            <div class="space-y-2">
                                                <span class="status-badge px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-red-400 to-red-600 text-white shadow-md">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminado
                                                </span>
                                                <div class="text-xs text-gray-500">
                                                    {{ $event->deleted_at->format('d/m/Y H:i') }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="status-badge px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full shadow-md
                                                @if($event->status === 'published') bg-gradient-to-r from-green-400 to-green-600 text-white
                                                @elseif($event->status === 'draft') bg-gradient-to-r from-yellow-400 to-yellow-600 text-white
                                                @else bg-gradient-to-r from-red-400 to-red-600 text-white
                                                @endif">
                                                @if($event->status === 'published')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Publicado
                                                @elseif($event->status === 'draft')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                    Borrador
                                                @else
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Cancelado
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        @if($event->trashed())
                                            <!-- Evento eliminado - opciones de restaurar o eliminar permanentemente -->
                                            <div class="flex flex-col space-y-2">
                                                <form method="POST" action="{{ route('admin.events.restore', $event->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="action-btn bg-gradient-to-r from-green-400 to-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold w-full flex items-center justify-center"
                                                            onclick="return confirm('¿Estás seguro de que quieres restaurar este evento?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                        </svg>
                                                        Restaurar
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.events.force-delete', $event->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold w-full flex items-center justify-center"
                                                            onclick="return confirm('¿Estás seguro? Esta acción eliminará permanentemente el evento y NO se puede deshacer.')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Eliminar Permanentemente
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- Evento activo - opción de eliminar lógicamente -->
                                            <form method="POST" action="{{ route('admin.events.delete', $event->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center justify-center"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este evento? Podrás restaurarlo después.')">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-.882-5.833-2.709"></path>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">No se encontraron eventos</p>
                                            <p class="text-gray-400 text-sm mt-1">con los filtros aplicados.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($events->hasPages())
                    <div class="pagination-card px-8 py-6 border-t border-gray-200">
                        {{ $events->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
