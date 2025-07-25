<aside id="default-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0
              bg-custom-container-light dark:bg-custom-container-dark
              border-r border-custom-border-light dark:border-custom-border-dark
              flex flex-col p-5"
       aria-label="Sidebar">
    <div class="text-center mb-10">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <nav class="flex-grow space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black {{ request()->routeIs('dashboard') ? 'bg-custom-accent text-white' : '' }}">
            <span>Главная</span>
        </a>
        <a href="{{ route('my-answers.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black {{ request()->routeIs('my-answers.index') ? 'bg-custom-accent text-white' : '' }}">
            <span>Мои ответы</span>
        </a>
    </nav>

    {{-- Футер меню --}}
    <div class="mt-auto">
        {{-- БЛОК ТОЛЬКО ДЛЯ АДМИНА --}}
        @if (Auth::user()?->role === 'admin')
            <div class="pt-4 mt-4 border-gray-200 dark:border-custom-border">
                <span class="px-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Администрирование</span>
                <a href="{{ route('homework-check.index') }}" class="mt-2 flex items-center justify-between px-4 py-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black {{ request()->is('homework-check*') ? 'bg-custom-accent text-white' : '' }}">
                    <span>Проверка ДЗ</span>
                    @php $submittedCount = \App\Models\HomeworkAnswer::getSubmittedCount(); @endphp
                    @if($submittedCount > 0)
                        <span class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{ $submittedCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black">
                    <span>Панель управления</span>
                </a>
                {{-- НОВАЯ КНОПКА --}}
                <a href="https://t.me/igreskiv" {{-- <-- Замените на ваш email --}}
                class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black">
                    <span>Написать разрабу</span>
                </a>
            </div>
        @endif

        {{-- Переключатель тем --}}
        <div class="border-gray-200 dark:border-custom-border pt-4 mt-4">
            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border focus:outline-none rounded-lg text-sm p-2.5 dark:hover:text-black">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm-.707 10.607a1 1 0 011.414 0l.707-.707a1 1 0 11-1.414-1.414l-.707.707a1 1 0 010 1.414zM3 11a1 1 0 100 2H2a1 1 0 100-2h1z"></path></svg>
            </button>
        </div>


        {{-- Профиль и выход --}}
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black {{ request()->routeIs('profile.edit') ? 'bg-custom-accent text-white' : '' }}">
            <span>{{ Auth::user()->name }}</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="flex w-full items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-custom-border dark:hover:text-black">
                <span>Выход</span>
            </a>
        </form>
    </div>
</aside>
