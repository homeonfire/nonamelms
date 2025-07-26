<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Админ-панель</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
{{-- ИСПОЛЬЗУЕМ НАШИ КАСТОМНЫЕ ЦВЕТА --}}
<div class="flex h-screen bg-custom-background-dark">
    <aside class="w-64 flex-shrink-0 bg-custom-container-dark text-custom-text-primary-dark flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-custom-border-dark">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">АДМИН-ПАНЕЛЬ</a>
        </div>
        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Главная</span>
            </a>
            <a href="{{ route('admin.courses.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.courses.index') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Курсы</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.users.index') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Пользователи</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Категории</span>
            </a>
            <a href="{{ route('admin.pages.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.pages.*') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Страницы</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.settings.index') ? 'bg-indigo-600' : '' }}">
                <span class="ml-3">Управление LMS</span>
            </a>
        </nav>
        <div class="p-4 border-t border-custom-border-dark">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark">
                <span>Вернуться на сайт</span>
            </a>
        </div>
    </aside>

    {{-- Основной контент (убрали обертку и header) --}}
    <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 lg:p-10">
        {{ $slot }}
    </main>
</div>
</body>
</html>
