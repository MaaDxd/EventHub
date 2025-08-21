@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Editar Evento</h2>
                <p class="text-gray-600">Modifica la información de tu evento</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Título del Evento *
                    </label>
                    <input id="title" name="title" type="text" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('title') border-red-500 @enderror"
                           value="{{ old('title', $event->title) }}" placeholder="Ej: Concierto de Rock en Vivo">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción *
                    </label>
                    <textarea id="description" name="description" rows="4" required 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('description') border-red-500 @enderror"
                              placeholder="Describe tu evento, qué incluye, qué esperar...">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date and Time -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha *
                        </label>
                        <input id="date" name="date" type="date" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('date') border-red-500 @enderror"
                               value="{{ old('date', $event->date->format('Y-m-d')) }}">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 mb-2">
                            Hora *
                        </label>
                        <input id="time" name="time" type="time" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('time') border-red-500 @enderror"
                               value="{{ old('time', $event->time) }}">
                        @error('time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Ubicación *
                    </label>
                    <input id="location" name="location" type="text" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('location') border-red-500 @enderror"
                           value="{{ old('location', $event->location) }}" placeholder="Ej: Estadio Nacional, Calle Principal 123">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Categoría *
                    </label>
                    <div class="relative">
                        <select id="category_id" name="category_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors bg-white shadow-sm appearance-none @error('category_id') border-red-500 @enderror">
                            <option value="" disabled>Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_type ? null : $event->category_id) == $category->id ? 'selected' : '' }}>
                                    🗂 {{ $category->name }}
                                </option>
                            @endforeach
                            @if($event->category_type)
                                <option value="{{ $event->category_type }}" {{ old('category_id', $event->category_type) == $event->category_type ? 'selected' : '' }}>
                                    🗂 {{ ucfirst($event->category_type) }}
                                </option>
                            @endif
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($event->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen Actual
                    </label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-32 h-32 object-cover rounded-lg">
                        <div>
                            <p class="text-sm text-gray-600">Imagen actual del evento</p>
                            <p class="text-xs text-gray-500">Sube una nueva imagen para reemplazarla</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $event->image ? 'Nueva Imagen del Evento' : 'Imagen del Evento' }}
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-purple-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                    <span>Subir una imagen</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('dashboard.creator') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                        Actualizar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview image functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'mx-auto h-12 w-12 object-cover rounded';
                
                const container = document.querySelector('.space-y-1');
                const existingPreview = container.querySelector('img');
                if (existingPreview) {
                    existingPreview.remove();
                }
                container.insertBefore(preview, container.firstChild);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
