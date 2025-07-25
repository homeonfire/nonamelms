@php
    // Функция для получения встраиваемой ссылки на видео
    function getVideoEmbedUrl($url) {
        if (empty($url)) return null;

        // Kinescope
        if (preg_match('/kinescope\.io\/([a-zA-Z0-9]+)/', $url, $matches)) {
            return 'https://kinescope.io/embed/' . $matches[1];
        }

        // YouTube
        if (preg_match('/(v=|\/v\/|youtu\.be\/|embed\/)([^"&?\/ ]{11})/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[2];
        }

        // --- ДОБАВЛЕНО: Поддержка Rutube ---
        // Ищет ссылки вида https://rutube.ru/video/айди_видео/
        if (preg_match('/rutube\.ru\/video\/([a-zA-Z0-9_]+)\//', $url, $matches)) {
            return 'https://rutube.ru/play/embed/' . $matches[1];
        }
        // --- КОНЕЦ НОВОГО БЛОКА ---

        return null;
    }
    $embedUrl = $activeLesson ? getVideoEmbedUrl($activeLesson->content_url) : null;
@endphp

<x-app-layout>
    <div class="flex flex-col lg:flex-row gap-10">
        {{-- Основная часть с контентом урока --}}
        <div class="w-full lg:w-3/4">
            <div class="lesson-header mb-6">
                {{-- ИСПРАВЛЕНО: Цвета для обеих тем --}}
                <a href="{{ route('dashboard') }}" class="text-sm text-custom-text-secondary-light dark:text-custom-text-secondary-dark hover:text-custom-text-primary-light dark:hover:text-custom-text-primary-dark">← Назад к курсам</a>
                <h1 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mt-2">
                    {{ $course->title }}: <span class="text-custom-text-secondary-light dark:text-custom-text-secondary-dark">{{ $activeLesson?->title }}</span>
                </h1>
            </div>

            {{-- Видео плеер --}}
            @if ($embedUrl)
                <div class="aspect-video bg-custom-container-light dark:bg-custom-container-dark rounded-lg border border-custom-border-light dark:border-custom-border-dark">
                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture;" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                </div>
            @endif

            {{-- Контейнер для Editor.js --}}
            <div id="editorjs-viewer"
                 data-content="{{ json_encode($activeLesson->content_text ?? null) }}"
                 class="mt-8 bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-6 prose dark:prose-invert max-w-none">
                {{-- JS вставит сюда контент --}}
            </div>

            {{-- КНОПКА ЗАВЕРШЕНИЯ УРОКА --}}
            @if ($activeLesson && !$homework && !$lessonIsCompleted)
                <div class="mt-8">
                    <form action="{{ route('lessons.complete', $activeLesson) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white bg-custom-accent hover:bg-custom-accent-hover font-medium rounded-lg text-sm px-5 py-2.5">
                            Отметить как пройденный
                        </button>
                    </form>
                </div>
            @endif

            {{-- Блок Домашнего задания (с исправленными цветами) --}}
            @if ($homework)
                @php
                    $isSubmitted = ($userAnswer !== null);
                    $isLocked = $isSubmitted && in_array($userAnswer->status, ['submitted', 'checked']);
                @endphp
                <div class="mt-8 p-6 bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-2xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mb-6">Домашнее задание</h3>

                    {{-- Статус ДЗ --}}
                    @if ($isSubmitted)
                        @php
                            $statusText = ''; $statusClass = ''; $comment = !empty($userAnswer->comment) ? e($userAnswer->comment) : '';
                            switch ($userAnswer->status) {
                                case 'checked': $statusText = 'Принято'; $statusClass = 'bg-green-100 dark:bg-green-500/20 text-green-700 dark:text-green-400 border-green-200 dark:border-green-500/30'; break;
                                case 'rejected': $statusText = 'Отклонено (можно пересдать)'; $statusClass = 'bg-red-100 dark:bg-red-500/20 text-red-700 dark:text-red-400 border-red-200 dark:border-red-500/30'; break;
                                default: $statusText = 'Отправлено на проверку'; $statusClass = 'bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 border-blue-200 dark:border-blue-500/30'; break;
                            }
                        @endphp
                        <div class="mb-6 p-4 rounded-md border {{ $statusClass }}">
                            <p><strong>Статус:</strong> {{ $statusText }}</p>
                            @if ($comment)
                                <p class="mt-2 pt-2 border-t border-black/10 dark:border-white/10"><strong>Комментарий преподавателя:</strong> {{ $comment }}</p>
                            @endif
                        </div>
                    @endif

                    {{-- Форма ДЗ --}}
                    <form action="{{ route('homeworks.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="homework_id" value="{{ $homework->id }}">
                        <div class="space-y-6">
                            @foreach ($homework->questions as $index => $question)
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Вопрос {{ $index + 1 }}: {{ $question['q'] }}</label>
                                    <textarea name="answers[]" rows="4"
                                              class="bg-custom-background-light dark:bg-custom-background-dark border border-custom-border-light dark:border-custom-border-dark text-custom-text-primary-light dark:text-custom-text-primary-dark text-sm rounded-lg block w-full p-2.5"
                                          {{ $isLocked ? 'readonly' : '' }}>{{ $userAnswer->answers[$index]['a'] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        </div>

                        @if (!$isLocked)
                            <button type="submit" class="inline-block mt-6 text-white bg-custom-accent hover:bg-custom-accent-hover font-medium rounded-lg text-sm px-5 py-2.5">
                                {{ $isSubmitted ? 'Пересдать на проверку' : 'Сдать на проверку' }}
                            </button>
                        @endif
                    </form>
                </div>
            @endif

        </div>

        {{-- Боковая панель с содержанием --}}
        {{-- Боковая панель с содержанием --}}
        <div class="w-full lg:w-1/4">
            {{-- ИСПОЛЬЗУЕМ КЛАССЫ ДЛЯ ОБЕИХ ТЕМ --}}
            <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-5 sticky top-10">

                {{-- ПРОГРЕСС-БАР --}}
                <div class="mb-6">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-custom-text-primary-light dark:text-custom-text-primary-dark">Прогресс курса</span>
                        <span class="text-sm font-medium text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ $progressPercentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-custom-accent h-2.5 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>

                <h4 class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mb-4">Содержание курса</h4>
                <div class="space-y-4">
                    @foreach ($course->modules as $module)
                        <div>
                            <h5 class="font-semibold text-custom-text-secondary-light dark:text-custom-text-secondary-dark mb-2">{{ $module->title }}</h5>
                            <ul class="space-y-1">
                                @foreach ($module->lessons as $lesson)
                                    <li>
                                        <a href="{{ route('lessons.show', ['course' => $course, 'lesson' => $lesson]) }}"
                                           class="flex items-center gap-2 p-2 rounded-md text-sm transition-colors text-custom-text-secondary-light dark:text-custom-text-secondary-dark hover:bg-gray-100 dark:hover:bg-custom-border-dark hover:text-custom-text-primary-light dark:hover:text-custom-text-primary-dark
                                   {{ $activeLesson && $activeLesson->id == $lesson->id ? 'bg-custom-accent text-white' : '' }}">

                                            {{-- ИКОНКА-ГАЛОЧКА --}}
                                            @if (in_array($lesson->id, $completedLessonIds))
                                                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 9a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                            @endif
                                            <span>{{ $lesson->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/lesson-viewer.js')
</x-app-layout>
