<x-admin-layout>
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Настройки платежных систем</h1>

    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.payment.store') }}" method="POST">
        @csrf
        <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6 max-w-2xl">
            <h2 class="text-xl font-bold text-gray-800 mb-4">LeadPay</h2>
            <div class="space-y-4">
                {{-- Чекбокс включения --}}
                <label class="flex items-center">
                    <input type="checkbox" name="leadpay_enabled" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded" @checked(old('leadpay_enabled', $settings->get('enabled') == '1'))>
                    <span class="ms-2 text-sm font-medium text-gray-900">Включить LeadPay</span>
                </label>

                {{-- Поля для настроек --}}
                <div>
                    <label for="leadpay_login" class="block mb-2 text-sm font-medium text-gray-700">Адрес лендинга</label>
                    <input type="text" name="leadpay_login" id="leadpay_login" value="{{ old('leadpay_login', $settings->get('login')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
                <div>
                    <label for="leadpay_token" class="block mb-2 text-sm font-medium text-gray-700">Секретный токен</label>
                    <input type="password" name="leadpay_token" id="leadpay_token" value="{{ old('leadpay_token', $settings->get('token')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
                {{-- Поле ID продукта УДАЛЕНО --}}
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                Сохранить настройки
            </button>
        </div>
    </form>
</x-admin-layout>
