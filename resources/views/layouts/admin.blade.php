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
<div class="flex h-screen bg-custom-background-dark">
    <aside class="w-64 flex-shrink-0 bg-custom-container-dark text-custom-text-primary-dark flex flex-col">
        {{-- Логотип/Название --}}
        <div class="h-16 flex items-center justify-center border-b border-custom-border-dark">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">АДМИН-ПАНЕЛЬ</a>
        </div>

        {{-- Основная навигация с категориями --}}
        <nav class="flex-grow p-4 space-y-4">
            {{-- Главная --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.dashboard') ? 'bg-custom-accent text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Главная</span>
            </a>

            {{-- Категория: Управление контентом --}}
            <div>
                <span class="px-3 text-xs font-semibold text-gray-500 uppercase">Контент</span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.courses.*') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-8.994v6.494m18-6.494v6.494M4 6.253L12 2l8 4.253M4 18.747L12 14.5l8 4.247M12 2v4.253"></path></svg>
                        <span>Курсы</span>
                    </a>
                    <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.posts.*') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span>Блог</span>
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.pages.*') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        <span>Страницы</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.categories.*') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v5a2 2 0 002 2h.01"></path></svg>
                        <span>Категории</span>
                    </a>
                </div>
            </div>

            {{-- Категория: Пользователи --}}
            <div>
                <span class="px-3 text-xs font-semibold text-gray-500 uppercase">Пользователи</span>
                <div class="mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.users.*') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.995 5.995 0 0112 12.75a5.995 5.995 0 01-3 5.197M15 21a6 6 0 00-9-5.197"></path></svg>
                        <span>Все пользователи</span>
                    </a>
                    <a href="{{ route('admin.visits.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.visits.index') ? 'bg-custom-accent text-white' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Посещения</span>
                    </a>
                </div>
            </div>

            <div>
                <span class="px-3 text-xs font-semibold text-gray-500 uppercase">Заказы</span>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.orders.index') ? 'bg-indigo-600' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    <span class="ml-3">Заказы</span>
                </a>
            </div>

        </nav>
        {{-- Футер сайдбара --}}
        <div class="p-4 border-t border-custom-border-dark space-y-2">
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark {{ request()->routeIs('admin.settings.index') ? 'bg-custom-accent text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Управление LMS</span>
            </a>
            <a href="{{ route('admin.payment.settings') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100 ...">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Платежи</span>
            </a>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-custom-text-secondary-dark hover:bg-custom-border-dark">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                <span>Вернуться на сайт</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 overflow-x-hidden bg-white overflow-y-auto p-6 lg:p-10">
        {{ $slot }}
    </main>
</div>
</body>
</html>
