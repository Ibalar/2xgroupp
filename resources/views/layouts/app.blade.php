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

    @include('partials.cookie-consent')

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

            <div class="contact-form__item contact-form__checkbox">
                <label class="contact-form__checkbox-label">
                    <input type="checkbox" name="privacy_agreed" id="privacy_agreed" class="contact-form__checkbox-input" required>
                    <span class="contact-form__checkbox-text">
                        Я согласен с
                        <a href="/privacy-policy" target="_blank" class="contact-form__link">политикой конфиденциальности</a>
                    </span>
                </label>
                <span class="error-message privacy_agreed-error" style="color: red; font-size: 12px;"></span>
            </div>
            <div class="contact-form__offer">
                <button class="service-button__send animate__animated animate__pulse animate__infinite" type="submit">ЗАКАЗАТЬ</button>
            </div>
        </form>

    </div>

    <script src="https://api-maps.yandex.ru/2.0/?apikey=1e447194-5fb1-4596-84bc-f10e4f0b759f&load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        // ===== COOKIE CONSENT MANAGEMENT =====
        const cookieConsent = {
            STORAGE_KEY: 'cookie_consent_accepted',
            EXPIRY_DAYS: 30,

            init() {
                const bannerElement = document.getElementById('cookie-consent');
                const acceptBtn = document.getElementById('cookie-accept');
                const rejectBtn = document.getElementById('cookie-reject');

                if (this.hasConsented()) {
                    if (bannerElement) {
                        bannerElement.classList.add('hidden');
                    }
                    return;
                }

                if (bannerElement) {
                    bannerElement.classList.remove('hidden');
                }

                if (acceptBtn) {
                    acceptBtn.addEventListener('click', () => this.accept());
                }

                if (rejectBtn) {
                    rejectBtn.addEventListener('click', () => this.reject());
                }
            },

            hasConsented() {
                return localStorage.getItem(this.STORAGE_KEY) === 'true';
            },

            accept() {
                localStorage.setItem(this.STORAGE_KEY, 'true');
                this.setCookie('cookie_consent', 'accepted', this.EXPIRY_DAYS);
                const bannerElement = document.getElementById('cookie-consent');
                if (bannerElement) {
                    bannerElement.classList.add('hidden');
                }
            },

            reject() {
                localStorage.setItem(this.STORAGE_KEY, 'rejected');
                const bannerElement = document.getElementById('cookie-consent');
                if (bannerElement) {
                    bannerElement.classList.add('hidden');
                }
            },

            setCookie(name, value, days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                const expires = 'expires=' + date.toUTCString();
                document.cookie = name + '=' + value + ';' + expires + ';path=/';
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            cookieConsent.init();
        });

        // ===== CONTACT FORM SUBMISSION =====
        document.querySelector('.contact-form__row')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');

            // Clear previous errors
            form.querySelectorAll('.error-message').forEach(span => span.textContent = '');

            // Проверка чекбокса на фронте
            const privacyCheckbox = form.querySelector('input[name="privacy_agreed"]');
            if (!privacyCheckbox || !privacyCheckbox.checked) {
                const errorSpan = form.querySelector('.privacy_agreed-error');
                if (errorSpan) {
                    errorSpan.textContent = 'Вы должны согласиться с политикой конфиденциальности';
                }
                return;
            }

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

