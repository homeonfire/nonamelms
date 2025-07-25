<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Редактировать пользователя: {{ $user->name }}</h1>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6 max-w-2xl">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                {{-- Имя --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Имя</label>
                    <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" value="{{ old('name', $user->name) }}" required>
                </div>

                {{-- Email (нельзя редактировать) --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-400">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-900 border border-gray-700 text-gray-400 text-sm rounded-lg block w-full p-2.5" value="{{ $user->email }}" disabled>
                </div>

                {{-- Роль --}}
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-300">Роль</label>
                    <select name="role" id="role" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                        <option value="user" @selected($user->role == 'user')>Пользователь</option>
                        <option value="admin" @selected($user->role == 'admin')>Администратор</option>
                    </select>
                </div>
            </div>
            <div class="col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-300">Доступные курсы</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($courses as $course)
                        <label class="flex items-center p-3 bg-gray-700 rounded-lg">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                                   class="w-4 h-4 text-indigo-600 bg-gray-900 border-gray-500 rounded focus:ring-indigo-600"
                                @checked(in_array($course->id, $userCourses))>
                            <span class="ms-3 text-sm font-medium text-white">{{ $course->title }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Сохранить изменения
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
            </div>
        </form>
    </div>
</x-admin-layout>
