@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<style>
    .event-detail-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        min-height: 100vh;
    }
    
    .event-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.4);
    }
    
    .info-item {
        background: rgba(26, 0, 70, 0.05);
        border: 1px solid rgba(26, 0, 70, 0.1);
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        background: rgba(26, 0, 70, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.15);
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
    
    .event-image {
        border: 3px solid rgba(26, 0, 70, 0.1);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.2);
    }
    
    .category-badge {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: white;
        box-shadow: 0 4px 15px rgba(26, 0, 70, 0.3);
    }
    
    .icon-accent {
        color: #1A0046;
    }
    
    .map-placeholder {
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.1), rgba(50, 0, 78, 0.05));
        border: 2px dashed rgba(26, 0, 70, 0.3);
    }
</style>

<div class="event-detail-bg">
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="back-btn inline-flex items-center px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver
            </a>
        </div>

        <!-- Event Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $event->title }}</h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">{{ $event->description }}</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column - Event Image -->
            <div class="lg:col-span-1">
                <div class="event-card rounded-2xl p-6">
                    <div class="event-image rounded-xl overflow-hidden mb-6">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-[#1A0046] to-[#32004E]">
                                <span class="text-6xl text-white opacity-90">🎭</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Category Badge -->
                    <div class="text-center">
                        <span class="category-badge inline-block px-4 py-2 rounded-full text-sm font-bold">
                            {{ $event->category ? $event->category->name : 'Sin categoría' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Event Information -->
            <div class="lg:col-span-2">
                <div class="event-card rounded-2xl p-8">
                    <h2 class="text-2xl font-bold text-[#1A0046] mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Información General
                    </h2>
                    
                    <div class="grid md:grid-cols-2 gap-4 mb-8">
                        <!-- Date -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Fecha del Evento</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->date->format('d \d\e M \d\e Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Hora de apertura de puertas</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->time }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-9 4h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Inicio del show</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->time }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Fecha finalización</p>
                                    <p class="text-lg font-bold text-[#1A0046]">Dom 27 de abr de 2025</p>
                                </div>
                            </div>
                        </div>

                        <!-- Artist/Creator -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Artista</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->creator->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Lugar</p>
                                    <p class="text-lg font-bold text-[#1A0046]">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tickets -->
                        <div class="info-item rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#1A0046] to-[#32004E] rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Entradas</p>
                                    <p class="text-lg font-bold text-[#1A0046]">Libre (sin boletos)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-[#1A0046] mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 icon-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3"></path>
                            </svg>
                            Ubicación
                        </h3>
                        <div class="map-placeholder rounded-xl h-64 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 mx-auto text-[#1A0046] opacity-50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <p class="text-[#1A0046] font-semibold">{{ $event->location }}</p>
                                <p class="text-gray-600 text-sm mt-2">Mapa interactivo próximamente</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recommendations Section -->
                    <div class="bg-gradient-to-r from-[#1A0046]/5 to-[#32004E]/5 rounded-xl p-6 border border-[#1A0046]/10">
                        <h3 class="text-xl font-bold text-[#1A0046] mb-4">Recomendaciones</h3>
                        <div class="space-y-3 text-sm text-gray-700">
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Evento para mayores de edad, se requiere identificación de seguridad.
                            </p>
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Cursos limitados.
                            </p>
                            <p class="flex items-start">
                                <span class="w-2 h-2 bg-[#1A0046] rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                Advertencia de compra: Advertencia de compra ALL TICKETS TU BOLETA.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
