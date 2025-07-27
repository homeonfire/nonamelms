<x-app-layout>
    {{-- Блок "Мои курсы" --}}
    <section>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Мои курсы</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($myCourses as $course)
                {{-- Вызываем компонент в обычном (кликабельном) режиме --}}
                <x-course-card :course="$course" />
            @empty
                <p class="text-gray-500 dark:text-custom-text-secondary col-span-full">У вас пока нет доступных курсов.</p>
            @endforelse
        </div>
    </section>

    {{-- Блок "Рекомендации" --}}
    <section class="mt-10">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Рекомендации</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($recommendedCourses as $course)
                {{-- Вызываем компонент в заблокированном режиме, передавая :locked="true" --}}
                <x-course-card :course="$course" :locked="true" />
            @endforeach
        </div>
    </section>
</x-app-layout>
