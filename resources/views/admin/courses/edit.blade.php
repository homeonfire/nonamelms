<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Редактировать курс: {{ $course->title }}</h1>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT') {{-- Важно: указываем, что это метод PUT для обновления --}}
            <div class="space-y-6">
                {{-- Название --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Название курса</label>
                    <input type="text" name="title" id="title" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" value="{{ old('title', $course->title) }}" required>
                </div>

                {{-- Описание --}}
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Описание</label>
                    <textarea name="description" id="description" rows="4" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">{{ old('description', $course->description) }}</textarea>
                </div>

                {{-- Уровень сложности --}}
                <div>
                    <label for="difficulty_level" class="block mb-2 text-sm font-medium text-gray-300">Уровень сложности</label>
                    <select name="difficulty_level" id="difficulty_level" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                        <option value="beginner" @selected($course->difficulty_level == 'beginner')>Начинающий</option>
                        <option value="intermediate" @selected($course->difficulty_level == 'intermediate')>Средний</option>
                        <option value="advanced" @selected($course->difficulty_level == 'advanced')>Продвинутый</option>
                    </select>
                </div>
                {{-- Блок выбора категорий с предвыбранными значениями --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Категории</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($categories as $category)
                            <label class="flex items-center p-3 bg-gray-700 rounded-lg">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       @checked(in_array($category->id, $courseCategories))
                                       class="w-4 h-4 text-indigo-600 bg-gray-900 border-gray-500 rounded focus:ring-indigo-600">
                                <span class="ms-3 text-sm font-medium text-white">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
