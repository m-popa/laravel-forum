<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @filamentStyles
    @filamentScripts
    @vite(['resources/css/app.css',  'resources/js/app.js'])

</head>
<body class="min-h-screen flex flex-col font-sans antialiased bg-primary-50 dark:bg-gray-900 dark">

<header class="bg-white/90 dark:bg-gray-950/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}"
           class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-violet-600 dark:hover:text-violet-400 transition">
            Laravel Forum
        </a>

        <nav>
            @auth
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-700 dark:text-gray-300">
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm font-medium text-violet-600 dark:text-violet-400 hover:underline">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('login') }}"
                       class="text-gray-700 dark:text-gray-300 hover:text-violet-600 dark:hover:text-violet-400 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-violet-600 dark:text-violet-400 font-medium hover:underline">
                        Register
                    </a>
                </div>
            @endauth
        </nav>
    </div>
</header>
<div class="flex-grow">
    <main>
        {{ $slot }}
    </main>
</div>

<footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-8">
    <div class="max-w-6xl mx-auto px-6 text-center text-sm text-gray-500 dark:text-gray-400">
        <p class="mb-2">
            &copy; {{ date('Y') }} <span class="font-semibold text-violet-600 dark:text-violet-400">Laravel Forum</span>.
            All rights reserved.
        </p>
    </div>
</footer>
</body>
</html>
