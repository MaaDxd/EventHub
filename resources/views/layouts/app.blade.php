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
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="text-xl font-bold">EventHub</a>
                <nav>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="mr-4">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </nav>
            </div>
        </header>
        <main class="flex-grow container mx-auto p-4">
            @yield('content')
        </main>
        <footer class="bg-white shadow p-4 text-center text-sm text-gray-600">
            &copy; 2024 EventHub
        </footer>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @yield('scripts')
</body>
</html>