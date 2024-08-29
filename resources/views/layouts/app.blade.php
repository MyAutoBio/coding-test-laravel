<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vite Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div id="app">
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                    <a class="text-lg font-bold" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div class="block lg:hidden">
                        <button id="navbarToggle" class="focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="hidden lg:flex lg:items-center space-x-4">
                        <ul class="flex space-x-4">
                            <!-- Left Side Of Navbar -->
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="flex items-center space-x-4">
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-800" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="text-gray-600 hover:text-gray-800" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="relative group">
                                    <a class="text-gray-600 hover:text-gray-800" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="absolute right-0 z-20 hidden mt-2 w-48 bg-white rounded-md shadow-lg group-hover:block">
                                        <a class="block px-4 py-2 text-gray-800 hover:bg-gray-100" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        // Toggle mobile menu
        document.getElementById('navbarToggle').addEventListener('click', function () {
            const menu = document.querySelector('.lg\\:hidden');
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });
    </script>
</body>
</html>
