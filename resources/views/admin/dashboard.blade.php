<x-admin-layout>
    <h1 class="text-3xl font-bold text-gray-800">Главная</h1>
    <p class="mt-1 text-gray-600 mb-6">Обзор вашей платформы.</p>

    {{-- Карточки со статистикой --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-500">Всего курсов</h3>
            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalCourses }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-500">Всего пользователей</h3>
            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-500">Будет заполнено</h3>
            <p class="text-4xl font-bold text-gray-900 mt-2">--</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-500">Будет заполнено</h3>
            <p class="text-4xl font-bold text-gray-900 mt-2">--</p>
        </div>
        {{-- Сюда можно вернуть карточку с ДЗ на проверку --}}
    </div>

    {{-- Списки последних активностей --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        {{-- Недавно добавленные курсы --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Недавно добавленные курсы</h3>
            <div class="space-y-4">
                @forelse ($latestCourses as $course)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $course->title }}</p>
                            <p class="text-sm text-gray-500">{{ $course->created_at->format('d.m.Y') }}</p>
                        </div>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">Редактировать</a>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Новых курсов пока нет.</p>
                @endforelse
            </div>
        </div>
        {{-- Новые пользователи --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Новые пользователи</h3>
            <div class="space-y-4">
                @forelse ($latestUsers as $user)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">{{ $user->role }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Новых пользователей пока нет.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
