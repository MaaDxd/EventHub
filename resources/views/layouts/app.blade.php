<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventHub</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .swiper-container {
            overflow: hidden;
            touch-action: pan-y;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            min-width: 250px;
            z-index: 50;
            margin-top: 0.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dropdown-menu.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.875rem 1.25rem;
            text-align: left;
            border: none;
            background: none;
            color: #374151;
            transition: all 0.2s ease;
            font-weight: 500;
            border-radius: 0.5rem;
            margin: 0.125rem 0.5rem;
        }
        .dropdown-item:hover {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            transform: translateX(4px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dropdown-divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 0.5rem 0;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#1A0046] to-[#32004E] min-h-screen text-black font-poppins">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-lg p-4 sticky top-0 z-30 backdrop-blur-md border-b border-[#E5E5E5]">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-[#1A0046] tracking-tight">EventHub</a>
                <nav class="flex items-center space-x-4">
                    @auth
                        <!-- User Dropdown Menu -->
                        <div class="relative">
                            <button id="userDropdownBtn" class="relative flex items-center justify-center w-12 h-12 bg-white border-2 border-gray-300 rounded-lg hover:border-[#1A0046] hover:bg-gray-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1A0046] focus:ring-opacity-50 shadow-sm hover:shadow-md">
                                <!-- Icono de casa minimalista -->
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <!-- Indicador de menú desplegable -->
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-[#1A0046] rounded-full border-2 border-white"></div>
                            </button>
                            
                            <div id="userDropdown" class="dropdown-menu">
                                <!-- User Info -->
                                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50 rounded-t-xl">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                            <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                                            <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-gradient-to-r from-[#1A0046] to-[#32004E] rounded-full mt-1">
                                                {{ ucfirst(auth()->user()->role) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dashboard Links -->
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <span class="mr-2">🏠</span> Dashboard
                                </a>
                                
                                @if(auth()->user()->role === 'user')
                                    <a href="{{ route('dashboard.user') }}" class="dropdown-item">
                                        <span class="mr-2">👤</span> Mi Panel
                                    </a>
                                @elseif(auth()->user()->role === 'admin')
                                    <a href="{{ route('dashboard.admin') }}" class="dropdown-item">
                                        <span class="mr-2">⚙️</span> Panel Admin
                                    </a>
                                @elseif(auth()->user()->role === 'creator')
                                    <a href="{{ route('dashboard.creator') }}" class="dropdown-item">
                                        <span class="mr-2">🎨</span> Panel Creador
                                    </a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                
                                <!-- Profile & Settings -->
                                <a href="{{ route('profile.show') }}" class="dropdown-item">
                                    <span class="mr-2">👤</span> Mi Perfil
                                </a>
                                
                                <a href="{{ route('welcome') }}" class="dropdown-item">
                                    <span class="mr-2">🏠</span> Ir al Inicio
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                
                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-red-600 hover:bg-red-50 w-full text-left hover:text-red-700">
                                        <span class="mr-2">🚪</span> Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-[#1A0046] hover:text-[#32004E] font-semibold transition-colors">Login</a>
                        <!-- Register Dropdown Menu -->
                        <div class="relative">
                            <button id="registerDropdownBtn" class="flex items-center space-x-2 bg-gradient-to-r from-[#1A0046] to-[#32004E] hover:from-[#32004E] hover:to-[#1A0046] font-semibold px-4 py-2 rounded-lg shadow transition-all duration-200 focus:outline-none">
                                <span>Register</span>
                                <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div id="registerDropdown" class="dropdown-menu">
                                <a href="{{ route('register.user') }}" class="dropdown-item">
                                    <span class="mr-2">👤</span> Registrarse como Usuario
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('register.creator') }}" class="dropdown-item">
                                    <span class="mr-2">🎨</span> Registrarse como Creador
                                </a>
                            </div>
                        </div>
                    @endauth
                </nav>
            </div>
        </header>
        <main class="flex-grow container mx-auto p-4 text-black bg-white bg-opacity-80 rounded-xl mt-6 shadow-lg">
            @yield('content')
        </main>
    </div>
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <!-- Dropdown JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // User dropdown
            const userDropdownBtn = document.getElementById('userDropdownBtn');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userDropdownBtn && userDropdown) {
                userDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                });
            }
            
            // Register dropdown
            const registerDropdownBtn = document.getElementById('registerDropdownBtn');
            const registerDropdown = document.getElementById('registerDropdown');
            
            if (registerDropdownBtn && registerDropdown) {
                registerDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    registerDropdown.classList.toggle('show');
                });
            }
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (userDropdown && !userDropdownBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('show');
                }
                if (registerDropdown && !registerDropdownBtn.contains(e.target) && !registerDropdown.contains(e.target)) {
                    registerDropdown.classList.remove('show');
                }
            });
            
            // Close dropdowns on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (userDropdown) userDropdown.classList.remove('show');
                    if (registerDropdown) registerDropdown.classList.remove('show');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>

</html>