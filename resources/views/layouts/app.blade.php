<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 antialiased">

    <nav class="bg-blue-600 shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-white hover:text-blue-300 transition">
                Webinar Event
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a href="#home"
                    class="text-white hover:text-blue-300 transition-all duration-300 ease-in-out transform hover:scale-105">Home</a>
                <a href="#seminar"
                    class="text-white hover:text-blue-300 transition-all duration-300 ease-in-out transform hover:scale-105">Seminars</a>
                <a href="#event"
                    class="text-white hover:text-blue-300 transition-all duration-300 ease-in-out transform hover:scale-105">Event</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex space-x-4">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-blue-600 bg-white hover:bg-gray-100 py-2 px-4 rounded-lg shadow-sm transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-500 text-white hover:bg-blue-700 py-2 px-4 rounded-lg transition">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden flex items-center text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Links -->
        <div class="md:hidden bg-blue-500 text-white px-6 py-4 space-y-2">
            <a href="#home" class="block text-lg hover:text-blue-300 transition">Home</a>
            <a href="#seminars" class="block text-lg hover:text-blue-300 transition">Seminars</a>
            <a href="#about" class="block text-lg hover:text-blue-300 transition">About</a>
            <a href="#contact" class="block text-lg hover:text-blue-300 transition">Contact</a>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left text-lg bg-blue-700 py-2 px-4 rounded hover:bg-blue-800 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block text-lg bg-white text-blue-600 border border-blue-600 py-2 px-4 rounded hover:bg-gray-100 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block text-lg bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Register
                </a>
            @endauth
        </div>
    </nav>


    <!-- Page Content -->
    <main class="py-0">
        <div class="w-full px-0">
            @yield('content')
        </div>
    </main>

    <footer class="bg-blue-600 py-6">
        <div class="container mx-auto flex flex-col items-center md:flex-row justify-between px-6">
            <!-- Footer Logo (optional) -->
            <div class="text-white text-2xl font-bold mb-4 md:mb-0">
                Webinar Event
            </div>

            <!-- Footer Links -->
            <div class="flex space-x-6">
                <a href="#home" class="text-gray-300 hover:text-white transition">Home</a>
                <a href="#seminars" class="text-gray-300 hover:text-white transition">Seminars</a>
                <a href="#about" class="text-gray-300 hover:text-white transition">About</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition">Contact</a>
            </div>
        </div>

        <!-- Footer Bottom Text (Optional) -->
        <div class="text-center text-gray-400 mt-6">
            <p>&copy; 2024 Webinar Event. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>
