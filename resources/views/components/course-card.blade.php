@props(['course'])

@php
    // Проверяем, есть ли у курса свойство pivot. Оно будет только у курсов пользователя.
    $lessonId = $course->pivot->last_viewed_lesson_id ?? null;
    $url = $lessonId
        ? route('lessons.show', ['course' => $course, 'lesson' => $lessonId])
        : route('courses.show', $course);
@endphp

<a href="{{ $url }}" class="block p-6 bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg group h-full flex flex-col hover:border-custom-accent dark:hover:border-custom-accent transition-colors">
    <div class="flex-grow">
        {{-- Теги категорий --}}
        <div class="flex flex-wrap gap-2 mb-3 min-h-[26px]">
            @if($course->categories->isNotEmpty())
                @foreach($course->categories as $category)
                    <span class="text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">{{ $category->name }}</span>
                @endforeach
            @endif
        </div>

        {{-- Название курса --}}
        <h4 class="text-lg font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ $course->title }}</h4>

        {{-- Описание курса --}}
        <p class="mt-2 text-sm text-custom-text-secondary-light dark:text-custom-text-secondary-dark">
            {{ Str::limit($course->description, 100) }}
        </p>
    </div>

    {{-- Прогресс-бар --}}
    @if(isset($course->progressPercentage))
        <div class="mt-4 pt-4 border-t border-custom-border-light dark:border-custom-border-dark">
            <div class="flex justify-between mb-1">
                <span class="text-xs font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Прогресс</span>
                <span class="text-xs font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">{{ $course->progressPercentage }}%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5">
                <div class="bg-custom-accent h-1.5 rounded-full" style="width: {{ $course->progressPercentage }}%"></div>
            </div>
        </div>
    @endif
</a>
