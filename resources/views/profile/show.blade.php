

@extends('layouts.app')

@section('content')
<div class="min-h-screen gradient-bg">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl font-bold text-[#2a1b4d] mb-3">Mi Perfil</h1>
                        <p class="text-lg text-gray-600">Gestiona tu información personal y configuración de cuenta</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('welcome') }}" class="bg-gradient-to-r from-[#2a1b4d] to-[#4a3b6a] hover:from-[#3a2a5d] hover:to-[#5a4b7a] text-[#f8f9fa] px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-xl hover:scale-105 flex items-center gap-3 font-semibold border border-[#4a3b6a] hover:border-[#5a4b7a]">
                            <span class="text-xl">🏠</span>
                            <span>Ir al Inicio</span>
                        </a>
                        <a href="{{ route('dashboard.user') }}" class="bg-gradient-to-r from-[#2a1b4d] to-[#4a3b6a] hover:from-[#3a2a5d] hover:to-[#5a4b7a] text-[#f8f9fa] px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-xl hover:scale-105 flex items-center gap-3 font-semibold border border-[#4a3b6a] hover:border-[#5a4b7a]">
                            <span class="text-xl">📊</span>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="bg-white border-l-4 border-black text-black px-6 py-4 rounded-xl mb-8 shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">✅</span>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Formulario de Información Personal -->
                <div class="event-card animate__animated animate__fadeInLeft">
                    <div class="event-content">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-2xl text-[#f8f9fa]">📝</span>
                            </div>
                            <h2 class="event-title text-2xl">Información Personal</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="name" class="block text-sm font-semibold text-black mb-3">Nombre Completo</label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu nombre completo"
                                       required>
                                @error('name')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="block text-sm font-semibold text-black mb-3">Correo Electrónico</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="tu@email.com"
                                       required>
                                @error('email')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <button type="submit" 
                                    class="view-all-btn w-full">
                                <span class="text-xl mr-2">💾</span>
                                <span>Actualizar Información</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Formulario de Cambio de Contraseña -->
                <div class="event-card animate__animated animate__fadeInRight">
                    <div class="event-content">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-2xl text-[#f8f9fa]">🔒</span>
                            </div>
                            <h2 class="event-title text-2xl">Cambiar Contraseña</h2>
                        </div>
                        
                        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="current_password" class="block text-sm font-semibold text-black mb-3">Contraseña Actual</label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu contraseña actual"
                                       required>
                                @error('current_password')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="block text-sm font-semibold text-black mb-3">Nueva Contraseña</label>
                                <input type="password" 
                                       id="password" 
                                       name="password"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Ingresa tu nueva contraseña"
                                       required>
                                @error('password')
                                    <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                        <span>⚠️</span>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation" class="block text-sm font-semibold text-black mb-3">Confirmar Nueva Contraseña</label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation"
                                       class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                       placeholder="Confirma tu nueva contraseña"
                                       required>
                            </div>
                            
                            <button type="submit" 
                                    class="view-all-btn w-full">
                                <span class="text-xl mr-2">🔐</span>
                                <span>Cambiar Contraseña</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Información de la cuenta -->
            <div class="event-card mt-8 animate__animated animate__fadeInUp">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl text-[#f8f9fa]">ℹ️</span>
                        </div>
                        <h2 class="event-title text-2xl">Información de la Cuenta</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <div class="event-meta">
                                <span class="text-sm font-semibold text-gray-600 mb-2">Rol en el Sistema</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">👤</span>
                                    <span class="text-xl font-bold text-black capitalize">{{ $user->role }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                            <div class="event-meta">
                                <span class="text-sm font-semibold text-gray-600 mb-2">Miembro Desde</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📅</span>
                                    <span class="text-xl font-bold text-black">{{ $user->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Picture Upload -->
            <div class="event-card mt-8 animate__animated animate__fadeInUp">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl text-[#f8f9fa]">📸</span>
                        </div>
                        <h2 class="event-title text-2xl">Foto de Perfil</h2>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                         alt="Avatar"
                                         class="w-full h-full object-cover zoomable-avatar">
                                @else
                                    <div class="w-full h-full bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full flex items-center justify-center zoomable-avatar">
                                        <span class="text-4xl text-white font-bold">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">Foto actual <span class="text-xs text-gray-400">(haz clic para hacer zoom)</span></p>
                        </div>

                        <form method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="flex-1">
                            @csrf
                            <div class="space-y-4">
                                <div class="form-group">
                                    <label for="avatar" class="block text-sm font-semibold text-black mb-3">Seleccionar nueva foto</label>
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           accept="image/*"
                                           class="form-input w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl text-black placeholder-gray-500 focus:outline-none focus:border-black transition-all duration-300"
                                           onchange="previewImage(event)">
                                    @error('avatar')
                                        <p class="text-red-600 text-sm mt-2 flex items-center gap-2 font-medium">
                                            <span>⚠️</span>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <button type="submit"
                                        class="view-all-btn w-full md:w-auto">
                                    <span class="text-xl mr-2">📤</span>
                                    <span>Subir Foto</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Profile Completion Progress -->
            <div class="event-card mt-8 animate__animated animate__fadeInUp">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl text-[#f8f9fa]">📊</span>
                        </div>
                        <h2 class="event-title text-2xl">Progreso del Perfil</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-700">Completitud del perfil</span>
                            <span id="completionPercentage" class="text-sm font-bold text-black">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div id="progressBar" class="bg-gradient-to-r from-[#1A0046] to-[#32004E] h-3 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="text-2xl mb-1">👤</div>
                                <div class="text-xs text-gray-600">Nombre</div>
                                <div id="nameCheck" class="text-sm font-semibold text-red-500">❌</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="text-2xl mb-1">📧</div>
                                <div class="text-xs text-gray-600">Email</div>
                                <div id="emailCheck" class="text-sm font-semibold text-red-500">❌</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="text-2xl mb-1">📸</div>
                                <div class="text-xs text-gray-600">Avatar</div>
                                <div id="avatarCheck" class="text-sm font-semibold text-red-500">❌</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <div class="text-2xl mb-1">🔒</div>
                                <div class="text-xs text-gray-600">Contraseña</div>
                                <div class="text-sm font-semibold text-green-500">✅</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de logout -->
            <div class="event-card mt-8">
                <div class="event-content">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#2a1b4d] to-[#4a3b6a] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-2xl text-[#f8f9fa]">🚪</span>
                        </div>
                        <div>
                            <h2 class="event-title text-2xl">Cerrar Sesión</h2>
                            <p class="event-description mt-1">Termina tu sesión actual de forma segura</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="flex flex-col sm:flex-row gap-6 items-center">
                        @csrf
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 flex-grow">
                            <p class="event-description text-sm">
                                Al cerrar sesión, serás redirigido a la página de inicio. Asegúrate de haber guardado todos tus cambios.
                            </p>
                        </div>
                        <button type="submit" 
                                class="view-all-btn whitespace-nowrap"
                                onclick="return confirm('¿Estás seguro de que quieres cerrar sesión?')">
                            <span class="text-xl mr-2">🔓</span>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile Completion Calculation
        function calculateProfileCompletion() {
            let completed = 0;
            const total = 4;

            // Check name
            const name = '{{ $user->name }}';
            if (name && name.trim() !== '') {
                completed++;
                document.getElementById('nameCheck').textContent = '✅';
                document.getElementById('nameCheck').className = 'text-sm font-semibold text-green-500';
            }

            // Check email
            const email = '{{ $user->email }}';
            if (email && email.trim() !== '') {
                completed++;
                document.getElementById('emailCheck').textContent = '✅';
                document.getElementById('emailCheck').className = 'text-sm font-semibold text-green-500';
            }

            // Check avatar
            const avatar = '{{ $user->avatar }}';
            if (avatar && avatar.trim() !== '') {
                completed++;
                document.getElementById('avatarCheck').textContent = '✅';
                document.getElementById('avatarCheck').className = 'text-sm font-semibold text-green-500';
            }

            // Password is always completed
            const percentage = Math.round((completed / total) * 100);
            document.getElementById('completionPercentage').textContent = percentage + '%';
            document.getElementById('progressBar').style.width = percentage + '%';
        }

        calculateProfileCompletion();

        // Image Preview Function
        window.previewImage = function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You could add a preview here if needed
                    console.log('Image selected:', file.name);
                };
                reader.readAsDataURL(file);
            }
        };

        // Zoom Modal Functionality
        const zoomModal = document.getElementById('zoomModal');
        const zoomImage = document.getElementById('zoomImage');
        const closeZoom = document.getElementById('closeZoom');
        let scale = 1;
        let isDragging = false;
        let startX, startY, initialX, initialY;
        let translateX = 0;
        let translateY = 0;

        // Open zoom modal when clicking on profile picture
        document.querySelectorAll('.zoomable-avatar').forEach(element => {
            element.addEventListener('click', function() {
                // Handle both img elements and div elements
                let imgSrc = '';
                if (element.tagName === 'IMG') {
                    imgSrc = element.src;
                } else {
                    // For div with initial, create a data URL with the initial
                    const initial = element.textContent.trim();
                    const canvas = document.createElement('canvas');
                    canvas.width = 200;
                    canvas.height = 200;
                    const ctx = canvas.getContext('2d');

                    // Create gradient background
                    const gradient = ctx.createLinearGradient(0, 0, 200, 200);
                    gradient.addColorStop(0, '#1A0046');
                    gradient.addColorStop(1, '#32004E');
                    ctx.fillStyle = gradient;
                    ctx.fillRect(0, 0, 200, 200);

                    // Add text
                    ctx.fillStyle = 'white';
                    ctx.font = 'bold 80px Arial';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText(initial, 100, 100);

                    imgSrc = canvas.toDataURL();
                }

                zoomImage.src = imgSrc;
                zoomModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                resetZoom();
            });
        });

        // Close zoom modal
        closeZoom.addEventListener('click', closeModal);
        zoomModal.addEventListener('click', function(e) {
            if (e.target === zoomModal) {
                closeModal();
            }
        });

        function closeModal() {
            zoomModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetZoom();
        }

        function resetZoom() {
            scale = 1;
            translateX = 0;
            translateY = 0;
            zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            zoomImage.style.cursor = 'zoom-in';
        }

        // Zoom functionality
        zoomImage.addEventListener('click', function(e) {
            if (isDragging) return;
            if (scale === 1) {
                scale = 2;
                zoomImage.style.cursor = 'grab';
            } else {
                scale = 1;
                translateX = 0;
                translateY = 0;
                zoomImage.style.cursor = 'zoom-in';
            }
            zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
        });

        // Mouse wheel zoom
        zoomImage.addEventListener('wheel', function(e) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? -0.1 : 0.1;
            scale = Math.max(0.5, Math.min(3, scale + delta));
            if (scale === 1) {
                translateX = 0;
                translateY = 0;
            }
            zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            zoomImage.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
        });

        // Keyboard controls
        document.addEventListener('keydown', function(e) {
            if (!zoomModal.classList.contains('hidden')) {
                if (e.key === 'Escape') {
                    closeModal();
                } else if (e.key === '+' || e.key === '=') {
                    scale = Math.min(3, scale + 0.2);
                    if (scale === 1) {
                        translateX = 0;
                        translateY = 0;
                    }
                    zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
                    zoomImage.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
                } else if (e.key === '-') {
                    scale = Math.max(0.5, scale - 0.2);
                    if (scale === 1) {
                        translateX = 0;
                        translateY = 0;
                    }
                    zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
                    zoomImage.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
                } else if (e.key === '0') {
                    resetZoom();
                }
            }
        });

        // Drag functionality
        zoomImage.addEventListener('mousedown', function(e) {
            if (scale <= 1) return;
            e.preventDefault();
            isDragging = true;
            initialX = translateX;
            initialY = translateY;
            startX = e.clientX;
            startY = e.clientY;
            zoomImage.style.cursor = 'grabbing';
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            translateX = initialX + (e.clientX - startX);
            translateY = initialY + (e.clientY - startY);
            zoomImage.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
        });

        document.addEventListener('mouseup', function() {
            if (isDragging) {
                isDragging = false;
                zoomImage.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
            }
        });

        document.addEventListener('mouseleave', function() {
            if (isDragging) {
                isDragging = false;
                zoomImage.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
            }
        });
    });
</script>

<style>
    /* Gradientes corporativos - ACTUALIZADOS CON NUEVA PALETA */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }
    
    /* Event cards - Aplicando el estilo profesional con nueva paleta */
    .event-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.2), 0 10px 10px -5px rgba(26, 0, 70, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.15);
    }
    
    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -12px rgba(26, 0, 70, 0.25), 0 10px 10px -5px rgba(26, 0, 70, 0.08);
    }
    
    .event-content {
        padding: 32px;
    }
    
    .event-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1A0046;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .event-description {
        color: #32004E;
        opacity: 0.8;
        margin-bottom: 16px;
        line-height: 1.6;
    }
    
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }
    
    .event-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #32004E;
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    .view-all-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.25);
        border: none;
        cursor: pointer;
    }
    
    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.35);
        color: #FFFFFF;
    }

    /* Form inputs styling - ACTUALIZADOS */
    .form-input {
        box-shadow: 0 2px 8px rgba(26, 0, 70, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .form-input:focus {
        box-shadow: 0 4px 16px rgba(26, 0, 70, 0.2);
        transform: translateY(-1px);
    }

    .form-group {
        position: relative;
    }

    .form-group label {
        color: #1A0046;
        font-weight: 600;
    }

    /* Zoom Modal Styles - ACTUALIZADOS */
    .zoom-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(5px);
    }

    .hidden {
        display: none !important;
    }

    .zoom-modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .zoom-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
        cursor: zoom-in;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    }

    .zoom-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: rgba(255, 255, 255, 0.2);
        color: #FFFFFF;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .zoom-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .zoom-instructions {
        position: absolute;
        bottom: -60px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        text-align: center;
        background: rgba(0, 0, 0, 0.5);
        padding: 8px 16px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    /* Zoomable avatar hover effect - ACTUALIZADO */
    .zoomable-avatar {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .zoomable-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }

    /* Animation keyframes */
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

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Apply animations with delay for staggered effect */
    .animate__fadeInUp {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate__fadeInLeft {
        animation: fadeInLeft 0.6s ease-out;
    }

    .animate__fadeInRight {
        animation: fadeInRight 0.6s ease-out;
    }

    /* Clases adicionales para usar la nueva paleta de marca */
    .brand-primary {
        color: #1A0046;
    }

    .brand-secondary {
        color: #32004E;
    }

    .brand-white {
        color: #FFFFFF;
    }

    .brand-black {
        color: #000000;
    }

    .brand-gradient {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
    }

    .brand-gradient-text {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

@include('layouts.footer')

<!-- Zoom Modal -->
<div id="zoomModal" class="zoom-modal hidden">
    <div class="zoom-modal-content">
        <button id="closeZoom" class="zoom-close">&times;</button>
        <img id="zoomImage" class="zoom-image" src="" alt="Zoomed Avatar">
        <div class="zoom-instructions">
            Haz clic para hacer zoom • Usa la rueda del mouse • Presiona ESC para cerrar<br>
            <small>Teclas: + para zoom in, - para zoom out, 0 para reset</small>
        </div>
    </div>
</div>

@endsection
