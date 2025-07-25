<x-landing-layout>
    <div class="container mx-auto px-4 py-16 max-w-4xl">
        {{-- Заголовок страницы --}}
        <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">{{ $page->title }}</h1>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Опубликовано: {{ $page->created_at->format('d.m.Y') }}
            </p>
        </div>

        {{-- Контейнер, куда JS будет рендерить контент Editor.js --}}
        <div id="editorjs-viewer"
             data-content='@json($page->content ?? null)'
             class="prose dark:prose-invert max-w-none">
            {{-- Сюда будет вставлен готовый HTML --}}
        </div>
    </div>

    {{-- Подключаем тот же самый скрипт, что и для уроков --}}
    @vite('resources/js/lesson-viewer.js')
</x-landing-layout>
