<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Добавить новый курс</h1>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Название --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Название курса</label>
                    <input type="text" name="title" id="title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>

                {{-- Описание --}}
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Описание</label>
                    <textarea name="description" id="description" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"></textarea>
                </div>

                {{-- Уровень сложности --}}
                <div>
                    <label for="difficulty_level" class="block mb-2 text-sm font-medium text-gray-300">Уровень сложности</label>
                    <select name="difficulty_level" id="difficulty_level" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                        <option value="beginner">Начинающий</option>
                        <option value="intermediate">Средний</option>
                        <option value="advanced">Продвинутый</option>
                    </select>
                </div>
                {{-- Блок выбора категорий --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Категории</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($categories as $category)
                            <label class="flex items-center p-3 bg-gray-700 rounded-lg">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="w-4 h-4 text-indigo-600 bg-gray-900 border-gray-500 rounded focus:ring-indigo-600">
                                <span class="ms-3 text-sm font-medium text-white">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Создать курс
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
