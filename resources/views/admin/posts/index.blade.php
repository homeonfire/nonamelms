<x-admin-layout>
    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Управление блогом</h1>
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
            Написать пост
        </a>
    </div>

    {{-- Status Message --}}
    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Posts Table --}}
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">Заголовок</th>
                <th class="py-3 px-6 text-left">Автор</th>
                <th class="py-3 px-6 text-left">Дата публикации</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($posts as $post)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6 font-semibold">{{ $post->title }}</td>
                    <td class="py-4 px-6">{{ $post->user->name }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $post->published_at ? $post->published_at->format('d.m.Y') : 'Черновик' }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Редактировать</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-6 px-6 text-center text-gray-500">Постов в блоге еще нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
