@props(['course', 'locked' => false])

@php
    // Генерируем ссылку только если курс не заблокирован
    if (!$locked) {
        $lessonId = $course->pivot->last_viewed_lesson_id ?? null;
        $url = $lessonId
            ? route('lessons.show', ['course' => $course, 'lesson' => $lessonId])
            : route('courses.show', $course);
    }
@endphp

{{-- Выбираем, какой тег использовать: <a> для доступных, <div> для заблокированных --}}
<{{ $locked ? 'div' : 'a' }}
    @if (!$locked) href="{{ $url }}" @endif
class="relative block p-6 bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg h-full flex flex-col
{{ $locked
   ? 'opacity-50 cursor-not-allowed'
   : 'group hover:border-custom-accent dark:hover:border-custom-accent transition-colors' }}">

{{-- ИКОНКА ЗАМКА (появляется только если курс заблокирован) --}}
@if ($locked)
    <div class="absolute top-4 right-4 z-10">
        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd"></path></svg>
    </div>
@endif

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
</{{ $locked ? 'div' : 'a' }}>
