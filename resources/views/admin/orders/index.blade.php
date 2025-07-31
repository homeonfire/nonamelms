<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class-="text-3xl font-bold text-gray-800">Все заказы</h1>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Пользователь</th>
                <th class="py-3 px-6 text-left">Курс</th>
                <th class="py-3 px-6 text-left">Сумма</th>
                <th class="py-3 px-6 text-left">Статус</th>
                <th class="py-3 px-6 text-left">Дата</th>
                <th class="py-3 px-6 text-center">Действия</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6">#{{ $order->id }}</td>
                    <td class="py-4 px-6 font-semibold">{{ $order->user->email }}</td>
                    <td class="py-4 px-6">{{ $order->course->title }}</td>
                    <td class="py-4 px-6">{{ $order->amount }} ₽</td>
                    <td class="py-4 px-6 capitalize">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full text-xs
                                @if($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'failed') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $order->status }}
                            </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Карточка</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">Заказов пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
