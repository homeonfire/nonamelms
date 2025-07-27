<x-admin-layout>
    <div class="p-10">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-white">Редактировать контент</h1>
                <p class="mt-1 text-gray-400">Урок: "{{ $lesson->title }}"</p>
            </div>
            <a href="{{ route('admin.courses.content', $lesson->module->course_id) }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 font-semibold">
                Назад
            </a>
        </div>

        <form id="lesson-content-form" action="{{ route('admin.lessons.content.update', $lesson) }}" method="POST" class="space-y-6">
            @csrf

            {{-- Основной контент --}}
            <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg">
                <h2 class="text-xl font-bold text-white mb-4">Содержимое урока</h2>
                <div>
                    <label for="content_url" class="block mb-2 text-sm font-medium text-gray-300">Ссылка на видео</label>
                    <input type="url" name="content_url" id="content_url" value="{{ old('content_url', $lesson->content_url) }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                </div>
                <div class="mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-300">Текстовый контент</label>
                    <div id="editorjs"
                         data-initial-data="{{ json_encode($lesson->content_text ?? '{}') }}"
                         data-initial-data="{{ json_encode($lesson->content_text ?? '{}') }}"
                         data-upload-file-url="{{ route('admin.editorjs.upload-file') }}"
                         data-fetch-url="{{ route('admin.editorjs.fetch-url') }}"
                         data-upload-url="{{ route('admin.editorjs.upload-image') }}"
                         class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5 min-h-[250px]"></div>
                    <input type="hidden" name="content_text" id="content_text_output">
                </div>
            </div>

            {{-- Домашнее задание --}}
            <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg">
                <h2 class="text-xl font-bold text-white mb-4">Вопросы для домашнего задания</h2>
                <div id="questions-container" class="space-y-4">
                    @if($lesson->homework && !empty($lesson->homework->questions))
                        @foreach($lesson->homework->questions as $question)
                            <div class="flex items-center gap-2">
                                <input type="text" name="questions[]" value="{{ $question['q'] }}" class="flex-grow bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                                <button type="button" class="remove-question text-red-400 hover:text-red-300 font-semibold">Удалить</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="add-question" class="mt-4 text-sm text-indigo-400 hover:text-indigo-300 font-semibold">+ Добавить вопрос</button>
            </div>

            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Сохранить изменения
            </button>
        </form>
    </div>


    {{-- Скрипт для ДЗ и Editor.js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('questions-container');

            document.getElementById('add-question').addEventListener('click', function () {
                const newField = document.createElement('div');
                newField.className = 'flex items-center gap-2';
                newField.innerHTML = `
                    <input type="text" name="questions[]" class="flex-grow bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" placeholder="Текст нового вопроса">
                    <button type="button" class="remove-question text-red-400 hover:text-red-300 font-semibold">Удалить</button>
                `;
                container.appendChild(newField);
            });

            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-question')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
    @vite('resources/js/editor.js')
</x-admin-layout>
