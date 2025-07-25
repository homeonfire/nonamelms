<x-app-layout>
    {{-- Блок "Мои курсы" --}}
    <section>
        @if($myCourses->isNotEmpty())
            {{-- Приветствие, если есть курсы --}}
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Добро пожаловать, {{ Auth::user()->name }}!</h3>
            {{-- ДОБАВЛЕН ПОДЗАГОЛОВОК --}}
            <p class="mt-1 text-gray-500 dark:text-custom-text-secondary mb-5">Готовы продолжить обучение?</p>
        @else
            {{-- Стандартный заголовок, если курсов нет --}}
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Мои курсы</h3>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($myCourses as $course)
                <x-course-card :course="$course" />
            @empty
                <p class="text-gray-500 dark:text-custom-text-secondary col-span-full">
                    У вас пока нет доступных курсов. Обратитесь к администратору для получения доступа.
                </p>
            @endforelse
        </div>
    </section>

    {{-- Блок "Рекомендации" --}}
    <section class="mt-10">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Рекомендации</h3>
        {{-- ИЗМЕНЕНО: lg:grid-cols-4 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($recommendedCourses as $course)
                <div class="relative block rounded-lg opacity-50 cursor-not-allowed">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center z-10">
                        <span class="text-white font-bold text-lg">Доступ закрыт</span>
                    </div>
                    <x-course-card :course="$course" />
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
