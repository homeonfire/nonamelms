<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Создать новую категорию</h1>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg p-6 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Название категории</label>
                    <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5" required>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Создать
                </button>
                <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-white">Отмена</a>
            </div>
        </form>
    </div>
</x-admin-layout>
