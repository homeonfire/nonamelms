<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Редактировать страницу</h1>
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <form id="page-form" action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-lg">
            {{-- Заголовок --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Заголовок страницы</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('title', $page->title) }}" required>
            </div>

            {{-- Контент Editor.js --}}
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Контент</label>
                <div id="editorjs"
                     data-initial-data='@json($page->content ?? new stdClass)'
                     class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 min-h-[300px]"></div>
                <input type="hidden" name="content" id="content_text_output">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="button" id="save-page-btn" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Сохранить изменения
            </button>
        </div>
    </form>

    {{-- Скрипт для передачи данных в JS --}}
    <script>
        window.INITIAL_EDITOR_DATA = @json($page->content ?? new stdClass);
    </script>

    {{-- Подключаем скрипт для Editor.js --}}
    @vite('resources/js/page-editor.js')
</x-admin-layout>
