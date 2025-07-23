<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Instrument Sans:400,500,600&display=swap" rel="stylesheet"/>


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @filamentScripts
    <!-- Scripts -->
    @vite(['resources/css/app.css',  'resources/js/app.js'])


</head>
<body class="min-h-screen bg-base flex flex-col font-sans antialiased">

<header>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}"
           class="text-2xl font-bold tracking-tight text-on-surface-strong dark:text-on-surface-dark-strong">
            {{ config('app.name', 'Laravel') }}
        </a>

        <nav>
            @auth
                <div class="flex items-center gap-4">
                    <div class="text-gray-700 dark:text-gray-300">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="hover:text-violet-600 dark:hover:text-violet-400">
                                    {{ Auth::user()->name }}
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('filament.admin.pages.dashboard')">
                                    {{ __('Admin') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="text-sm font-medium text-violet-600 dark:text-violet-400 hover:underline">
                                            Logout
                                        </button>
                                    </form>
                                </x-dropdown-link>

                            </x-slot>
                        </x-dropdown>
                    </div>
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

@livewire('notifications')

<footer class="bg-secondary border-t border-secondary py-8">
    <div class="max-w-6xl mx-auto px-6 text-center text-sm">
        <p class="mb-2">
            &copy; {{ date('Y') }} <span class="font-semibold">Laravel Forum</span>.
            All rights reserved.
        </p>
    </div>
</footer>
</body>
</html>
