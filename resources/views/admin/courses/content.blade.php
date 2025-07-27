<x-admin-layout>
    {{-- Заголовок страницы --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Управление контентом</h1>
            <p class="mt-1 text-gray-600">Курс: "{{ $course->title }}"</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Назад к курсам
        </a>
    </div>

    {{-- Сообщение об успехе --}}
    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Форма добавления нового модуля --}}
    <div class="bg-white border border-gray-200 rounded-lg p-6 mb-8 shadow-sm">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Добавить новый модуль</h3>
        <form action="{{ route('admin.modules.store', $course) }}" method="POST">
            @csrf
            <div class="flex gap-4">
                <input type="text" name="title" class="flex-grow bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Название модуля" required>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Добавить
                </button>
            </div>
        </form>
    </div>

    {{-- Список существующих модулей и уроков --}}
    <div class="space-y-6">
        @forelse ($course->modules as $module)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                {{-- Редактирование и удаление модуля --}}
                <div class="p-4 flex justify-between items-center border-b border-gray-200">
                    <form action="{{ route('admin.modules.update', $module) }}" method="POST" class="flex-grow flex items-center gap-4">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $module->title }}" class="bg-transparent text-xl font-bold text-gray-800 w-full border-0 focus:ring-2 focus:ring-indigo-500 rounded-md p-1">
                    </form>
                    <div class="flex gap-4 ml-4 flex-shrink-0">
                        <button type="submit" form="edit-module-form-{{ $module->id }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">Сохранить</button>
                        <form action="{{ route('admin.modules.destroy', $module) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Вы уверены? Все уроки внутри модуля также будут удалены.')">Удалить</button>
                        </form>
                    </div>
                </div>
                {{-- Уроки --}}
                <div class="p-4 space-y-2">
                    @forelse ($module->lessons as $lesson)
                        <div class="flex justify-between items-center p-2 rounded-md hover:bg-gray-50">
                            <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST" class="flex-grow flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $lesson->title }}" class="bg-transparent text-gray-700 w-full border-0 focus:ring-1 focus:ring-indigo-500 rounded-md">
                            </form>
                            <div class="flex gap-4 text-sm ml-2 flex-shrink-0">
                                <a href="{{ route('admin.lessons.content.edit', $lesson) }}" class="font-semibold text-green-600 hover:text-green-800">Контент</a>
                                <button type="submit" form="edit-lesson-form-{{ $lesson->id }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Сохранить</button>
                                <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm px-2">Уроков в этом модуле еще нет.</p>
                    @endforelse
                    {{-- Форма добавления нового урока --}}
                    <form action="{{ route('admin.lessons.store', $module) }}" method="POST" class="mt-4 flex gap-2">
                        @csrf
                        <input type="text" name="title" class="flex-grow bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg block w-full p-2" placeholder="Название нового урока" required>
                        <button type="submit" class="px-4 py-1 bg-gray-200 text-xs rounded-lg hover:bg-gray-300 font-semibold text-gray-800">Добавить урок</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center text-gray-500">
                Модули для этого курса еще не созданы.
            </div>
        @endforelse
    </div>
</x-admin-layout>
