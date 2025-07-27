<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Редактировать пользователя: {{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 max-w-2xl">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                {{-- Имя --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Имя</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('name', $user->name) }}" required>
                </div>

                {{-- Email (нельзя редактировать) --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-500">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-200 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed" value="{{ $user->email }}" disabled>
                </div>

                {{-- Роль --}}
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Роль</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="user" @selected($user->role == 'user')>Пользователь</option>
                        <option value="admin" @selected($user->role == 'admin')>Администратор</option>
                    </select>
                </div>

                {{-- Доступные курсы --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Доступные курсы</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($courses as $course)
                            <label class="flex items-center p-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100">
                                <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                                       class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500"
                                    @checked(in_array($course->id, $userCourses))>
                                <span class="ms-3 text-sm font-medium text-gray-900">{{ $course->title }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
