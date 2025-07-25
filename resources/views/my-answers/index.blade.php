<x-app-layout>
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-300 mb-8">Мои домашние задания</h1>

    {{-- Секция "На проверке" --}}
    <section>
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-5">На проверке</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($unchecked as $answer)
                <a href="{{ route('lessons.show', ['course' => $answer->homework->lesson->module->course, 'lesson' => $answer->homework->lesson]) }}"
                   class="block p-5 bg-white border border-custom-border dark:border-custom-border-dark rounded-lg hover:border-custom-accent transition-colors dark:bg-custom-container-dark">
                    <h4 class="font-bold text-gray-900 dark:text-gray-300">{{ $answer->homework->lesson->module->course->title }}</h4>
                    <p class="text-sm text-custom-text-secondary mt-1 dark:text-gray-400">{{ $answer->homework->lesson->title }}</p>
                    <div class="mt-4 inline-block text-xs font-semibold px-2 py-1 rounded-full bg-blue-500/20 text-blue-500 dark:text-blue-300">На проверке</div>
                </a>
            @empty
                <p class="text-custom-text-secondary col-span-full dark:text-gray-500">Нет работ, ожидающих проверки.</p>
            @endforelse
        </div>
    </section>

    {{-- Секция "Проверенные" --}}
    <section class="mt-10">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-300 mb-5">Проверенные</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($checked as $answer)
                <a href="{{ route('lessons.show', ['course' => $answer->homework->lesson->module->course, 'lesson' => $answer->homework->lesson]) }}"
                   class="block p-5 bg-white border border-custom-border dark:border-custom-border-dark rounded-lg hover:border-custom-accent transition-colors dark:bg-custom-container-dark">
                    <h4 class="font-bold text-gray-900 dark:text-gray-300">{{ $answer->homework->lesson->module->course->title }}</h4>
                    <p class="text-sm text-custom-text-secondary mt-1 dark:text-gray-300">{{ $answer->homework->lesson->title }}</p>
                    @if ($answer->status === 'checked')
                        <div class="mt-4 inline-block text-xs font-semibold px-2 py-1 rounded-full bg-green-500/20 text-green-400">Принято</div>
                    @else
                        <div class="mt-4 inline-block text-xs font-semibold px-2 py-1 rounded-full bg-red-500/20 text-red-400">Отклонено</div>
                    @endif
                </a>
            @empty
                <p class="text-custom-text-secondary col-span-full dark:text-gray-500">Проверенных работ пока нет.</p>
            @endforelse
        </div>
    </section>
</x-app-layout>
