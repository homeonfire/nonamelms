<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Добавить нового пользователя</h1>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 max-w-2xl">
        {{-- Отображение ошибок валидации --}}
        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
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
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Имя</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Пароль --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Пароль</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Подтверждение пароля --}}
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Роль --}}
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Роль</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="user">Пользователь</option>
                        <option value="admin">Администратор</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Создать пользователя
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
