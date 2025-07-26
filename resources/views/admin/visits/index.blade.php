<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">История посещений</h1>
    </div>

    <div class="bg-gray-800 border border-gray-700 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
            <tr class="bg-gray-700 text-gray-400 uppercase text-sm">
                <th class="py-3 px-6 text-left">Пользователь</th>
                <th class="py-3 px-6 text-left">Source</th>
                <th class="py-3 px-6 text-left">Medium</th>
                <th class="py-3 px-6 text-left">Campaign</th>
                <th class="py-3 px-6 text-left">Дата визита</th>
            </tr>
            </thead>
            <tbody class="text-gray-300">
            @forelse ($visits as $visit)
                <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                    <td class="py-4 px-6">
                        {{-- Если визит уже связан с пользователем, показываем его email --}}
                        @if ($visit->user)
                            <span class="font-semibold">{{ $visit->user->email }}</span>
                        @else
                            <span class="text-gray-500">Аноним (ID: {{ Str::limit($visit->visitor_id, 8) }})</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">{{ $visit->utm_source }}</td>
                    <td class="py-4 px-6">{{ $visit->utm_medium }}</td>
                    <td class="py-4 px-6">{{ $visit->utm_campaign }}</td>
                    <td class="py-4 px-6 text-sm">{{ $visit->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 px-6 text-center text-gray-500">Записей о посещениях пока нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
