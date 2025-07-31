<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Карточка заказа #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 font-semibold">
            Назад к заказам
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Основная информация --}}
        <div class="lg:col-span-2 bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-4 mb-4">Детали заказа</h3>
            <div class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">ID Заказа:</span>
                    <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Дата создания:</span>
                    <span class="font-semibold text-gray-900">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Статус:</span>
                    <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                        @if($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'failed') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ $order->status }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Сумма:</span>
                    <span class="font-semibold text-gray-900">{{ number_format($order->amount, 2, ',', ' ') }} ₽</span>
                </div>
            </div>
        </div>

        {{-- Информация о пользователе --}}
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-4 mb-4">Клиент</h3>
            <div class="space-y-2 text-sm">
                <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                <p class="text-gray-600">{{ $order->user->email }}</p>
            </div>
        </div>

        {{-- Информация о курсе --}}
        <div class="lg:col-span-3 bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-800 border-b border-gray-200 pb-4 mb-4">Состав заказа</h3>
            <p class="font-semibold text-gray-900">{{ $order->course->title }}</p>
        </div>

        {{-- Ссылка на оплату --}}
        <div class="lg:col-span-3 bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Ссылка на оплату</h3>
            <div class="flex gap-2">
                <input type="text" id="payment-link" value="{{ $order->payment_url ?? 'Ссылка не была сгенерирована' }}" readonly class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed">
                <button type="button" id="copy-link-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold flex-shrink-0">
                    Копировать
                </button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('copy-link-btn').addEventListener('click', function() {
            const linkInput = document.getElementById('payment-link');
            linkInput.select();
            navigator.clipboard.writeText(linkInput.value);
            this.textContent = 'Скопировано!';
            setTimeout(() => { this.textContent = 'Копировать'; }, 2000);
        });
    </script>
</x-admin-layout>
