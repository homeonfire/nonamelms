<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $appName }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-custom-background-light dark:bg-custom-background-dark">

    @include('layouts.navigation')

    {{-- ШАПКА ДЛЯ МОБИЛЬНЫХ УСТРОЙСТВ --}}
    <header class="p-4 border-b border-custom-border-light dark:border-custom-border-dark flex items-center justify-between lg:hidden">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ config('app.name', 'Laravel') }}</a>
        {{-- Кнопка "бургер" для открытия меню --}}
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
            <span class="sr-only">Открыть меню</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w.org/2000/svg"><path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path></svg>
        </button>
    </header>

    <main class="p-6 lg:p-10 lg:ml-64">
        {{ $slot }}
    </main>

</div>
</body>
</html>
