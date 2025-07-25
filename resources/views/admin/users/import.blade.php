<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Импорт пользователей</h1>

    <div class="max-w-2xl">
        {{-- Информационный блок с инструкцией --}}
        <div class="mb-6 p-4 border border-blue-500/30 bg-blue-900/20 text-blue-300 rounded-lg">
            <h3 class="font-bold mb-2">Как подготовить файл для импорта:</h3>
            <ol class="list-decimal list-inside text-sm space-y-1">
                <li>Файл должен быть в формате **XLSX** (стандартный файл Excel).</li>
                <li>Первая строка в файле — это **заголовки**.</li>
                <li>Обязательные заголовки: **name**, **email**, **password**. Порядок не важен.</li>
                <li>Все пользователи из файла будут созданы с ролью "Пользователь".</li>
                <li>Если вы выберете курсы ниже, все импортированные пользователи получат к ним доступ.</li>
            </ol>
            <a href="ВАША_ССЫЛКА_НА_ШАБЛОН_В_ГУГЛ_ДОКС" {{-- <-- Замените этот текст на вашу ссылку --}}
            target="_blank"
               class="inline-block mt-4 text-sm font-semibold text-indigo-400 hover:text-indigo-300">
                Скачать файл-шаблон &rarr;
            </a>
        </div>

        {{-- Форма для загрузки --}}
        <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6">
            <form action="{{ route('admin.users.import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    {{-- Поле для файла --}}
                    <div>
                        <label for="file" class="block mb-2 text-sm font-medium text-gray-300">1. Выберите XLSX файл</label>
                        <input type="file" name="file" id="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700" required>
                    </div>

                    {{-- Поле для выбора курсов --}}
                    <div>
                        <label for="courses" class="block mb-2 text-sm font-medium text-gray-300">2. Выдать доступ к курсам (необязательно)</label>
                        <select name="courses[]" id="courses" multiple class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5 h-32">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Зажмите Ctrl (или Cmd на Mac), чтобы выбрать несколько курсов.</p>
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                        Начать импорт
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
