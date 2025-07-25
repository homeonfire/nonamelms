<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-custom-text-secondary">Имя</label>
            <input type="text" name="name" id="name" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="email" class="block mb-2 text-sm font-medium text-custom-text-secondary">Email адрес</label>
            <input type="email" name="email" id="email" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block mb-2 text-sm font-medium text-custom-text-secondary">Пароль</label>
            <input type="password" name="password" id="password" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-custom-text-secondary">Подтвердите пароль</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-custom-background border border-custom-border text-custom-text-primary text-sm rounded-lg focus:ring-custom-accent focus:border-custom-accent block w-full p-2.5" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4">
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" required class="w-4 h-4 border border-gray-500 rounded bg-gray-700 focus:ring-3 focus:ring-custom-accent">
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-light text-gray-400">Я принимаю <a class="font-medium text-custom-accent hover:underline" href="{{ route('pages.show', 'politika-konfidencialnosti') }}" target="_blank">Политику конфиденциальности</a></label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-custom-text-secondary hover:text-custom-text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                Уже зарегистрированы?
            </a>

            <button type="submit" class="ml-4 text-white bg-custom-accent hover:bg-custom-accent-hover focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Регистрация
            </button>
        </div>
    </form>
</x-guest-layout>
