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
    </style>
</head>
<body class="bg-gradient-to-br from-[#1A0046] to-[#32004E] min-h-screen text-black font-poppins">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-lg p-4 sticky top-0 z-30 backdrop-blur-md border-b border-[#E5E5E5]">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-[#1A0046] tracking-tight">EventHub</a>
                <nav class="flex items-center space-x-4">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-[#32004E] hover:text-[#1A0046] font-semibold transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#1A0046] hover:text-[#32004E] font-semibold transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-[#1A0046] to-[#32004E] hover:from-[#32004E] hover:to-[#1A0046] font-semibold px-4 py-2 rounded-lg shadow transition-colors">Register</a>
                    @endauth
                </nav>
            </div>
        </header>
        <main class="flex-grow container mx-auto p-4 text-black bg-white bg-opacity-80 rounded-xl mt-6 shadow-lg">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @yield('scripts')
</body>
</html>