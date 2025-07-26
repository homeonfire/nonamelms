<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Новый пост в блоге</h1>

    <form id="post-form" action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6">
            <div class="space-y-6">
                {{-- Заголовок --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Заголовок поста</label>
                    <input type="text" name="title" id="title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Краткое содержание --}}
                <div>
                    <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-300">Краткое содержание (для превью)</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"></textarea>
                </div>

                {{-- Контент Editor.js --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Основной контент</label>
                    <div id="editorjs" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5 min-h-[300px]"></div>
                    <input type="hidden" name="content" id="content_text_output">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Опубликовать
            </button>
            <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
        </div>
    </form>

    {{-- Подключаем скрипт для Editor.js --}}
    @vite('resources/js/editor.js')
</x-admin-layout>
