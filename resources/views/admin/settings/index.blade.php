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
            {{-- Блок "Название приложения" --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <label for="app_name" class="block mb-2 text-sm font-medium text-white">Название приложения</label>
                <input type="text" name="app_name" id="app_name"
                       value="{{ $settings->get('app_name', config('app.name')) }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                <p class="mt-2 text-sm text-gray-400">Это название будет отображаться в шапке сайта, заголовках вкладок и в письмах.</p>
            </div>

            {{-- Блок "Настройки SMTP" --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <h2 class="text-xl font-bold text-white mb-4">Настройки почты (SMTP)</h2>
                <div class="space-y-4">
                    <div>
                        <label for="mail_host" class="block mb-2 text-sm font-medium text-white">Хост</label>
                        <input type="text" name="mail_host" id="mail_host" value="{{ $settings->get('mail_host') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="mail_port" class="block mb-2 text-sm font-medium text-white">Порт</label>
                        <input type="text" name="mail_port" id="mail_port" value="{{ $settings->get('mail_port') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="mail_username" class="block mb-2 text-sm font-medium text-white">Имя пользователя</label>
                        <input type="text" name="mail_username" id="mail_username" value="{{ $settings->get('mail_username') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="mail_password" class="block mb-2 text-sm font-medium text-white">Пароль</label>
                        <input type="password" name="mail_password" id="mail_password" value="{{ $settings->get('mail_password') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                    <div>
                        <label for="mail_encryption" class="block mb-2 text-sm font-medium text-white">Шифрование</label>
                        <select name="mail_encryption" id="mail_encryption" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                            <option value="tls" @selected($settings->get('mail_encryption') == 'tls')>TLS</option>
                            <option value="ssl" @selected($settings->get('mail_encryption') == 'ssl')>SSL</option>
                        </select>
                    </div>
                    <div>
                        <label for="mail_from_address" class="block mb-2 text-sm font-medium text-white">Email отправителя</label>
                        <input type="email" name="mail_from_address" id="mail_from_address" value="{{ $settings->get('mail_from_address') }}" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    </div>
                </div>
            </div>

            {{-- Блок "Включить лендинг" --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <label for="landing_page_enabled" class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" id="landing_page_enabled" name="landing_page_enabled" class="sr-only" value="1" @checked($settings->get('landing_page_enabled', '1') == '1')>
                        <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                    </div>
                    <div class="ml-3 text-white font-medium">
                        Включить лендинг
                    </div>
                </label>
            </div>

            {{-- Блок "Курс по умолчанию" --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-2xl">
                <label for="default_course_id" class="block mb-2 text-sm font-medium text-white">Курс по умолчанию при регистрации</label>
                <select name="default_course_id" id="default_course_id" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">
                    <option value="">Отключено</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @selected($settings->get('default_course_id') == $course->id)>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">Сохранить</button>
        </div>
        <button type="submit" formaction="{{ route('admin.settings.test-smtp') }}" formmethod="POST" class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-semibold">
            Отправить тестовое письмо
        </button>
    </form>
</x-admin-layout>

<style>
    input:checked ~ .dot { transform: translateX(100%); background-color: #6366f1; }
    input:checked ~ .block { background-color: #4f46e5; }
</style>
