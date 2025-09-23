<footer class="bg-gradient-to-br from-gray-100 to-gray-200 py-10 border-t-2 border-gray-300 shadow-2xl mt-32">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="flex flex-col items-center md:items-start">
                <a href="#" class="font-extrabold text-3xl tracking-wide flex items-center mb-2 drop-shadow-lg text-gray-800">
                    <i class="bi bi-lightning-charge-fill mr-3 text-yellow-500 animate-pulse"></i>EventHub
                </a>
                <p class="mb-0 text-base text-gray-600">&copy; {{ date('Y') }} EventHub. Todos los derechos reservados.</p>
            </div>
            <ul class="flex flex-wrap justify-center md:justify-end gap-6 mt-4 md:mt-0">
                <li>
                    <a href="{{ route('welcome') }}" class="flex items-center bg-gray-300/50 hover:bg-gray-400/70 text-gray-700 hover:text-gray-900 font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg">
                        <i class="bi bi-house-door-fill mr-2"></i>Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('help.index') }}" class="flex items-center bg-gray-300/50 hover:bg-gray-400/70 text-gray-700 hover:text-gray-900 font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>Ayuda
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="flex items-center bg-gray-300/50 hover:bg-gray-400/70 text-gray-700 hover:text-gray-900 font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg">
                        <i class="bi bi-envelope-fill mr-2"></i>Contacto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
