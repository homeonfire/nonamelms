<aside class="w-64 h-screen bg-custom-container border-r border-custom-border flex flex-col p-5 fixed z-10">
    <div class="text-center mb-10">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white">АДМИН-ПАНЕЛЬ</a>
    </div>
    <nav class="flex-grow space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-custom-border {{ request()->routeIs('admin.dashboard') ? 'bg-custom-accent' : '' }}">
            <span>Главная</span>
        </a>
        <a href="{{ route('admin.courses.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-custom-border {{ request()->routeIs('admin.courses.index') ? 'bg-custom-accent' : '' }}">
            <span>Курсы</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-custom-border {{ request()->routeIs('admin.users.index') ? 'bg-custom-accent' : '' }}">
            <span>Пользователи</span>
        </a>
    </nav>
    <div class="mt-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-custom-border">
            <span>Вернуться на сайт</span>
        </a>
    </div>
</aside>
