<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">История посещений</h1>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6 text-left">Пользователь</th>
                <th class="py-3 px-6 text-left">Source</th>
                <th class="py-3 px-6 text-left">Medium</th>
                <th class="py-3 px-6 text-left">Campaign</th>
                <th class="py-3 px-6 text-left">Дата визита</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            @forelse ($visits as $visit)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-6">
                        @if ($visit->user)
                            <span class="font-semibold">{{ $visit->user->email }}</span>
                        @else
                            <span class="text-gray-500">Аноним (ID: {{ Str::limit($visit->visitor_id, 8) }})</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">{{ $visit->utm_source }}</td>
                    <td class="py-4 px-6">{{ $visit->utm_medium }}</td>
                    <td class="py-4 px-6">{{ $visit->utm_campaign }}</td>
                    <td class="py-4 px-6 text-sm text-gray-600">{{ $visit->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 px-6 text-center text-gray-500">Записей о посещениях пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
