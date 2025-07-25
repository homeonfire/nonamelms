<x-landing-layout>
    {{-- Секция "Герой" (Hero Section) --}}
    <section class="relative py-24 md:py-32">
        <div class="absolute inset-0 bg-gradient-to-b from-custom-accent/10 to-transparent"></div>
        <div class="container mx-auto text-center px-4 relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-custom-text-primary-light dark:text-custom-text-primary-dark leading-tight">
                NoName LMS: Ваша Open Source платформа для обучения
            </h1>
            <p class="mt-6 text-lg text-custom-text-secondary-light dark:text-custom-text-secondary-dark max-w-3xl mx-auto">
                Получите полный контроль над образовательным процессом. NoName LMS — это готовое решение с открытым исходным кодом, которое вы можете свободно использовать, дорабатывать и масштабировать под любые задачи без ограничений.
            </p>

            {{-- ИЗМЕНЕНО: Блок с новыми кнопками --}}
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://github.com/aifire-team/aifire-lms-academy" {{-- <-- Укажите здесь вашу ссылку на GitHub --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-white bg-gray-800 dark:bg-white dark:text-gray-900 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.168 6.839 9.492.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.03 1.595 1.03 2.688 0 3.848-2.338 4.695-4.566 4.942.359.308.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd" /></svg>
                    GitHub
                </a>
                <a href="mailto:youremail@example.com" {{-- <-- Укажите здесь ваш email --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg hover:bg-gray-100 dark:hover:bg-custom-border-dark transition-colors">
                    Связь с разработчиком
                </a>
            </div>

        </div>
    </section>


    {{-- Новая, подробная секция "Возможности платформы" --}}
    {{-- НОВАЯ, ПОДРОБНАЯ СЕКЦИЯ "ВОЗМОЖНОСТИ ПЛАТФОРМЫ" --}}
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
    {{-- НОВЫЙ БЛОК: Получить демо-доступ --}}
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
                <span class="font-semibold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 py-2 px-4 rounded-lg">MySQL</span>
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
            {{-- ИЗМЕНЕНО: Блок с новыми кнопками --}}
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://github.com/aifire-team/aifire-lms-academy" {{-- <-- Укажите здесь вашу ссылку на GitHub --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-white bg-gray-800 dark:bg-white dark:text-gray-900 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.168 6.839 9.492.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.031-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.03 1.595 1.03 2.688 0 3.848-2.338 4.695-4.566 4.942.359.308.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.001 10.001 0 0022 12c0-5.523-4.477-10-10-10z" clip-rule="evenodd" /></svg>
                    GitHub
                </a>
                <a href="mailto:youremail@example.com" {{-- <-- Укажите здесь ваш email --}}
                class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-lg font-semibold text-custom-text-primary-light dark:text-custom-text-primary-dark bg-custom-container-light dark:bg-custom-container-dark border border-custom-border-light dark:border-custom-border-dark rounded-lg hover:bg-gray-100 dark:hover:bg-custom-border-dark transition-colors">
                    Связь с разработчиком
                </a>
            </div>
        </div>
    </section>
</x-landing-layout>
