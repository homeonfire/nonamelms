<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Редактировать курс: {{ $course->title }}</h1>
        <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 max-w-4xl">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                {{-- Название --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Название курса</label>
                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="{{ old('title', $course->title) }}" required>
                </div>

                {{-- Описание --}}
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Описание</label>
                    <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">{{ old('description', $course->description) }}</textarea>
                </div>

                {{-- Уровень сложности --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Уровень сложности</label>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center">
                            <input id="level-beginner" type="radio" value="beginner" name="difficulty_level" @checked($course->difficulty_level == 'beginner') class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300">
                            <label for="level-beginner" class="ms-2 text-sm font-medium text-gray-900">Начинающий</label>
                        </div>
                        <div class="flex items-center">
                            <input id="level-intermediate" type="radio" value="intermediate" name="difficulty_level" @checked($course->difficulty_level == 'intermediate') class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300">
                            <label for="level-intermediate" class="ms-2 text-sm font-medium text-gray-900">Средний</label>
                        </div>
                        <div class="flex items-center">
                            <input id="level-advanced" type="radio" value="advanced" name="difficulty_level" @checked($course->difficulty_level == 'advanced') class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300">
                            <label for="level-advanced" class="ms-2 text-sm font-medium text-gray-900">Продвинутый</label>
                        </div>
                    </div>
                </div>

                {{-- Блок выбора категорий --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Категории</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($categories as $category)
                            <label class="flex items-center p-3 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       @checked(in_array($category->id, $courseCategories))
                                       class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="ms-3 text-sm font-medium text-gray-900">{{ $category->name }}</span>
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
