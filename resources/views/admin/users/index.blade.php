<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Управление пользователями</h1>
        <div class="flex gap-4">
            <a href="{{ route('admin.users.import.show') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold">
                Импорт
            </a>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Добавить пользователя
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Имя</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Роль</th>
                <th class="py-3 px-6 text-left">Дата регистрации</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6">{{ $user->id }}</td>
                    <td class="py-4 px-6 font-semibold">{{ $user->name }}</td>
                    <td class="py-4 px-6">{{ $user->email }}</td>
                    <td class="py-4 px-6 capitalize">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                                {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $user->role === 'admin' ? 'Администратор' : 'Пользователь' }}
                            </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Редактировать</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">Других пользователей в системе нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
