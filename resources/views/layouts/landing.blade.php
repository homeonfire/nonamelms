<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{-- Если дочерняя страница передала свой заголовок, используем его --}}
        @if (isset($title))
            {{ $title }} | {{ config('app.name', 'NoName LMS') }}
            {{-- В противном случае, используем заголовок по умолчанию --}}
        @else
            NoName LMS — Open Source LMS на Laravel | Платформа для онлайн курсов
        @endif
    </title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="NoName LMS — это бесплатная, полнофункциональная LMS-платформа на Laravel с открытым исходным кодом. Запустите свою онлайн-школу с современным интерфейсом, управлением курсами и поддержкой видеоуроков. Без ограничений по пользователям и курсам.">
    <meta name="keywords" content="LMS, онлайн-школа, аналог GetCourse, аналог геткурс, образовательная платформа, курсы, домашние задания, видеокурсы, управление обучением, бесплатная LMS">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=103490440', 'ym');

        ym(103490440, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/103490440" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body class="font-sans antialiased bg-custom-background-light dark:bg-custom-background-dark">
{{-- Шапка сайта --}}
<header class="p-4">
    <nav class="container mx-auto flex justify-between items-center">
        <a href="{{ route('landing') }}" class="text-xl font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">
            NoName LMS
        </a>
        <a href="{{ route('blog.index') }}" class="text-lg font-bold text-custom-text-primary-light dark:text-custom-text-primary-dark">Блог</a>
        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Demo</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Войти</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Регистрация</a>
                @endif
            @endauth
        </div>
    </nav>
</header>

{{-- Основной контент страницы --}}
<main>
    {{ $slot }}
</main>

{{-- Футер --}}
<footer class="p-4 mt-16 text-center text-custom-text-secondary-light dark:text-custom-text-secondary-dark">
    © {{ date('Y') }} NoName LMS. Все права защищены.
</footer>
</body>
</html>
