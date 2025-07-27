<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Создать новую категорию</h1>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Отмена
        </a>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Название категории</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Создать
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
