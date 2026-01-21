@extends('layouts.app')

@section('title', $finishingType->name)

@section('content')

    @include('partials.breadcrumbs', ['title' => $finishingType->name])

    <section class="slider">
        <div class="product-slider__container">
            <div class="slider__flex">
                <div class="slider__images">
                    <div class="slider__image">
                        <img 
                            src="{{ $finishingType->image ? asset('storage/' . $finishingType->image) : asset('img/services/img-services__01.jpg') }}" 
                            alt="{{ $finishingType->name }}" 
                            style="max-width: 100%; height: auto; border-radius: 8px;"
                            loading="eager"
                        >
                    </div>
                </div>

                <div class="slider__info">
                    <div class="product-info__title">{{ $finishingType->name }}</div>
                    
                    <div class="product-info__srok" style="margin: 20px 0;">
                        Тип отделки: {{ $finishingType->type === 'internal' ? 'Внутренняя' : 'Наружная' }}
                    </div>

                    <div class="product-info__button">
                        <a href="#callback" class="button-more__link btn__green open-popup-link">Заказать консультацию</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-page__characteristic product-characteristic__block">
        <div class="product-characteristic__container">
            <div class="product-characteristic__row">
                <div class="product-description__col" style="width: 100%;">
                    @if($finishingType->description)
                        <div class="product-description__text">
                            {!! $finishingType->description !!}
                        </div>
                    @endif
                </div>
            </div>

            @if($similar->isNotEmpty())
                <div class="similar-types" style="margin-top: 50px;">
                    <h3 class="home-services__title" style="margin-bottom: 30px;">Похожие виды отделки</h3>
                    <div class="home-services__row">
                        @foreach($similar as $item)
                            <div class="home-services__item">
                                <a href="{{ route('finishing.show', ['type' => $item->type, 'finishingType' => $item->id]) }}" class="services-img__link">
                                    <img
                                        src="{{ $item->image ? asset('storage/' . $item->image) : asset('img/services/img-services__01.jpg') }}"
                                        alt="{{ $item->name }}"
                                        class="services-item__img"
                                        loading="lazy"
                                    >
                                </a>

                                <div class="services-title__block">
                                    <div class="services-item__title">
                                        <a href="{{ route('finishing.show', ['type' => $item->type, 'finishingType' => $item->id]) }}" class="services-item__link">
                                            {{ $item->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="page-services__item page-item__callback" style="margin-top: 50px;">
                <div class="page-callback__title">Есть вопросы?</div>
                <div class="page-callback__subtitle">Оставьте заявку или позвоните нам по телефонам <a class="page-callback__link" href="tel:+375296775181">+375 (29) 677-51-81</a> или <a class="page-callback__link" href="tel:+375296821217">+375 (29) 682-12-17</a></div>
                <div class="page-callback__button">
                    <a href="#callback" class="page-callback__send btn__green open-popup-link">Связаться с нами</a>
                    <span class="page-callback__icon"></span>
                </div>
            </div>

        </div>
    </section>

@endsection
