<x-landing-layout>
    {{-- Слот для динамического заголовка страницы --}}
    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-custom-background-dark antialiased">
        <div class="flex justify-center px-4 mx-auto max-w-screen-xl">
            {{-- `format` классы от плагина Typography для красивого текста --}}
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    {{-- Блок с информацией об авторе --}}
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            {{-- В будущем здесь может быть аватар автора --}}
                            <img class="mr-4 w-16 h-16 rounded-full" src="https://placehold.co/64x64/2A2A2A/FFFFFF?text=A" alt="{{ $post->user->name }}">
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Автор</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    <time pubdate datetime="{{ $post->published_at->toIso8601String() }}" title="{{ $post->published_at->format('F jS, Y') }}">
                                        {{ $post->published_at->format('d.m.Y') }}
                                    </time>
                                </p>
                            </div>
                        </div>
                    </address>
                    {{-- Заголовок поста --}}
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $post->title }}</h1>
                </header>

        {{-- Контейнер, куда JS будет рендерить контент Editor.js --}}
        <div id="editorjs-viewer"
             data-content='@json($post->content ?? null)'
             class="prose dark:prose-invert max-w-none">
            {{-- Сюда будет вставлен готовый HTML --}}
        </div>


    {{-- Подключаем тот же самый скрипт, что и для уроков и страниц --}}
    @vite('resources/js/lesson-viewer.js')
    </article>
        </div>
    </main>
</x-landing-layout>
