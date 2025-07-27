<x-admin-layout>
    {{-- Заголовок страницы с кнопками --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Управление курсами</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.courses.import.show') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold">
                Импорт
            </a>
            <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Добавить курс
            </a>
        </div>
    </div>

    {{-- Сообщение об успехе --}}
    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Таблица с курсами в светлом стиле --}}
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">Название</th>
                <th class="py-3 px-6 text-left">Уровень</th>
                <th class="py-3 px-6 text-left">Дата создания</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($courses as $course)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6 font-semibold">{{ $course->title }}</td>
                    <td class="py-4 px-6 capitalize">{{ $course->difficulty_level }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $course->created_at->format('d.m.Y') }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('admin.courses.content', $course) }}" class="text-green-600 hover:text-green-800 font-semibold">Управление</a>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Редактировать</a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('Вы уверены?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-6 px-6 text-center text-gray-500">Курсы еще не добавлены.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
