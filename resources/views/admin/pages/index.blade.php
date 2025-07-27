<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Статические страницы</h1>
        <a href="{{ route('admin.pages.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
            Добавить страницу
        </a>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">Заголовок</th>
                <th class="py-3 px-6 text-left">Ссылка (Slug)</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($pages as $page)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6 font-semibold">{{ $page->title }}</td>
                    <td class="py-4 px-6">/pages/{{ $page->slug }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Редактировать</a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-6 px-6 text-center text-gray-500">Страницы еще не созданы.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
