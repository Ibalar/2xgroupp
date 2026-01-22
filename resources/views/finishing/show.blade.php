@extends('layouts.app')

@section('title', $finishingType->name)

@section('content')
    @include('partials.breadcrumbs', [
        'breadcrumbs' => [
            ['url' => route('home'), 'title' => 'Главная'],
            ['url' => route('finishing.index'), 'title' => 'Виды отделки'],
            ['title' => $finishingType->name]
        ]
    ])

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
                                            <a
                                                href="{{ asset('storage/' . $image) }}"
                                                class="finishing-gallery__link"
                                                title="{{ $finishingType->name }}"
                                            >
                                                <img
                                                    src="{{ asset('storage/' . $image) }}"
                                                    alt="{{ $finishingType->name }}"
                                                    class="finishing-gallery__image"
                                                    loading="lazy"
                                                >
                                                <div class="finishing-gallery__overlay">
                                                    <span class="finishing-gallery__zoom-icon">🔍</span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev finishing-gallery__prev"></div>
                                <div class="swiper-button-next finishing-gallery__next"></div>
                            </div>
                            <div class="swiper-pagination finishing-gallery__pagination"></div>
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
                        <a href="#callback" class="btn btn__green open-popup-link">
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
                                    src="{{ $item->first_image ? asset('storage/' . $item->first_image) : asset('img/default.jpg') }}"
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
            document.addEventListener('DOMContentLoaded', function () {
                // Инициализация Magnific Popup для галереи
                if (window.jQuery && jQuery.fn.magnificPopup) {
                    jQuery('.finishing-gallery-slider').magnificPopup({
                        delegate: 'a.finishing-gallery__link',
                        type: 'image',
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preloadRange: 1
                        },
                        image: {
                            titleSrc: 'title',
                            cursor: 'mfp-zoom-out-cur'
                        },
                        zoom: {
                            enabled: true,
                            duration: 300
                        }
                    });
                }

                // Инициализация слайдера галереи
                const gallerySlider = document.querySelector('.finishing-gallery-slider');
                if (gallerySlider) {
                    new Swiper(gallerySlider, {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        loop: true,
                        pagination: {
                            el: '.finishing-gallery__pagination',
                            clickable: true,
                            dynamicBullets: false,
                        },
                        navigation: {
                            nextEl: '.finishing-gallery__next',
                            prevEl: '.finishing-gallery__prev',
                        },
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        breakpoints: {
                            768: {
                                slidesPerView: 1,
                            },
                            1024: {
                                slidesPerView: 1,
                            },
                            1200: {
                                slidesPerView: 2,
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
