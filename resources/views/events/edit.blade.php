@extends('layouts.app')

@section('content')
<style>
    /* Gradientes y animaciones con colores corporativos */
    .form-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        background-size: 400% 400%;
        animation: gradientShift 20s ease infinite;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .form-container {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px rgba(26, 0, 70, 0.4);
        animation: containerFloat 6s ease-in-out infinite;
    }
    
    @keyframes containerFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .form-title {
        background: linear-gradient(90deg, #1A0046 0%, #32004E 50%, #000000 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: titleShine 3s ease-in-out infinite;
    }
    
    @keyframes titleShine {
        0%, 100% { filter: brightness(1); }
        50% { filter: brightness(1.3); }
    }
    
    .input-group {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .input-group:hover {
        transform: translateY(-2px);
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(26, 0, 70, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    .form-input:focus {
        background: rgba(255, 255, 255, 1);
        border-color: #1A0046;
        box-shadow: 0 0 0 4px rgba(26, 0, 70, 0.1), 0 10px 25px rgba(26, 0, 70, 0.15);
        transform: scale(1.02);
    }
    
    .form-input:hover {
        border-color: rgba(26, 0, 70, 0.4);
        box-shadow: 0 5px 15px rgba(26, 0, 70, 0.1);
    }
    
    .floating-label {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        padding: 0 8px;
        color: #666;
        pointer-events: none;
        transition: all 0.3s ease;
        border-radius: 4px;
    }
    
    .form-input:focus + .floating-label,
    .form-input:not(:placeholder-shown) + .floating-label {
        top: -8px;
        font-size: 12px;
        color: #1A0046;
        font-weight: 600;
    }
    
    .upload-area {
        border: 2px dashed rgba(26, 0, 70, 0.3);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(26, 0, 70, 0.05));
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .upload-area::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -100%;
        width: 100%;
        height: calc(100% + 4px);
        background: linear-gradient(90deg, transparent, rgba(26, 0, 70, 0.1), transparent);
        transition: left 0.6s;
    }
    
    .upload-area:hover::before {
        left: 100%;
    }
    
    .upload-area:hover {
        border-color: #1A0046;
        background: linear-gradient(135deg, rgba(26, 0, 70, 0.1), rgba(255, 255, 255, 0.1));
        transform: scale(1.02);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        color: white;
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.4);
    }
    
    .btn-secondary {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(26, 0, 70, 0.2);
        color: #1A0046;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: rgba(26, 0, 70, 0.1);
        border-color: #1A0046;
        transform: translateY(-2px);
        color: #1A0046;
    }
    
    .char-counter {
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .icon-accent {
        color: #1A0046;
        filter: drop-shadow(0 2px 4px rgba(26, 0, 70, 0.3));
    }
    
    .floating-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        animation: floatUp 15s infinite linear;
    }
    
    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(100vh) scale(0) rotate(0deg);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 0.8;
        }
        100% {
            opacity: 0;
            transform: translateY(-100px) scale(1) rotate(360deg);
        }
    }
    
    #map {
        border: 2px solid rgba(26, 0, 70, 0.2);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    #map:hover {
        border-color: rgba(26, 0, 70, 0.5);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.15);
    }
    
    /* Estilos para el mapa interactivo */
    .map-tiles {
        filter: saturate(1.1) contrast(1.1) brightness(0.98);
    }
    
    .custom-div-icon {
        background: transparent;
        border: none;
    }
    
    .marker-pin {
        width: 40px;
        height: 40px;
        position: relative;
        transform-origin: center bottom;
        animation: bounce 1s ease-in-out infinite alternate;
    }
    
    @keyframes bounce {
        0% { transform: translateY(0); }
        100% { transform: translateY(-5px); }
    }
    
    .pulse {
        position: absolute;
        width: 24px;
        height: 24px;
        left: 8px;
        top: 8px;
        background: rgba(26, 0, 70, 0.2);
        border-radius: 50%;
        animation: pulse 2s infinite;
        z-index: -1;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(0.5);
            opacity: 1;
        }
        100% {
            transform: scale(3);
            opacity: 0;
        }
    }
    
    .pulsating-circle {
        animation: circle-pulse 3s infinite;
    }
    
    @keyframes circle-pulse {
        0% {
            opacity: 0.6;
            transform: scale(1);
        }
        50% {
            opacity: 0.3;
            transform: scale(1.05);
        }
        100% {
            opacity: 0.6;
            transform: scale(1);
        }
    }
    
    .gradient-border {
        background: linear-gradient(90deg, #1A0046 0%, #32004E 100%);
    }
    
    .text-gradient {
        background: linear-gradient(90deg, #1A0046 0%, #32004E 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .category-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%231A0046' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5rem 1.5rem;
    }
    
    .current-image-card {
        background: rgba(26, 0, 70, 0.03);
        border: 2px solid rgba(26, 0, 70, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .current-image-card:hover {
        border-color: rgba(26, 0, 70, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.1);
    }
    
    .image-preview {
        border: 3px solid rgba(26, 0, 70, 0.1);
        transition: all 0.3s ease;
    }
    
    .image-preview:hover {
        border-color: rgba(26, 0, 70, 0.3);
        transform: scale(1.05);
    }
</style>

<div class="form-bg min-h-screen py-12 px-4 sm:px-6 lg:px-8 relative">
    <!-- Partículas flotantes -->
    <div class="floating-particles">
        <div class="particle w-2 h-2" style="left: 10%; animation-delay: 0s; animation-duration: 12s;"></div>
        <div class="particle w-1 h-1" style="left: 20%; animation-delay: 2s; animation-duration: 15s;"></div>
        <div class="particle w-3 h-3" style="left: 30%; animation-delay: 4s; animation-duration: 10s;"></div>
        <div class="particle w-1 h-1" style="left: 50%; animation-delay: 8s; animation-duration: 14s;"></div>
        <div class="particle w-2 h-2" style="left: 70%; animation-delay: 12s; animation-duration: 11s;"></div>
        <div class="particle w-1 h-1" style="left: 90%; animation-delay: 16s; animation-duration: 17s;"></div>
    </div>

    <div class="max-w-5xl mx-auto relative z-10">
        <div class="form-container rounded-3xl shadow-2xl p-8 md:p-12">
            <!-- Header Mejorado -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 gradient-border rounded-2xl mb-6 shadow-lg">
                    <i class="bi bi-pencil-square text-3xl text-white"></i>
                </div>
                <h2 class="form-title text-4xl md:text-5xl font-black mb-4">Editar Evento</h2>
                <div class="w-24 h-1 gradient-border mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600 text-lg">Modifica la información de tu evento y mantén todo actualizado</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div class="input-group">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-type icon-accent mr-2"></i>
                        Título del Evento *
                    </label>
                    <input id="title" name="title" type="text" required placeholder=" "
                           class="form-input w-full px-6 py-4 rounded-xl text-lg font-medium @error('title') border-red-500 @enderror"
                           value="{{ old('title', $event->title) }}">
                    <label for="title" class="floating-label">Ej: Concierto de Rock en Vivo</label>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="input-group">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-3 flex items-center justify-between">
                        <span class="flex items-center">
                            <i class="bi bi-card-text icon-accent mr-2"></i>
                            Descripción *
                        </span>
                        <span class="text-xs text-gray-500">(máximo 150 caracteres)</span>
                    </label>
                    <div class="relative">
                        <textarea id="description" name="description" rows="4" required maxlength="150" placeholder=" "
                                  class="form-input w-full px-6 py-4 rounded-xl text-lg resize-none @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                        <label for="description" class="floating-label">Describe tu evento, qué incluye, qué esperar...</label>
                        <div class="absolute bottom-3 right-3 char-counter text-sm">
                            <span id="char-count">0</span>/150
                        </div>
                    </div>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Fecha y Hora -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="input-group">
                        <label for="date" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="bi bi-calendar-event icon-accent mr-2"></i>
                            Fecha *
                        </label>
                        <input id="date" name="date" type="date" required
                               class="form-input w-full px-6 py-4 rounded-xl text-lg @error('date') border-red-500 @enderror"
                               value="{{ old('date', $event->date->format('Y-m-d')) }}">
                        @error('date')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="time" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                            <i class="bi bi-clock icon-accent mr-2"></i>
                            Hora *
                        </label>
                        <input id="time" name="time" type="time" required
                               class="form-input w-full px-6 py-4 rounded-xl text-lg @error('time') border-red-500 @enderror"
                               value="{{ old('time', $event->time) }}">
                        @error('time')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Ubicación y Mapa -->
                <div class="input-group">
                    <label for="location" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-geo-alt icon-accent mr-2"></i>
                        Ubicación *
                    </label>
                    <input id="location" name="location" type="text" required placeholder=" "
                           class="form-input w-full px-6 py-4 rounded-xl text-lg mb-4 @error('location') border-red-500 @enderror"
                           value="{{ old('location', $event->location) }}">
                    <label for="location" class="floating-label">Ej: Estadio Nacional, Calle Principal 123</label>
                    <input type="hidden" id="lat" name="lat" value="{{ old('lat', $event->lat ?? '') }}">
                    <input type="hidden" id="lng" name="lng" value="{{ old('lng', $event->lng ?? '') }}">
                    <div id="map" style="width: 100%; height: 350px;" class="rounded-xl shadow-lg"></div>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div class="input-group">
                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-tags icon-accent mr-2"></i>
                        Categoría *
                    </label>
                    <div class="relative">
                        <select id="category_id" name="category_id" required
                            class="form-input category-select w-full px-6 py-4 rounded-xl text-lg appearance-none cursor-pointer @error('category_id') border-red-500 @enderror">
                            <option value="" disabled>Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Imagen Actual -->
                @if($event->image)
                <div class="input-group">
                    <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-image icon-accent mr-2"></i>
                        Imagen Actual
                    </label>
                    <div class="current-image-card">
                        <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                            <img src="{{ Storage::url($event->image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="image-preview w-full md:w-40 h-40 object-cover rounded-xl shadow-lg">
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $event->title }}</h4>
                                <p class="text-sm text-gray-600 mb-1 flex items-center">
                                    <i class="bi bi-check-circle text-green-500 mr-2"></i>
                                    Imagen actual del evento
                                </p>
                                <p class="text-xs text-gray-500">
                                    Sube una nueva imagen abajo para reemplazarla
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Nueva Imagen -->
                <div class="input-group">
                    <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                        <i class="bi bi-camera icon-accent mr-2"></i>
                        {{ $event->image ? 'Nueva Imagen del Evento' : 'Imagen del Evento' }}
                    </label>
                    <div class="upload-area flex justify-center px-8 pt-8 pb-8 rounded-xl cursor-pointer">
                        <div class="space-y-4 text-center relative z-10">
                            <div class="mx-auto flex items-center justify-center w-16 h-16 gradient-border rounded-xl shadow-lg">
                                <i class="bi bi-cloud-upload text-2xl text-white"></i>
                            </div>
                            <div>
                                <label for="image" class="cursor-pointer">
                                    <span class="text-lg font-semibold text-gradient hover:opacity-80 transition-opacity">
                                        {{ $event->image ? 'Cambiar imagen' : 'Subir una imagen' }}
                                    </span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="text-gray-600 mt-2">o arrastra y suelta aquí</p>
                            </div>
                            <p class="text-sm text-gray-500 bg-white/80 px-3 py-1 rounded-full border border-gray-200">
                                PNG, JPG, GIF hasta 2MB
                            </p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-gray-200">
                    <a href="{{ route('dashboard.creator') }}"
                       class="btn-secondary px-8 py-4 text-center font-semibold rounded-xl transition-all duration-300 hover:scale-105">
                        <i class="bi bi-arrow-left mr-2"></i>Cancelar
                    </a>
                    <button type="submit"
                            class="btn-primary px-8 py-4 font-bold rounded-xl transition-all duration-300 hover:scale-105 flex items-center justify-center">
                        <i class="bi bi-check-circle mr-2"></i>Actualizar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Character counter for description
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionTextarea = document.getElementById('description');
        const charCount = document.getElementById('char-count');

        function updateCharCount() {
            const currentLength = descriptionTextarea.value.length;
            charCount.textContent = currentLength;

            // Change color based on character count
            if (currentLength > 140) {
                charCount.className = 'char-counter text-red-500';
            } else if (currentLength > 120) {
                charCount.className = 'char-counter text-orange-500';
            } else {
                charCount.className = 'char-counter text-gray-500';
            }
        }

        // Update count on input
        descriptionTextarea.addEventListener('input', updateCharCount);

        // Initial count update
        updateCharCount();
    });

    // Preview image functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('div');
                preview.className = 'mt-4';
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="mx-auto h-32 w-48 object-cover rounded-lg shadow-lg border-2 border-purple-900/20">
                    <p class="text-center text-sm text-gray-600 mt-2 font-medium">${file.name}</p>
                `;

                const container = document.querySelector('.upload-area .space-y-4');
                const existingPreview = container.querySelector('.mt-4');
                if (existingPreview) {
                    existingPreview.remove();
                }
                container.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
    });

    // Floating labels
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.setAttribute('placeholder', ' ');
            }
        });
        
        input.addEventListener('focus', function() {
            this.removeAttribute('placeholder');
        });
    });
</script>

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = parseFloat(document.getElementById('lat').value);
        var lng = parseFloat(document.getElementById('lng').value);
        var hasCoords = !isNaN(lat) && !isNaN(lng);
        
        // Coordenadas por defecto: Bogotá, Colombia
        var defaultLat = hasCoords ? lat : 4.7110;
        var defaultLng = hasCoords ? lng : -74.0721;
        
        // Crear el contenedor de carga
        var mapContainer = document.getElementById('map');
        var loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-50 rounded-xl';
        loadingOverlay.innerHTML = `
            <div class="text-center">
                <div class="w-12 h-12 border-4 border-[#1A0046] border-t-transparent rounded-full animate-spin mx-auto mb-3"></div>
                <p class="text-[#1A0046] font-medium">Cargando mapa...</p>
            </div>
        `;
        mapContainer.style.position = 'relative';
        mapContainer.appendChild(loadingOverlay);
        
        // Inicializar el mapa con opciones mejoradas
        var map = L.map('map', {
            zoomControl: true,
            scrollWheelZoom: true,
            doubleClickZoom: true,
            dragging: true,
            zoomAnimation: true,
            fadeAnimation: true,
            markerZoomAnimation: true
        }).setView([defaultLat, defaultLng], 13);
        
        // Añadir capa de mapa con estilo personalizado
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap',
            className: 'map-tiles' // Para aplicar filtros CSS
        }).addTo(map);
        
        // Crear icono personalizado para el marcador
        var customIcon = L.divIcon({
            className: 'custom-div-icon',
            html: `
                <div class="marker-pin">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1A0046" class="w-8 h-8">
                        <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="pulse"></div>
            `,
            iconSize: [40, 40],
            iconAnchor: [20, 40]
        });
        
        // Añadir marcador con el icono personalizado
        var marker = L.marker([defaultLat, defaultLng], {
            draggable: true,
            icon: customIcon
        }).addTo(map);
        
        // Añadir círculo pulsante alrededor del marcador
        var circle = L.circle([defaultLat, defaultLng], {
            color: '#1A0046',
            fillColor: '#1A0046',
            fillOpacity: 0.2,
            radius: 100,
            className: 'pulsating-circle'
        }).addTo(map);
        
        // Función para actualizar la ubicación
        function setLocation(lat, lng) {
            // Actualizar círculo
            circle.setLatLng([lat, lng]);
            
            // Mostrar indicador de carga en el campo de ubicación
            var locationInput = document.getElementById('location');
            locationInput.value = 'Obteniendo dirección...';
            locationInput.classList.add('animate-pulse');
            
            // Obtener dirección desde las coordenadas
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}&accept-language=es`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('location').value = data.display_name || `${lat}, ${lng}`;
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                    locationInput.classList.remove('animate-pulse');
                })
                .catch(() => {
                    document.getElementById('location').value = `${lat}, ${lng}`;
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                    locationInput.classList.remove('animate-pulse');
                });
        }
        
        // Si ya tenemos coordenadas, actualizar la ubicación
        if (hasCoords) {
            setLocation(lat, lng);
        }
        
        // Eventos para actualizar la ubicación
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            setLocation(e.latlng.lat, e.latlng.lng);
        });
        
        marker.on('dragend', function(e) {
            var latlng = marker.getLatLng();
            setLocation(latlng.lat, latlng.lng);
        });
        
        // Evento para actualizar el círculo cuando se mueve el marcador
        marker.on('drag', function(e) {
            var latlng = marker.getLatLng();
            circle.setLatLng(latlng);
        });
        
        // Buscar ubicación cuando se cambia el campo de texto
        document.getElementById('location').addEventListener('blur', function() {
            var locationText = this.value.trim();
            if (locationText.length > 3) {
                // Mostrar indicador de carga
                this.classList.add('animate-pulse');
                
                // Geocodificar la dirección
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationText)}&limit=1&accept-language=es`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            var lat = parseFloat(data[0].lat);
                            var lng = parseFloat(data[0].lon);
                            
                            // Actualizar mapa y marcador
                            map.setView([lat, lng], 15);
                            marker.setLatLng([lat, lng]);
                            circle.setLatLng([lat, lng]);
                            
                            // Actualizar campos ocultos
                            document.getElementById('lat').value = lat;
                            document.getElementById('lng').value = lng;
                        }
                        this.classList.remove('animate-pulse');
                    })
                    .catch(() => {
                        this.classList.remove('animate-pulse');
                    });
            }
        });
        
        // Quitar el overlay de carga cuando el mapa esté listo
        map.whenReady(function() {
            setTimeout(function() {
                loadingOverlay.classList.add('animate__animated', 'animate__fadeOut');
                setTimeout(function() {
                    mapContainer.removeChild(loadingOverlay);
                }, 500);
            }, 800);
        });
    });
</script>
@endsection
@endsection