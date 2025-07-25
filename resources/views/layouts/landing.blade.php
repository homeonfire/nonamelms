<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'NoName LMS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-custom-background-light dark:bg-custom-background-dark">
{{-- Шапка сайта --}}
<header class="p-4">
    <nav class="container mx-auto flex justify-between items-center">
        <a href="{{ route('landing') }}" class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">
            NoName LMS
        </a>
        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Demo</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Войти</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Регистрация</a>
                @endif
            @endauth
        </div>
    </nav>
</header>

{{-- Основной контент страницы --}}
<main>
    {{ $slot }}
</main>

{{-- Футер --}}
<footer class="p-4 mt-16 text-center text-custom-text-secondary-light dark:text-custom-text-secondary-dark">
    © {{ date('Y') }} NoName LMS. Все права защищены.
</footer>
</body>
</html>
