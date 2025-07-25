<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Добавить нового пользователя</h1>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6 max-w-2xl">
        {{-- Отображение ошибок валидации --}}
        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-400 bg-red-800/50 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Имя --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Имя</label>
                    <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Пароль --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Пароль</label>
                    <input type="password" name="password" id="password" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Подтверждение пароля --}}
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-300">Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Роль --}}
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-300">Роль</label>
                    <select name="role" id="role" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                        <option value="user">Пользователь</option>
                        <option value="admin">Администратор</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Создать пользователя
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
            </div>
        </form>
    </div>
</x-admin-layout>
