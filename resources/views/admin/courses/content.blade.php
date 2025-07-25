<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white">Управление контентом</h1>
            <p class="mt-1 text-gray-400">Курс: "{{ $course->title }}"</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 font-semibold">
            Назад к курсам
        </a>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-400 bg-green-800/50 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Форма добавления нового модуля --}}
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 mb-8">
        <h3 class="text-xl font-bold text-white mb-4">Добавить новый модуль</h3>
        <form action="{{ route('admin.modules.store', $course) }}" method="POST">
            @csrf
            <div class="flex gap-4">
                <input type="text" name="title" class="flex-grow bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" placeholder="Название модуля" required>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Добавить
                </button>
            </div>
        </form>
    </div>

    {{-- Список существующих модулей и уроков --}}
    <div class="space-y-6">
        @forelse ($course->modules as $module)
            <div class="bg-gray-800 border border-gray-700 rounded-lg">
                {{-- Редактирование и удаление модуля --}}
                <div class="p-4 flex justify-between items-center border-b border-gray-700">
                    <form action="{{ route('admin.modules.update', $module) }}" method="POST" class="flex-grow flex items-center gap-4">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $module->title }}" class="bg-gray-800 text-xl font-bold text-white w-full border-0 focus:ring-2 focus:ring-indigo-500 rounded-md">
                        <button type="submit" class="text-sm px-4 py-1 bg-gray-700 rounded-md hover:bg-gray-600">Сохранить</button>
                    </form>
                    <div class="flex gap-4 ml-4">
                        <form action="{{ route('admin.modules.destroy', $module) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 font-semibold" onclick="return confirm('Вы уверены? Все уроки внутри модуля также будут удалены.')">Удалить</button>
                        </form>
                    </div>
                </div>
                {{-- Уроки --}}
                <div class="p-4 space-y-2">
                    @forelse ($module->lessons as $lesson)
                        <div class="flex justify-between items-center p-2 rounded-md hover:bg-gray-700/50">
                            <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST" class="flex-grow flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $lesson->title }}" class="bg-transparent text-gray-300 w-full border-0 focus:ring-1 focus:ring-indigo-500 rounded-md">
                                <button type="submit" class="text-xs px-3 py-1 bg-gray-700 rounded-md hover:bg-gray-600">Сохранить</button>
                            </form>
                            <div class="flex gap-4 text-sm ml-2">
                                <a href="{{ route('admin.lessons.content.edit', $lesson) }}" class="text-green-400 hover:text-green-300">Контент</a>
                                <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm px-2">Уроков в этом модуле еще нет.</p>
                    @endforelse
                    {{-- Форма добавления нового урока --}}
                    <form action="{{ route('admin.lessons.store', $module) }}" method="POST" class="mt-4 flex gap-2">
                        @csrf
                        <input type="text" name="title" class="flex-grow bg-gray-700 border border-gray-600 text-white text-xs rounded-lg block w-full p-2" placeholder="Название нового урока" required>
                        <button type="submit" class="px-4 py-1 bg-gray-700 text-xs rounded-lg hover:bg-gray-600">Добавить урок</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">
                Модули для этого курса еще не созданы.
            </div>
        @endforelse
    </div>
</x-admin-layout>
