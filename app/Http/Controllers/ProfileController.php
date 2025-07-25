<?php

namespace App\Http\Controllers;

// Подключаем необходимые классы
use App\Http\Requests\ProfileUpdateRequest; // Специальный класс для валидации данных профиля
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для работы с аутентификацией
use Illuminate\Support\Facades\Redirect; // Для удобных редиректов
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Отображает страницу с формой редактирования профиля пользователя.
     * URI: /profile
     * Method: GET
     *
     * @param Request $request Объект текущего запроса.
     * @return View
     */
    public function edit(Request $request): View
    {
        // Возвращаем вид (view) 'profile.edit' и передаем в него
        // данные текущего авторизованного пользователя ($request->user()).
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Обновляет информацию в профиле пользователя.
     * URI: /profile
     * Method: PATCH
     *
     * @param ProfileUpdateRequest $request Специальный объект запроса, который уже содержит правила валидации.
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Заполняем модель пользователя (`$request->user()`) только теми данными,
        //    которые прошли валидацию в классе `ProfileUpdateRequest`.
        $request->user()->fill($request->validated());

        // 2. Если пользователь изменил свой email...
        if ($request->user()->isDirty('email')) {
            // ...сбрасываем флаг верификации email, чтобы он подтвердил его заново.
            $request->user()->email_verified_at = null;
        }

        // 3. Сохраняем все изменения в базе данных.
        $request->user()->save();

        // 4. Перенаправляем пользователя обратно на страницу редактирования профиля
        //    и передаем в сессию сообщение 'profile-updated' для показа уведомления.
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Удаляет аккаунт пользователя.
     * URI: /profile
     * Method: DELETE
     *
     * @param Request $request Объект текущего запроса.
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 1. Проводим валидацию: проверяем, что поле 'password' было передано
        //    и что оно соответствует текущему паролю пользователя.
        //    'userDeletion' - это имя "сумки" с ошибками, для разделения ошибок на странице.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // 2. Получаем модель текущего пользователя.
        $user = $request->user();

        // 3. "Разлогиниваем" пользователя.
        Auth::logout();

        // 4. Удаляем запись пользователя из базы данных.
        $user->delete();

        // 5. Полностью очищаем сессию пользователя и генерируем новый токен
        //    для безопасности, чтобы предотвратить фиксацию сессии.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 6. Перенаправляем уже бывшего пользователя на главную страницу.
        return Redirect::to('/');
    }
}
