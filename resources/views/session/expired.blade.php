@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

<style>
    /* Gradientes corporativos */
    .gradient-bg {
        background: linear-gradient(135deg, #1A0046 0%, #32004E 100%);
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

    .expired-message {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 25px rgba(26, 0, 70, 0.3);
    }

    .login-btn {
        background: linear-gradient(135deg, #1A0046, #32004E);
        color: #FFFFFF;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(26, 0, 70, 0.3);
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(26, 0, 70, 0.4);
        color: #FFFFFF;
    }
</style>

<!-- Session Expired Section -->
<div class="gradient-bg min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 relative z-10">
        <div class="expired-message animate-fadeInDown">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6">
                Sesión Expirada
            </h1>
            <p class="text-xl md:text-2xl text-white opacity-90 mb-12 max-w-2xl mx-auto leading-relaxed">
                Tu sesión ha expirado por inactividad. Por favor, inicia sesión nuevamente para continuar.
            </p>
            <div class="animate-fadeInUp">
                <a href="{{ route('login') }}" class="login-btn">
                    Iniciar Sesión
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Decorative elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full blur-xl"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white opacity-5 rounded-full blur-xl"></div>
</div>

@include('layouts.footer')
@endsection
