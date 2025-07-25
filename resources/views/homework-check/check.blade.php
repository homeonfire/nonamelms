<x-app-layout>
    <div class="flex justify-between items-center mb-6">
        <div>
            {{-- ИСПОЛЬЗУЕМ КЛАССЫ ДЛЯ ОБЕИХ ТЕМ --}}
            <h1 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mb-2">Проверка работы</h1>
            <p class="text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Студент: <span class="text-custom-text-primary-light dark:text-custom-text-primary-dark font-medium">{{ $submission->user->email }}</span> | Урок: <span class="text-custom-text-primary-light dark:text-custom-text-primary-dark font-medium">{{ $submission->homework->lesson->title }}</span></p>
        </div>
        <a href="{{ route('homework-check.index') }}" class="px-4 py-2 bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark text-custom-text-primary-light dark:text-custom-text-primary-dark rounded-lg hover:bg-gray-100 dark:hover:bg-custom-border-dark font-semibold">
            Назад к списку
        </a>
    </div>

    {{-- Блок с вопросами и ответами --}}
    <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-6 space-y-6">
        @foreach ($submission->homework->questions as $index => $question)
            <div class="pb-6 border-b border-custom-border-light dark:border-custom-border-dark last:border-b-0">
                <p class="text-sm font-semibold text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Вопрос {{ $index + 1 }}:</p>
                <p class="mt-1 text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ $question['q'] }}</p>
                <div class="mt-4 p-4 rounded-md bg-custom-background-light dark:bg-custom-background-dark border border-custom-border-light dark:border-custom-border-dark">
                    <p class="text-sm font-semibold text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Ответ студента:</p>
                    <p class="mt-1 text-custom-text-primary-light dark:text-custom-text-primary-dark whitespace-pre-wrap">{{ $submission->answers[$index]['a'] ?? 'Нет ответа' }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Форма для вынесения вердикта --}}
    <form action="{{ route('homework-check.process', $submission) }}" method="POST" class="mt-6">
        @csrf
        <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-6">
            <h3 class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mb-4">Вердикт</h3>
            <div>
                <label for="comment" class="block mb-2 text-sm font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Комментарий для студента (необязательно)</label>
                <textarea name="comment" id="comment" rows="4" class="bg-custom-background-light dark:bg-custom-background-dark border border-custom-border-light dark:border-custom-border-dark text-custom-text-primary-light dark:text-custom-text-primary-dark text-sm rounded-lg block w-full p-2.5" placeholder="Например: Отличная работа! или Попробуй подумать над вторым вопросом еще раз."></textarea>
            </div>
            <div class="mt-4 flex gap-4">
                <button type="submit" name="status" value="checked" class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">
                    Принять
                </button>
                <button type="submit" name="status" value="rejected" class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                    Отклонить
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
