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
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /**
     * Обрабатывает запрос на регистрацию.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // --- ИСПРАВЛЕНО: Читаем настройку из БД ---
        $defaultCourseId = \App\Models\Setting::where('key', 'default_course_id')->first()->value;
        // Если настройка задана, выдаем доступ
        if ($defaultCourseId) {
            $user->courses()->attach($defaultCourseId);
        }
        // --- КОНЕЦ ИСПРАВЛЕНИЯ ---


        // Привязываем курс к только что созданному пользователю.
        $user->courses()->attach($defaultCourseId);
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
