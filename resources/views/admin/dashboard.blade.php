<x-admin-layout>
    <h1 class="text-3xl font-bold text-white">Главная</h1>
    <p class="mt-2 text-gray-400 mb-6">Обзор вашей платформы.</p>

    {{-- Основная сетка дашборда --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Левая, основная колонка --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Сетка для карточек со статистикой --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Карточка "Всего курсов" --}}
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-400">Всего курсов</h3>
                    <p class="text-4xl font-bold text-white mt-2">{{ $totalCourses }}</p>
                </div>
                {{-- Карточка "Всего пользователей" --}}
                <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-400">Всего пользователей</h3>
                    <p class="text-4xl font-bold text-white mt-2">{{ $totalUsers }}</p>
                </div>
            </div>

            {{-- Список недавно добавленных курсов --}}
            <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Недавно добавленные курсы</h3>
                <div class="space-y-4">
                    @forelse ($latestCourses as $course)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-gray-300">{{ $course->title }}</p>
                                <p class="text-sm text-gray-500">{{ $course->created_at->format('d.m.Y') }}</p>
                            </div>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-semibold text-indigo-400 hover:text-indigo-300">Редактировать</a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Новых курсов пока нет.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Правая колонка для новых пользователей --}}
        <div class="lg:col-span-1 bg-gray-800 p-6 rounded-lg border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4">Новые пользователи</h3>
            <div class="space-y-4">
                @forelse ($latestUsers as $user)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-300">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $user->role === 'admin' ? 'bg-green-700 text-green-100' : 'bg-gray-600 text-gray-100' }}">{{ $user->role }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Новых пользователей пока нет.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-admin-layout>
