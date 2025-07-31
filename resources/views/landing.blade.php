<x-landing-layout>
    {{-- Секция "Герой" (Hero Section) --}}
    {{-- Секция "Герой" с видео на фоне --}}
    <section class="relative h-[60vh] md:h-[80vh] flex items-center justify-center text-center overflow-hidden">
        {{-- Видео-фон --}}
        <div class="absolute top-0 left-0 w-full h-full z-0">
            <video autoplay loop muted playsinline class="w-full h-full object-cover">
                <source src="{{ asset('videos/hero-video.mp4') }}" type="video/mp4">
                Ваш браузер не поддерживает видео.
            </video>
            {{-- Затемняющий оверлей для читаемости текста --}}
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        {{-- Контент поверх видео --}}
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                NoName LMS: Ваша Open Source платформа для онлайн курсов
            </h1>
            <p class="mt-6 text-lg text-gray-200 max-w-3xl mx-auto">
                Получите полный контроль над образовательным процессом. NoName LMS — это готовое решение с открытым исходным кодом, которое вы можете свободно использовать, дорабатывать и масштабировать под любые задачи без ограничений.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://github.com/homeonfire/nonamelms"
                   class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-gray-900 bg-white rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.168 6.839 9.492.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.03 1.595 1.03 2.688 0 3.848-2.338 4.695-4.566 4.942.359.308.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd"></path></svg>
                    GitHub
                </a>
                <a href="https://t.me/igreskiv"
                   class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-white bg-white/10 border border-white/20 rounded-lg hover:bg-white/20 transition-colors">
                    Связь с разработчиком
                </a>
            </div>
        </div>
    </section>
    {{-- ЗАДАЧА 1: Блок, объясняющий концепцию "Open Source" --}}
    <section class="py-20 bg-custom-container-light dark:bg-custom-container-dark">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Ваша платформа. Ваши правила.</h2>
                <p class="mt-3 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Представьте, что вы выбираете помещение для своей школы.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Карточка SaaS --}}
                <div class="p-8 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <h3 class="text-2xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">SaaS-платформы (GetCourse и др.)</h3>
                    <p class="mt-2 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Это как <span class="font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">аренда офиса</span>. Вы платите каждый месяц, можете переставлять мебель, но не можете снести стену или сделать пристройку. Вы всегда зависите от арендодателя.</p>
                </div>
                {{-- Карточка Open Source --}}
                <div class="p-8 border-2 border-custom-accent rounded-lg bg-custom-accent/5">
                    <h3 class="text-2xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">NoName LMS (Open Source)</h3>
                    <p class="mt-2 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Это как <span class="font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">покупка собственного здания</span>. Вы — полноправный владелец и можете делать что угодно. Это ваш актив, который работает на вас.</p>
                </div>
            </div>
            <div class="mt-12">
                <h4 class="text-2xl font-bold text-center text-custom-text-primary-light dark:text-custom-text-primary-dark mb-6">Что это значит на практике:</h4>
                <ul class="space-y-4 max-w-2xl mx-auto text-custom-text-secondary-light dark:text-custom-text-secondary-dark">
                    <li class="flex items-start gap-3"><span class="text-custom-accent font-bold mt-1">&#10003;</span> <span><b>Никакой ежемесячной платы.</b> Вы устанавливаете систему на свой сервер и платите только за сервер.</span></li>
                    <li class="flex items-start gap-3"><span class="text-custom-accent font-bold mt-1">&#10003;</span> <span><b>Полная собственность данных.</b> Ваша база учеников и контент принадлежат только вам и хранятся на вашем сервере.</span></li>
                    <li class="flex items-start gap-3"><span class="text-custom-accent font-bold mt-1">&#10003;</span> <span><b>Безграничная гибкость.</b> Вы можете доработать любой элемент: от уникального дизайна до интеграции с вашей CRM.</span></li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ЗАДАЧА 2: Блок с сегментацией аудитории (реализован через табы Flowbite) --}}
    <section class="py-20">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Решение для каждого</h2>
                <p class="mt-3 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">NoName LMS создана, чтобы дать свободу и контроль каждому, кто создает онлайн-курсы.</p>
            </div>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2 rounded-t-lg" id="tech-tab" data-tabs-target="#tech" type="button" role="tab" aria-controls="tech" aria-selected="false">Тех. специалистам</button></li>
                    <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2 rounded-t-lg" id="experts-tab" data-tabs-target="#experts" type="button" role="tab" aria-controls="experts" aria-selected="false">Экспертам и авторам</button></li>
                    <li class="me-2" role="presentation"><button class="inline-block p-4 border-b-2 rounded-t-lg" id="producers-tab" data-tabs-target="#producers" type="button" role="tab" aria-controls="producers" aria-selected="false">Продюсерам и школам</button></li>
                </ul>
            </div>
            <div id="myTabContent" class="mt-8">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tech" role="tabpanel" aria-labelledby="tech-tab">
                    <h3 class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Идеальная основа для проектов ваших клиентов.</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Вы получаете чистый, документированный код на современном фреймворке Laravel. Перестаньте бороться с ограничениями чужих API. Создавайте для клиентов по-настоящему кастомные решения.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="experts" role="tabpanel" aria-labelledby="experts-tab">
                    <h3 class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Обретите полную независимость.</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Перестаньте зависеть от платформ, которые в любой момент могут изменить тарифы или заблокировать ваш аккаунт. С NoName LMS вы — единственный владелец своей школы. Ваша база учеников — это ваш самый ценный актив.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="producers" role="tabpanel" aria-labelledby="producers-tab">
                    <h3 class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Масштабируйте бизнес, а не расходы.</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Ваша школа растет? Отлично! С NoName LMS вам не придется платить больше за 1001-го ученика. Развивайте свой бренд, создавая уникальный пользовательский опыт, который невозможен на шаблонных конструкторах.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ЗАДАЧА 3: Блок со сравнительной таблицей --}}
    <section class="py-20 bg-custom-container-light dark:bg-custom-container-dark">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Сравните сами: факты, а не обещания</h2>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3 bg-indigo-50 dark:bg-custom-accent/20">NoName LMS</th>
                        <th scope="col" class="px-6 py-3">ZetCourse</th>
                        <th scope="col" class="px-6 py-3">ProdavanXL</th>
                        <th scope="col" class="px-6 py-3">Zizon365 / Похожие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Модель оплаты</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">Разовая оплата / Бесплатно (DIY)</td>
                        <td class="px-6 py-4">Ежемесячная подписка</td>
                        <td class="px-6 py-4">Ежемесячная подписка</td>
                        <td class="px-6 py-4">Ежемесячная подписка</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Владение данными</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">Полностью у вас</td>
                        <td class="px-6 py-4">На серверах платформы</td>
                        <td class="px-6 py-4">На серверах платформы</td>
                        <td class="px-6 py-4">На серверах платформы</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Кастомизация бренда</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">100% (любой дизайн)</td>
                        <td class="px-6 py-4">Добавление кастомного HTML/CSS/JS</td>
                        <td class="px-6 py-4">Очень ограничена</td>
                        <td class="px-6 py-4">Минимальная</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Лимиты (ученики/курсы)</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">Нет ограничений</td>
                        <td class="px-6 py-4">Зависят от тарифа</td>
                        <td class="px-6 py-4">Зависят от тарифа</td>
                        <td class="px-6 py-4">Зависят от тарифа</td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Возможность доработок</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">Безгранична (открытый код)</td>
                        <td class="px-6 py-4">Невозможна</td>
                        <td class="px-6 py-4">Невозможна</td>
                        <td class="px-6 py-4">Невозможна</td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Ежемесячные расходы</th>
                        <td class="px-6 py-4 font-bold bg-indigo-50 dark:bg-custom-accent/20">Только хостинг (от ~500 ₽/мес)</td>
                        <td class="px-6 py-4">От 5 900 ₽/мес</td>
                        <td class="px-6 py-4">От 2 500 ₽/мес</td>
                        <td class="px-6 py-4">От 1 500 ₽/мес</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ПОДРОБНАЯ СЕКЦИЯ "ВОЗМОЖНОСТИ ПЛАТФОРМЫ" --}}
    <section class="py-20 bg-custom-container-light dark:bg-custom-container-dark border-y border-custom-border-light dark:border-custom-border-dark">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Платформа, продуманная до мелочей</h2>
                <p class="mt-3 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Мы реализовали все ключевые функции, необходимые для запуска и управления современной онлайн-школой.</p>
            </div>

            {{-- Сетка с карточками возможностей --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Карточка 1: Управление курсами --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Полное управление курсами</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Создавайте, редактируйте и удаляйте курсы. Гибко настраивайте структуру, разбивая материал на модули и уроки.</p>
                </div>

                {{-- Карточка 2: Мощный редактор --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Блочный редактор уроков</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Используйте Editor.js для создания насыщенного контента: видео, код, изображения, таблицы, списки, цитаты и прикрепленные файлы.</p>
                </div>

                {{-- Карточка 3: Система ДЗ --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Проверка домашних заданий</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Создавайте ДЗ, проверяйте ответы, оставляйте комментарии и управляйте статусами (Принято / Отклонено).</p>
                </div>

                {{-- Карточка 4: Управление пользователями --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Управление пользователями</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Добавляйте студентов вручную или импортируйте списки из XLSX. Управляйте ролями (Админ/Пользователь) и правами доступа.</p>
                </div>

                {{-- Карточка 5: Система доступов --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Гибкая система доступов</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Назначайте доступ к определенным курсам для каждого пользователя. На дашборде студент видит только те курсы, которые ему доступны.</p>
                </div>

                {{-- Карточка 6: Отслеживание прогресса --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Отслеживание прогресса</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Урок засчитывается после принятия ДЗ или по кнопке. Студенты видят прогресс-бар и всегда возвращаются к последнему уроку.</p>
                </div>

                {{-- Карточка 7: Open Source --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Open Source и Laravel</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Платформа построена на современном фреймворке Laravel, а ее исходный код полностью открыт для ваших доработок и кастомизации.</p>
                </div>

                {{-- Карточка 8: Темы --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Адаптивность и темы</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Платформа отлично выглядит на любых устройствах. Переключатель между светлой и темной темой делает использование еще комфортнее.</p>
                </div>

                {{-- Карточка 9: Безлимит --}}
                <div class="p-6 bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-custom-border-dark rounded-lg">
                    <h3 class="text-xl font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark">Никаких ограничений</h3>
                    <p class="mt-2 text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Система не имеет ограничений по количеству пользователей, курсов, уроков или домашних заданий. Масштабируйтесь без преград.</p>
                </div>

            </div>
        </div>
    </section>
    {{-- БЛОК: Получить демо-доступ --}}
    <section class="py-20 bg-custom-background-light dark:bg-custom-background-dark">
        <div class="container mx-auto px-4">
            <div class="relative bg-custom-accent rounded-lg p-12 text-center overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white">
                        Что будет видеть Ваш ученик?
                    </h2>
                    <p class="mt-4 text-lg text-indigo-200 max-w-2xl mx-auto">
                        Зарегистрируйтесь сейчас и получите бесплатный демо-доступ к просмотру функционала платформы со стороны ученика
                    </p>
                    <a href="{{ route('register') }}"
                       class="inline-block mt-8 px-8 py-3 text-lg font-semibold text-custom-accent bg-white rounded-lg transition-transform hover:scale-105 shadow-lg">
                        Получить демо-доступ
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Секция "Технологический стек" --}}
    <section class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Построено на современных технологиях</h2>
            <p class="mt-2 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark">Мы используем только проверенные и надежные инструменты.</p>
            <div class="mt-8 flex justify-center gap-4 md:gap-8 flex-wrap">
                <span class="font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-lg">Laravel</span>
                <span class="font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-lg">Tailwind CSS</span>
                <span class="font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-lg">Flowbite</span>
                <span class="font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-lg">Editor.js</span>
            </div>
        </div>
    </section>

    {{-- Секция "Призыв к действию" --}}
    <section class="py-20 bg-custom-container-light dark:bg-custom-container-dark">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Готовы начать?</h2>
            <p class="mt-4 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark max-w-2xl mx-auto">
                Скачайте исходный код с GitHub и разверните платформу на своем сервере, или свяжитесь с нами для консультации.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://github.com/homeonfire/nonamelms" {{-- <-- Укажите здесь вашу ссылку на GitHub --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-white bg-gray-800 dark:bg-white dark:text-gray-900 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.168 6.839 9.492.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.03 1.595 1.03 2.688 0 3.848-2.338 4.695-4.566 4.942.359.308.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd" /></svg>
                    GitHub
                </a>
                <a href="https://t.me/igreskiv" {{-- <-- Укажите здесь ваш email --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg hover:bg-gray-100 dark:hover:bg-custom-border-dark transition-colors">
                    Связь с разработчиком
                </a>
            </div>
        </div>
    </section>
</x-landing-layout>
