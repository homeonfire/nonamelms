<x-admin-layout>
    <h1 class="text-3xl font-bold text-white mb-6">Управление LMS</h1>
    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-400 bg-green-800/50 rounded-lg">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="space-y-8">
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <label for="landing_page_enabled" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="landing_page_enabled" name="landing_page_enabled" class="sr-only" value="1" @checked($landingPageSetting->value == '1')>
                        <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                    </div>
                    <div class="ml-3 text-white font-medium">
                        Включить лендинг
                    </div>
                </label>
                <p class="mt-2 text-sm text-gray-400">Если выключено, пользователи будут автоматически перенаправляться на страницу входа.</p>
            </div>
            <div class="mt-6">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Сохранить</button>
            </div>
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <label for="default_course_id" class="block mb-2 text-sm font-medium text-white">Курс по умолчанию при регистрации</label>
                <select name="default_course_id" id="default_course_id" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    <option value="">Отключено</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @selected($defaultCourseSetting->value == $course->id)>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
                <p class="mt-2 text-sm text-gray-400">Выберите курс, доступ к которому будет выдаваться всем новым пользователям автоматически.</p>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Сохранить</button>
        </div>
        </div>
    </form>
</x-admin-layout>

<style>
    /* Стили для красивого переключателя */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #4f46e5;
    }
</style>
