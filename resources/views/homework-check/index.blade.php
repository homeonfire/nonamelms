<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        {{-- ИСПОЛЬЗУЕМ КЛАССЫ ДЛЯ ОБЕИХ ТЕМ --}}
        <h1 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Работы на проверку</h1>
    </div>

    @if (session('status'))
        <div class="mb-4 p-4 text-sm text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-800/50 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- ИСПОЛЬЗУЕМ КЛАССЫ ДЛЯ ОБЕИХ ТЕМ --}}
    <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg overflow-hidden">
        <table class="min-w-full">
            <tbody class="divide-y divide-custom-border-light dark:divide-custom-border-dark">
            @forelse ($submissions as $submission)
                <tr class="hover:bg-gray-50 dark:hover:bg-custom-border-dark/50">
                    <td class="p-4 text-custom-text-primary-light dark:text-custom-text-primary-dark font-semibold">{{ $submission->user->name }}</td>
                    <td class="p-4 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">
                        {{ $submission->homework->lesson->module->course->title }} /
                        <span class="text-custom-text-primary-light dark:text-custom-text-primary-dark font-medium">{{ $submission->homework->lesson->title }}</span>
                    </td>
                    <td class="p-4 text-custom-text-secondary-light dark:text-custom-text-secondary-dark text-sm">{{ $submission->submitted_at->format('d.m.Y H:i') }}</td>
                    <td class="p-4 text-right">
                        <a href="{{ route('homework-check.show', $submission) }}" class="text-white bg-custom-accent hover:bg-custom-accent-hover font-medium rounded-lg text-sm px-4 py-2">Проверить</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Новых работ на проверку нет.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
