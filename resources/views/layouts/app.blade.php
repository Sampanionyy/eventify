<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eventify')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-2xl">Eventify</a>
            
            <!-- Menu toggle button -->
            <div class="lg:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation links -->
            <div id="menu" class="hidden lg:flex space-x-4">
                <a href="/" class="text-white hover:text-gray-300">Accueil</a>
                <a href="{{ route('events.index') }}" class="text-white hover:text-gray-300 no-underline">Événements</a>
                <a href="{{ route('reservations.index') }}" class="text-white hover:text-gray-300">Réservations</a>
                <a href="{{ route('categories.index') }}" class="text-white hover:text-gray-300">Catégories</a>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-gray-800 text-white space-y-2 pt-4 pb-2 hidden">
        <a href="/" class="block px-4 py-2 hover:bg-gray-700">Accueil</a>
        <a href="{{ route('events.index') }}" class="block px-4 py-2 hover:bg-gray-700">Événements</a>
        <a href="{{ route('reservations.index') }}" class="block px-4 py-2 hover:bg-gray-700">Réservations</a>
        <a href="{{ route('categories.index') }}" class="block px-4 py-2 hover:bg-gray-700">Catégories</a>
    </div>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
