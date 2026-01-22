@extends('layouts.app')

@section('title', $finishingType->name)

@section('content')
    @include('partials.breadcrumbs', ['title' => $finishingType->name])

    <section class="finishing-show__block">
        <div class="finishing-show__container">
            <div class="finishing-show__row">
                <div class="finishing-show__content">
                    <h1 class="finishing-show__title">{{ $finishingType->name }}</h1>

                    @if(!empty($finishingType->gallery_images))
                        <div class="finishing-gallery__wrapper">
                            <div class="swiper finishing-gallery-slider">
                                <div class="swiper-wrapper">
                                    @foreach($finishingType->gallery_images as $image)
                                        <div class="swiper-slide finishing-gallery__slide">
                                            <img
                                                src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $finishingType->name }}"
                                                class="finishing-gallery__image"
                                                loading="eager"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev finishing-gallery__prev"></div>
                                <div class="swiper-button-next finishing-gallery__next"></div>
                                <div class="swiper-pagination finishing-gallery__pagination"></div>
                            </div>
                        </div>
                    @else
                        <div class="finishing-gallery__placeholder">
                            <p>Изображения не загружены</p>
                        </div>
                    @endif

                    @if($finishingType->description)
                        <div class="finishing-show__description">
                            {!! $finishingType->description !!}
                        </div>
                    @endif

                    <div class="finishing-show__cta">
                        <a href="#callback" class="finishing-show__button open-popup-link">
                            Заказать консультацию
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($similar->count() > 0)
        <section class="home-page__services home-services__block">
            <div class="home-services__container">
                <div class="home-services__title">Похожие виды отделки</div>
                <div class="home-services__row">
                    @foreach($similar as $item)
                        <div class="home-services__item">
                            <a href="{{ route('finishing.show', ['type' => $item->type, 'finishingType' => $item->id]) }}" class="services-img__link">
                                <img
                                    src="{{ $item->first_image ? asset('storage/' . $item->first_image) : asset('img/services/img-services__01.jpg') }}"
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
        </section>
    @endif

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация слайдера галереи
            const gallerySlider = document.querySelector('.finishing-gallery-slider');
            if (gallerySlider) {
                new Swiper(gallerySlider, {
                    slidesPerView: 1,
                    loop: true,
                    pagination: {
                        el: '.finishing-gallery__pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: '.finishing-gallery__next',
                        prevEl: '.finishing-gallery__prev',
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                });
            }
        });
    </script>
    @endpush

@endsection