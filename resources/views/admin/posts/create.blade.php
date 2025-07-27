<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Новый пост в блоге</h1>
        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <form id="post-form" action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6">
            <div class="space-y-6">
                {{-- Заголовок --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Заголовок поста</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Краткое содержание --}}
                <div>
                    <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-700">Краткое содержание (для превью)</label>
                    <textarea name="excerpt" id="excerpt" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"></textarea>
                </div>

                {{-- Контент Editor.js --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Основной контент</label>
                    <div id="editorjs" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 min-h-[300px]"></div>
                    <input type="hidden" name="content" id="content_text_output">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Опубликовать
            </button>
        </div>
    </form>

    {{-- Подключаем скрипт для Editor.js --}}
    @vite('resources/js/editor.js')
</x-admin-layout>
