<footer class="bg-gradient-to-br from-[#1A0046] to-[#32004E] py-10 border-t-2 border-white/10 shadow-2xl mt-10">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <div class="flex flex-col items-center md:items-start">
                <a href="#" class="font-extrabold text-3xl tracking-wide flex items-center mb-2 drop-shadow-lg">
                    <i class="bi bi-lightning-charge-fill mr-3 text-yellow-400 animate-pulse"></i>EventHub
                </a>
                <p class="mb-0 text-base text-white/80">&copy; {{ date('Y') }} EventHub. Todos los derechos reservados.</p>
            </div>
            <ul class="flex flex-wrap justify-center md:justify-end gap-6 mt-4 md:mt-0">
                <li>
                    <a href="{{ route('welcome') }}" class="flex items-center bg-white/10 hover:bg-white/30 hover:text-[#1A0046] font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg backdrop-blur-md">
                        <i class="bi bi-house-door-fill mr-2"></i>Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="flex items-center bg-white/10 hover:bg-white/30 hover:text-[#1A0046] font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg backdrop-blur-md">
                        <i class="bi bi-envelope-fill mr-2"></i>Contacto
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
