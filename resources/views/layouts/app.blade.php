<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Корпоративный сайт')</title>
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <form action="{{ route('contact.store') }}" method="post" class="contact-form__row">
            @csrf
            <div class="contact-form__item">
                <label for="name" class="contact-form__label">Введите ваше имя:</label>
                <input type="text" placeholder="Иван Иванов" name="name" id="name" class="contact-form__input" required>
                <span class="error-message name-error" style="color: red; font-size: 12px;"></span>
            </div>
            <div class="contact-form__item">
                <label for="phone" class="contact-form__label">Введите ваш телефон:</label>
                <input type="text" placeholder="+375 (29) 123-45-67" name="phone" id="phone" data-mask="+375 (99) 999-99-99" class="contact-form__input" required>
                <span class="error-message phone-error" style="color: red; font-size: 12px;"></span>
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
    <script>
        document.querySelector('.contact-form__row')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            
            // Clear previous errors
            form.querySelectorAll('.error-message').forEach(span => span.textContent = '');
            
            try {
                submitButton.disabled = true;
                
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok) {
                    alert(data.message);
                    form.reset();
                    // Close popup if applicable (depends on the library used, e.g., Magnific Popup)
                    if (window.jQuery && jQuery.magnificPopup) {
                        jQuery.magnificPopup.close();
                    }
                } else if (response.status === 422) {
                    Object.entries(data.errors || {}).forEach(([field, messages]) => {
                        const errorSpan = form.querySelector(`.${field}-error`);
                        if (errorSpan) {
                            errorSpan.textContent = messages[0];
                        }
                    });
                } else {
                    alert('Произошла ошибка при отправке формы');
                }
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке формы');
            } finally {
                submitButton.disabled = false;
            }
        });
    </script>
    @stack('scripts')


</body>
</html>

