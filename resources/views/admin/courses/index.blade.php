<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Управление курсами</h1>
        @if (session('status'))
            <div class="mb-4 p-4 text-sm text-green-400 bg-green-800/50 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
            Добавить курс
        </a>
        <a href="{{ route('admin.courses.import.show') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-semibold">
            Импорт
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            {{-- Заголовок таблицы в темном стиле --}}
            <tr class="bg-gray-700 text-gray-400 uppercase text-sm">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Название</th>
                <th class="py-3 px-6 text-left">Уровень</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-300">
            @forelse ($courses as $course)
                {{-- Строки таблицы в темном стиле --}}
                <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                    <td class="py-4 px-6">{{ $course->id }}</td>
                    <td class="py-4 px-6 font-semibold">{{ $course->title }}</td>
                    <td class="py-4 px-6 capitalize">{{ $course->difficulty_level }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-4">
                            {{-- Новая кнопка --}}
                            <a href="{{ route('admin.courses.content', $course) }}" class="text-green-400 hover:text-green-300 font-semibold">Управление</a>

                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Редактировать</a>

                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-semibold" onclick="return confirm('Вы уверены?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 px-6 text-center text-gray-500">Курсы еще не добавлены.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
