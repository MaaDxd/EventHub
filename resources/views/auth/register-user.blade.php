@extends('layouts.app')

@section('content')
<style>
    /* Gradients y fondos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
        position: relative;
        overflow: hidden;
    }
    
    .gradient-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        z-index: 0;
    }
    
    /* Animaciones */
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
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .animate-fadeInDown {
        animation: fadeInDown 0.6s ease-out forwards;
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 0.5;
        }
        50% {
            opacity: 0.1;
        }
    }
    
    /* Tarjeta de registro */
    .register-card {
        background: #FFFFFF;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
        position: relative;
    }
    
    .register-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        z-index: 0;
        pointer-events: none;
    }
    
    /* Campos de entrada */
    .register-input {
        border: 1px solid rgba(50, 0, 78, 0.2);
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        font-weight: 500;
    }
    
    .register-input:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.2);
        outline: none;
        transform: translateY(-1px);
    }
    
    /* Botón de registro */
    .register-btn {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border-radius: 0.75rem;
        padding: 0.75rem 1.5rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(26, 0, 70, 0.2);
        border: none;
        cursor: pointer;
        width: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .register-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
    }
    
    .register-btn:hover::before {
        left: 100%;
    }
</style>

<div class="gradient-bg min-h-screen py-16 px-4 flex items-center justify-center">
    <div class="container mx-auto max-w-md relative z-10">
        <!-- Elementos decorativos -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white opacity-5 rounded-full blur-xl"></div>
        
        <div class="register-card p-8 animate-fadeInUp backdrop-blur-sm bg-white/95">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-[#1A0046] mb-2">Registro de Usuario</h2>
                <p class="text-gray-600">Crea tu cuenta para acceder a eventos</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register.user') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-[#1A0046] font-medium mb-2">Nombre completo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="name" name="name" type="text" required 
                               class="register-input pl-10" value="{{ old('name') }}" placeholder="Ingresa tu nombre completo">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-[#1A0046] font-medium mb-2">Correo electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" required 
                               class="register-input pl-10" value="{{ old('email') }}" placeholder="ejemplo@correo.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Confirmation -->
                <div class="mb-6">
                    <label for="email_confirmation" class="block text-[#1A0046] font-medium mb-2">Confirmar correo electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input id="email_confirmation" name="email_confirmation" type="email" required 
                               class="register-input pl-10" value="{{ old('email_confirmation') }}" placeholder="ejemplo@correo.com">
                    </div>
                    @error('email_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-[#1A0046] font-medium mb-2">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required
                               class="register-input pl-10 pr-12" placeholder="Mínimo 8 caracteres">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Confirmation -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-[#1A0046] font-medium mb-2">Confirmar Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="register-input pl-10 pr-12" placeholder="Repite tu contraseña">
                    </div>
                </div>

                <!-- Security Questions Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-[#1A0046] mb-4">Preguntas de Seguridad</h3>
                    <p class="text-sm text-gray-600 mb-4">Estas preguntas te ayudarán a recuperar tu contraseña si la olvidas.</p>
                    
                    <!-- First Security Question -->
                    <div class="mb-4">
                        <label for="security_question_1" class="block text-[#1A0046] font-medium mb-2">Pregunta de seguridad 1</label>
                        <select id="security_question_1" name="security_question_1" required class="register-input">
                            <option value="">Selecciona una pregunta</option>
                            @foreach(\App\Helpers\SecurityQuestions::getQuestions() as $question)
                                <option value="{{ $question }}" {{ old('security_question_1') == $question ? 'selected' : '' }}>{{ $question }}</option>
                            @endforeach
                        </select>
                        @error('security_question_1')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="security_answer_1" class="block text-[#1A0046] font-medium mb-2">Respuesta 1</label>
                        <input id="security_answer_1" type="text" name="security_answer_1" required 
                               class="register-input" value="{{ old('security_answer_1') }}" placeholder="Tu respuesta">
                        @error('security_answer_1')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Second Security Question -->
                    <div class="mb-4">
                        <label for="security_question_2" class="block text-[#1A0046] font-medium mb-2">Pregunta de seguridad 2</label>
                        <select id="security_question_2" name="security_question_2" required class="register-input">
                            <option value="">Selecciona una pregunta</option>
                            @foreach(\App\Helpers\SecurityQuestions::getQuestions() as $question)
                                <option value="{{ $question }}" {{ old('security_question_2') == $question ? 'selected' : '' }}>{{ $question }}</option>
                            @endforeach
                        </select>
                        @error('security_question_2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="security_answer_2" class="block text-[#1A0046] font-medium mb-2">Respuesta 2</label>
                        <input id="security_answer_2" type="text" name="security_answer_2" required 
                               class="register-input" value="{{ old('security_answer_2') }}" placeholder="Tu respuesta">
                        @error('security_answer_2')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="register-btn mb-4 group">
                    <span class="inline-flex items-center">
                        <span>Registrarse</span>
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </button>
                
                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-gray-600">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-medium">Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
