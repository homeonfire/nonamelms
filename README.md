![Логотип проекта](https://github.com/homeonfire/nonamelms/blob/main/preview.png)
# NoName LMS - Open Source LMS на Laravel

**NoName LMS** — это полнофункциональная, готовая к использованию LMS-платформа (Learning Management System) с открытым исходным кодом. Она создана для тех, кто хочет запустить свою собственную онлайн-школу или образовательный проект с полным контролем над кодом и без ограничений по количеству пользователей или курсов.

Платформа построена на современных технологиях, легко расширяется и кастомизируется под любые задачи.

## 🚀 Ключевые возможности

### Для студентов:

* **Современный интерфейс:** Чистый, адаптивный дизайн с поддержкой светлой и темной тем.
* **Дашборд:** Персональная страница с разделением на "Мои курсы" и "Рекомендации".
* **Просмотр уроков:** Удобный плеер с поддержкой видео с YouTube, Kinescope и Rutube, а также отображение форматированного текстового контента, созданного в Editor.js.
* **Интерактивные ДЗ:** Студенты могут сдавать домашние задания, получать вердикт ("Принято" / "Отклонено") и комментарии от преподавателя, а также пересдавать работы.
* **Отслеживание прогресса:**
    * Автоматическое завершение урока после принятия ДЗ.
    * Ручное завершение уроков без ДЗ.
    * Динамический прогресс-бар на карточках курсов и на странице курса.
    * Визуальные отметки (галочки) у пройденных уроков.
* **"Умные" ссылки:** Платформа запоминает последний просмотренный урок и возвращает пользователя прямо к нему.
* **Страница "Мои ответы":** Централизованное место для отслеживания статуса всех сданных домашних заданий.

### Для администраторов:

* **Полноценная админ-панель:** Отдельный, защищенный интерфейс для управления всей платформой.
* **Управление курсами (CRUD):** Создание, редактирование и удаление курсов с указанием названия, описания и уровня сложности.
* **Управление структурой курса:** Визуальный интерфейс для добавления, редактирования и удаления модулей и уроков.
* **Мощный редактор контента:** Использование **Editor.js** для создания уроков с заголовками, списками, кодом, изображениями, таблицами, цитатами, предупреждениями и прикрепленными файлами.
* **Управление домашними заданиями:** Создание ДЗ с несколькими вопросами для любого урока.
* **Проверка ДЗ:** Удобный интерфейс для проверки работ, оставления комментариев и вынесения вердикта ("Принять" / "Отклонить").
* **Управление пользователями (CRUD):**
    * Ручное создание пользователей.
    * **Импорт пользователей из XLSX-файла** с возможностью автоматической выдачи доступа к курсам.
    * Редактирование данных и смена ролей (Пользователь/Администратор).
* **Управление категориями (CRUD):** Создание и редактирование категорий для курсов.
* **Управление статическими страницами:** Создание и редактирование страниц (например, "Политика конфиденциальности") через Editor.js.

## 🛠️ Технологический стек

* **Бэкенд:** Laravel 12
* **Фронтенд:** Tailwind CSS
* **UI-компоненты:** Flowbite
* **Редактор контента:** Editor.js
* **База данных:** MySQL
* **Среда разработки:** Laragon

## ⚙️ Установка и запуск

1.  **Клонировать репозиторий:**

    ```bash
    git clone https://github.com/homeonfire/nonamelms yoursite.name
    cd yoursite.name
    ```

2.  **Установить PHP-зависимости:**

    ```bash
    composer install
    ```

3.  **Настроить окружение:**

    * Скопируйте файл `.env.example` в `.env`:
      ```bash
      cp .env.example .env
      ```
    * Сгенерируйте ключ приложения:
      ```bash
      php artisan key:generate
      ```
    * Откройте файл `.env` и настройте подключение к вашей базе данных (имя БД, пользователь, пароль).

4.  **Создать таблицы в базе данных:**
    Выполните миграции для создания всех необходимых таблиц.

    ```bash
    php artisan migrate
    ```

5.  **Установить Frontend-зависимости:**

    ```bash
    npm install
    ```

6.  **Скомпилировать стили и скрипты:**

    ```bash
    npm run dev
    ```

7.  **Назначить себе роль администратора:**

    * Зарегистрируйтесь на сайте через стандартную форму.
    * Выполните SQL-запрос в вашей базе данных, заменив email на свой:
      ```sql
      UPDATE `users` SET `role` = 'admin' WHERE `email` = 'ваш_email@example.com';
      ```

8.  **Готово\!** Ваш проект доступен по локальному адресу (например, `http://aifire-lms.test`).

## 📖 Использование

* **Пользовательская часть:** Доступна по корневому URL.
* **Админ-панель:** Доступна по адресу `/admin`. Ссылка на нее также появится в боковом меню, если вы вошли под аккаунтом администратора.
