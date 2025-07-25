<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Редактировать страницу</h1>

    <form id="page-form" action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg">
            {{-- Заголовок --}}
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Заголовок страницы</label>
                <input type="text" name="title" id="title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" value="{{ old('title', $page->title) }}" required>
            </div>

            {{-- Контент Editor.js --}}
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-300">Контент</label>
                {{-- Убираем data-атрибут, он больше не нужен --}}
                <div id="editorjs" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5 min-h-[300px]"></div>
                <input type="hidden" name="content" id="content_text_output">
            </div>
        </div>

        <div class="flex items-center gap-4">
            {{-- ИСПРАВЛЕНО: Кнопка имеет type="button" и id --}}
            <button type="button" id="save-page-btn" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Сохранить изменения
            </button>
            <a href="{{ route('admin.pages.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
        </div>
    </form>

    {{-- --- НАЧАЛО ГЛАВНОГО ИСПРАВЛЕНИЯ --- --}}
    {{-- 1. Создаем скрипт ПЕРЕД подключением основного файла Vite --}}
    <script>
        window.INITIAL_EDITOR_DATA = @json($page->content ?? (object)[]);
    </script>
    {{-- --- КОНЕЦ ГЛАВНОГО ИСПРАВЛЕНИЯ --- --}}

    {{-- Подключаем наш отдельный скрипт для редактора страниц --}}
    @vite('resources/js/page-editor.js')
</x-admin-layout>
