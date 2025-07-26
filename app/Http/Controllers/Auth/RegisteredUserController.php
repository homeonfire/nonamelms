<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Отображает форму регистрации.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Обрабатывает запрос на регистрацию.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Валидация данных из формы
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        // 2. Создание нового пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Логика отслеживания UTM-меток
        $visitorId = $request->cookie('visitor_id');
        if ($visitorId) {
            $visits = \App\Models\Visit::where('visitor_id', $visitorId)->whereNull('user_id')->orderBy('created_at', 'asc')->get();
            if ($visits->isNotEmpty()) {
                $initialVisit = $visits->first();
                $user->initial_visit_id = $initialVisit->id;
                $user->save();
                \App\Models\Visit::whereIn('id', $visits->pluck('id'))->update(['user_id' => $user->id]);
            }
        }

        // 4. Логика выдачи курса по умолчанию
        $defaultCourseId = \App\Models\Setting::where('key', 'default_course_id')->first()?->value;
        if ($defaultCourseId) {
            if (!$user->courses()->where('course_id', $defaultCourseId)->exists()) {
                $user->courses()->attach($defaultCourseId);
            }
        }

        // 5. Условная отправка письма для верификации
        $isMailConfigured = config('mail.mailer') === 'smtp' &&
            !empty(config('mail.host')) &&
            !empty(config('mail.username')) &&
            !empty(config('mail.password'));

        if ($isMailConfigured) {
            event(new Registered($user));
        } else {
            $user->markEmailAsVerified();
        }

        // 6. Авторизация пользователя и перенаправление
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
