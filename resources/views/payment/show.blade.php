<x-payment-layout>
    <div class="container mx-auto max-w-2xl px-4">
        {{-- Карточка курса --}}
        <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-8">
            <h1 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">{{ $course->title }}</h1>
            <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">{{ $course->description }}</p>
            <p class="text-4xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark mt-6">{{ $course->price }} ₽</p>
        </div>

        <form id="payment-form" action="{{ route('payment.process', $course) }}" method="POST" class="mt-8">
            @csrf

            {{-- Эта форма показывается только для ГОСТЕЙ --}}
            @guest
                <div class="bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg p-8 mb-8 space-y-4">
                    <h2 class="text-2xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Ваши данные</h2>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Имя и Фамилия</label>
                        <input type="text" name="name" id="name" class="bg-custom-background-light dark:bg-custom-background-dark ... w-full" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Email</label>
                        <input type="email" name="email" id="email" class="bg-custom-background-light dark:bg-custom-background-dark ... w-full" required>
                    </div>
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Телефон</label>
                        <input type="tel" name="phone" id="phone" class="bg-custom-background-light dark:bg-custom-background-dark ... w-full" required>
                    </div>
                </div>

                {{-- Галочки для ГОСТЕЙ --}}
                <div class="space-y-4 mb-8">
                    <label class="flex items-center"><input type="checkbox" id="terms" name="terms" required class="w-4 h-4 text-custom-accent ..."><span class="ms-2 text-sm">Я согласен с <a href="#" class="underline">условиями оферты</a></span></label>
                    <label class="flex items-center"><input type="checkbox" id="policy" name="policy" required class="w-4 h-4 text-custom-accent ..."><span class="ms-2 text-sm">Я согласен с <a href="/pages/politika-konfidencialnosti" class="underline">политикой конфиденциальности</a></span></label>
                </div>
            @endguest

            {{-- Кнопка оплаты --}}
            <button type="submit" id="submit-button" class="w-full px-5 py-3 text-lg font-semibold text-white bg-custom-accent rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                Оплатить через LeadPay
            </button>
        </form>
    </div>

    {{-- Скрипт для активации кнопки --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit-button');

            // Если мы гость, то кнопка изначально выключена
            @guest
                submitButton.disabled = true;
            @endguest

            function checkFormValidity() {
                const name = form.querySelector('#name');
                const email = form.querySelector('#email');
                const phone = form.querySelector('#phone');
                const terms = form.querySelector('#terms');
                const policy = form.querySelector('#policy');

                // Если мы гость, проверяем все поля. Если нет - кнопка всегда активна.
                const isGuestFormValid = !name || (name.value.trim() !== '' && email.value.trim() !== '' && phone.value.trim() !== '' && terms.checked && policy.checked);

                submitButton.disabled = !isGuestFormValid;
            }

            form.addEventListener('input', checkFormValidity);
            form.addEventListener('change', checkFormValidity);
        });
    </script>
</x-payment-layout>
