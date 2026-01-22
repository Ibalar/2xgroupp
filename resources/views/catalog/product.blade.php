@extends('layouts.app')

@section('title', $product->name . ' — ' . $category->name)

@section('content')

    @include('partials.breadcrumbs', ['title' => $product->name])


    <section class="slider">
        <div class="product-slider__container">
            <div class="slider__flex">
                <div class="slider__images">
                    @if(!empty($product->gallery_images))
                        <div class="slider__images">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($product->gallery_images as $img)
                                        @php
                                            $full = asset('storage/' . $img);
                                        @endphp

                                        <div class="swiper-slide">
                                            <div class="slider__image">
                                                <a href="{{ $full }}" class="image-popup">
                                                    <img src="{{ $full }}" alt="{{ $product->name }}" />
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="swiper-pagination"></div>

                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    @endif

                </div>


                <div class="slider__info">
                    <div class="product-info__title">{{ $product->name }}</div>
                    @if(!is_null($product->price))
                        <div class="product-info__price">
                            <strong>Стоимость:</strong>
                            <span> от {{ rtrim(rtrim(number_format($product->price, 2, '.', ''), '0'), '.') }} BYN </span>
                        </div>
                    @endif

                    @if($product->short_description)
                        <div class="product-info__srok">
                            {{ $product->short_description }}
                        </div>
                    @endif

                    <div class="product-info__button"><a href="#callback" class="button-more__link btn__green open-popup-link">Получить консультацию</a></div>
                </div>
            </div>
        </div>
    </section>

    @if($product->hasVideo())
        <section class="product-video__block">
            <div class="product-video__container">
                <h2 class="product-video__title">Видеопрезентация</h2>
                
                @if($product->video_type === 'youtube')
                    <div class="product-video__wrapper product-video__youtube">
                        <iframe 
                            class="product-video__iframe"
                            src="{{ $product->getYoutubeEmbedUrl() }}"
                            title="{{ $product->name }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @elseif($product->video_type === 'file')
                    <div class="product-video__wrapper product-video__file">
                        <video 
                            class="product-video__player"
                            controls
                            poster="{{ $product->cover_image ? asset('storage/' . $product->cover_image) : asset('img/default-video-poster.jpg') }}"
                        >
                            <source src="{{ $product->getVideoUrl() }}" type="video/mp4">
                            Ваш браузер не поддерживает HTML5 видео.
                        </video>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <section class="product-page__characteristic product-characteristic__block">
        <div class="product-characteristic__container">
            <div class="product-characteristic__row">
                <div class="product-characteristic__row">
                    <div class="product-description__col">
                        @if($product->description)

                                {!! $product->description !!}

                        @endif
                    </div>
                </div>
            </div>

            <div class="page-services__item page-item__callback">
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
