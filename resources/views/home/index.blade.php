@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="home-page__first home-first__block">
        <div class="home-first__container">
            <div class="home-first__row">
                <div class="home-first__item">
                    <div class="home-first__title">Современные модульные здания под ваши задачи</div>
                    <div class="home-first__subtitle">Модульные дома, бани и киоски — под ключ.<br> Быстрое изготовление на собственном производстве<br> и адаптация проекта под ваши требования.</div>
                    <div class="home-first__button">
                        <a href="{{ route('catalog.categories') }}" class="home-first__btn btn__yellow">Перейти в каталог</a>
                        <a href="#callback" class="home-first__btn btn__green open-popup-link">МНЕ НУЖНА КОНСУЛЬТАЦИЯ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-page__services home-services__block">
        <div class="home-services__container">
            <div class="home-services__title">Наши услуги</div>
            <div class="home-services__row">
                @foreach($categories as $category)
                    <div class="home-services__item">
                        <a href="{{ url('/catalog/' . $category->slug) }}" class="services-img__link">
                            <img
                                src="{{ $category->image ? asset('storage/' . $category->image) : asset('img/services/img-services__01.jpg') }}"
                                alt="{{ $category->name }}"
                                class="services-item__img"
                                loading="lazy"
                            >
                        </a>

                        <div class="services-title__block">
                            <div class="services-item__num">
                                {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="services-item__title">
                                <a href="{{ url('/catalog/' . $category->slug) }}" class="services-item__link">
                                    {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="home-services__item house-item__callback">
                    <div class="house-callback__title">Не нашли то, что надо?</div>
                    <div class="house-callback__subtitle">Оставьте заявку и мы постараемся Вам помочь</div>
                    <div class="house-callback__button">
                        <a href="#callback" class="house-callback__send open-popup-link">Связаться с нами</a>
                        <span class="house-callback__icon"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-page__calculation home-calculation__block">
        <div class="home-calculation__container">
            <div class="home-calculation__row">
                <div class="home-calculation__item">
                    <div class="calculation-item__title">
                        Наша компания специализируется на <strong>проектировании и производстве модульных (каркасных) строений</strong> различного назначения — от дачных домиков и бытовок <strong>до полноценных жилых и коммерческих решений</strong>. Мы уверены, что комфорт и надежность должны быть доступными, а строительство — быстрым и удобным.
                    </div>
                    <div class="calculation-item__subtitle">
                        <p>Одно из ключевых направлений нашей деятельности — производство кабин для тракторов МТЗ-80/82. Мы предлагаем как малые, так и большие модификации кабин, разработанные с учётом эргономики, безопасности и долговечности. Конструкции адаптированы к различным условиям эксплуатации и полностью соответствуют современным стандартам.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-page__catalog home-catalog__block">
        <div class="home-catalog__container">
            <div class="home-catalog__title">
                Популярная продукция
            </div>
            <div class="tabs__content">
                <div class="home-catalog__tabs _active" id="all">
                    <div class="home-catalog__row">
                        @foreach($popularProducts as $product)
                            <div class="home-catalog__item">
                                <img
                                    src="{{ $product->cover_image ? asset('storage/' . $product->cover_image) : asset('assets/img/catalog/img-project__01.jpg') }}"
                                    alt="{{ $product->name }}"
                                    class="catalog-item__img"
                                    loading="lazy"
                                >

                                <p class="catalog-item__title">{{ $product->name }}</p>

                                <div class="catalog-item__price">
                                    <p class="catalog-price__name">Стоимость:</p>

                                    @if(!is_null($product->price))
                                        <p class="catalog-price__value">
                                            от <span>{{ rtrim(rtrim(number_format($product->price, 2, '.', ''), '0'), '.') }}</span> BYN
                                        </p>
                                    @else
                                        <p class="catalog-price__value">
                                            <span>по запросу</span>
                                        </p>
                                    @endif
                                </div>

                                <div class="catalog-button__block">
                                    <div class="button-block__button">
                                        <a
                                            href="{{ url('/catalog/' . $product->category->slug . '/' . $product->slug) }}"
                                            class="button-more__link btn__green"
                                        >
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
