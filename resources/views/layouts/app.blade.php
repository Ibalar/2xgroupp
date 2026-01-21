<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Корпоративный сайт')</title>
    <meta name="description" content="@yield('meta_description', '')">

    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

</head>
<body id="home">
    <div class="wrapper">
        @include('partials.header')

        <main class="page">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>
    <div id="callback" class="black-popup mfp-hide decor">
        <div class="form-block__subtitle">Заказать консультацию</div>
        <form action="#" method="post" class="contact-form__row">
            <div class="contact-form__item">
                <label for="name" class="contact-form__label">Введите ваше имя:</label>
                <input type="text" placeholder="Иван Иванов" name="name" id="name" class="contact-form__input" required>
            </div>
            <div class="contact-form__item">
                <label for="phone" class="contact-form__label">Введите ваш телефон:</label>
                <input type="text" placeholder="+375 (29) 123-45-67" name="phone" id="phone" data-mask="+375 (99) 999-99-99" class="contact-form__input" required>
            </div>
            <div >
                <button class="service-button__send animate__animated animate__pulse animate__infinite" type="submit">ЗАКАЗАТЬ</button>
            </div>
        </form>
        <div class="contact-form__offer">
            Нажимая на кнопку, вы даете согласие на обработку своих персональных данных
        </div>
    </div>

    <script src="https://api-maps.yandex.ru/2.0/?apikey=1e447194-5fb1-4596-84bc-f10e4f0b759f&load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')


</body>
</html>

