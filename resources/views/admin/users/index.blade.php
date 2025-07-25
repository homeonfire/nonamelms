<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Управление пользователями</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.users.import.show') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-semibold">
                Импорт
            </a>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Добавить пользователя
            </a>
        </div>
    </div>

    {{-- Сообщения --}}
    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-400 bg-green-800/50 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-700 text-gray-400 uppercase text-sm">
                <th class="py-3 px-6 text-left">Имя</th>
                <th class="py-3 px-6 text-left">Email</th>
                {{-- НОВАЯ КОЛОНКА --}}
                <th class="py-3 px-6 text-left">Доступ к курсам</th>
                <th class="py-3 px-6 text-left">Роль</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-300">
            @forelse ($users as $user)
                <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                    <td class="py-4 px-6 font-semibold">{{ $user->name }}</td>
                    <td class="py-4 px-6">{{ $user->email }}</td>
                    {{-- ЯЧЕЙКА С КУРСАМИ --}}
                    <td class="py-4 px-6">
                        <div class="flex flex-wrap gap-1">
                            @forelse($user->courses as $course)
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-600 text-gray-100">
                                        {{ $course->title }}
                                    </span>
                            @empty
                                <span class="text-xs text-gray-500">Нет доступов</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="py-4 px-6 capitalize">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                                {{ $user->role === 'admin' ? 'bg-green-700 text-green-100' : 'bg-gray-600 text-gray-100' }}">
                                {{ $user->role === 'admin' ? 'Администратор' : 'Пользователь' }}
                            </span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-400 hover:text-indigo-300 font-semibold">Редактировать</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 px-6 text-center text-gray-500">Других пользователей в системе нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
