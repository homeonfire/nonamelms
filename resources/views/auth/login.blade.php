<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-custom-text-secondary">Email адрес</label>
            <input type="email" name="email" id="email" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" placeholder="name@company.com" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block mb-2 text-sm font-medium text-custom-text-secondary">Пароль</label>
            <input type="password" name="password" id="password" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-custom-container border-custom-border text-custom-accent shadow-sm focus:ring-custom-accent" name="remember">
                <span class="ml-2 text-sm text-custom-text-secondary">Запомнить меня</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-custom-text-secondary hover:text-custom-text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif

            <button type="submit" class="ml-3 text-white bg-custom-accent hover:bg-custom-accent-hover focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Войти
            </button>
        </div>
    </form>
</x-guest-layout>
