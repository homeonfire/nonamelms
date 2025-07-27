<aside id="default-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0
              bg-custom-container-light dark:bg-custom-container-dark
              border-r border-custom-border-light dark:border-custom-border-dark
              flex flex-col p-4"
       aria-label="Sidebar">

    {{-- Логотип/Название --}}
    <div class="mb-5 px-4">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">
            {{ $appName }}
        </a>
    </div>

    {{-- Основная навигация --}}
    <nav class="flex-grow space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-custom-text-secondary-light dark:text-white hover:bg-gray-300 dark:hover:bg-custom-border-dark font-medium {{ request()->routeIs('dashboard') ? 'bg-custom-accent text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span>Главная</span>
        </a>
        <a href="{{ route('my-answers.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-custom-text-secondary-light dark:text-white hover:bg-gray-300 dark:hover:bg-custom-border-dark font-medium {{ request()->routeIs('my-answers.index') ? 'bg-custom-accent text-white' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Мои ответы</span>
        </a>
    </nav>

    {{-- Футер меню --}}
    <div class="mt-auto space-y-2">

        {{-- БЛОК ТОЛЬКО ДЛЯ АДМИНА --}}
        @if (Auth::user()?->role === 'admin')
            <div class="pt-4 mt-2 border-t border-custom-border-light dark:border-custom-border-dark">
                <span class="px-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase">Администрирование</span>
                <a href="{{ route('homework-check.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-custom-text-secondary-light dark:text-white hover:bg-gray-300 dark:hover:bg-custom-border-dark font-medium {{ request()->is('homework-check*') ? 'bg-custom-accent text-white' : '' }}">
                    <span>Проверка ДЗ</span>
                    @php $submittedCount = \App\Models\HomeworkAnswer::getSubmittedCount(); @endphp
                    @if($submittedCount > 0)
                        <span class="bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{ $submittedCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg text-custom-text-secondary-light dark:text-white hover:bg-gray-300 dark:hover:bg-custom-border-dark font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Панель управления</span>
                </a>
                <a href="https://t.me/igreskiv" target="_blank" class="flex items-center gap-3 px-4 py-2 rounded-lg text-custom-text-secondary-light dark:text-white hover:bg-gray-300 dark:hover:bg-custom-border-dark font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.546-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Написать разрабу</span>
                </a>
            </div>
        @endif

        {{-- Профиль, выход и переключатель тем --}}
        <div class="pt-4 mt-2 border-t border-gray-200 dark:border-custom-border-dark flex items-center justify-between">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-custom-text-secondary-light dark:text-custom-text-secondary-dark hover:text-custom-text-primary-light dark:hover:text-custom-text-primary-dark font-medium">
                <span>{{ Auth::user()->name }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-custom-text-secondary-light dark:text-custom-text-secondary-dark hover:text-red-500 dark:hover:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </a>
            </form>
            <button id="theme-toggle" type="button" class="text-gray-500 dark:text-custom-text-secondary hover:bg-gray-100 dark:hover:bg-custom-border-dark rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm-.707 10.607a1 1 0 011.414 0l.707-.707a1 1 0 11-1.414-1.414l-.707.707a1 1 0 010 1.414zM3 11a1 1 0 100 2H2a1 1 0 100-2h1z"></path></svg>
            </button>
        </div>

        {{-- Логотип разработчика --}}
        <div class="pt-4 mt-2 border-t border-gray-200 dark:border-custom-border-dark">
            <a href="https://nnlms.ru/" id="developer-link" target="_blank" class="flex justify-center items-center">
                <img src="{{ asset('images/my-logo.png') }}" alt="Логотип" class="h-12 w-auto grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
            </a>
        </div>
    </div>
</aside>
    <script>
        // Ждем, пока вся страница загрузится
        document.addEventListener('DOMContentLoaded', function() {
            // Находим нашу ссылку по ID
            const developerLink = document.getElementById('developer-link');

            if (developerLink) {
                // Получаем текущий домен сайта из адресной строки
                const currentHostname = window.location.hostname;

                // Формируем новую ссылку, добавляя UTM-метку
                const newUrl = `https://nnlms.ru/?utm_source=${currentHostname}`;

                // Устанавливаем новый адрес для ссылки
                developerLink.href = newUrl;
            }
        });
    </script>
