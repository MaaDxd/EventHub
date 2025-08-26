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
    
    .gradient-overlay {
        background: linear-gradient(45deg, rgba(26, 0, 70, 0.9) 0%, rgba(50, 0, 78, 0.9) 100%);
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
    
    .login-card {
        background: #FFFFFF;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px -5px rgba(26, 0, 70, 0.3), 0 10px 10px -5px rgba(26, 0, 70, 0.04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(50, 0, 78, 0.1);
        position: relative;
    }
    
    .login-card::before {
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
    
    .login-input {
        border: 1px solid rgba(50, 0, 78, 0.2);
        border-radius: 8px;
        padding: 12px 16px;
        transition: all 0.3s ease;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        font-weight: 500;
    }
    
    .login-input:focus {
        border-color: #1A0046;
        box-shadow: 0 0 0 3px rgba(26, 0, 70, 0.2);
        outline: none;
        transform: translateY(-1px);
    }
    
    .login-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
        border: none;
        cursor: pointer;
        width: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
    }
    
    .login-btn:hover::before {
        left: 100%;
    }
</style>

<div class="gradient-bg min-h-screen py-16 px-4 flex items-center justify-center">
    <div class="container mx-auto max-w-md relative z-10">
        <!-- Decorative elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full blur-xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white opacity-5 rounded-full blur-xl"></div>
        
        <div class="login-card p-8 animate-fadeInUp backdrop-blur-sm bg-white/95">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-[#1A0046] mb-2">Bienvenido</h2>
                <p class="text-[#32004E] opacity-70">Inicia sesión para continuar</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-[#1A0046] font-medium mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                               class="login-input pl-10">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-[#1A0046] font-medium mb-2">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required 
                               class="login-input pl-10 pr-12">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2 h-4 w-4 accent-[#1A0046]">
                    <label for="remember" class="text-[#32004E] text-sm">Recordarme</label>
                </div>
                
                <button type="submit" class="login-btn mb-4 group">
                    <span class="inline-flex items-center">
                        <span>Iniciar Sesión</span>
                        <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </button>
                
                <div class="text-center text-sm text-[#32004E] opacity-70">
                    ¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-[#1A0046] font-semibold hover:underline">Regístrate</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection