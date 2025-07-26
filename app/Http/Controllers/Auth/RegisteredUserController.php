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

        // --- НАЧАЛО НОВОЙ ЛОГИКИ ---
        $visitorId = $request->cookie('visitor_id');
        if ($visitorId) {
            // Находим все визиты этого анонимного посетителя
            $visits = \App\Models\Visit::where('visitor_id', $visitorId)->whereNull('user_id')->orderBy('created_at', 'asc')->get();

            if ($visits->isNotEmpty()) {
                // Находим самый первый визит и сохраняем его как "первичный источник"
                $initialVisit = $visits->first();
                $user->initial_visit_id = $initialVisit->id;
                $user->save();

                // Привязываем все его визиты (включая первый) к новому user_id
                \App\Models\Visit::whereIn('id', $visits->pluck('id'))->update(['user_id' => $user->id]);
            }
        }
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        // --- НАЧАЛО ФИНАЛЬНОГО ИСПРАВЛЕНИЯ ---
        $defaultCourseId = \App\Models\Setting::where('key', 'default_course_id')->first()?->value;

        if ($defaultCourseId) {
            // ПРОВЕРЯЕМ, НЕ ПРИВЯЗАН ЛИ УЖЕ ЭТОТ КУРС К ПОЛЬЗОВАТЕЛЮ
            if (!$user->courses()->where('course_id', $defaultCourseId)->exists()) {
                // Если не привязан, привязываем
                $user->courses()->attach($defaultCourseId);
            }
        }
        // --- КОНЕЦ ФИНАЛЬНОГО ИСПРАВЛЕНИЯ ---

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
