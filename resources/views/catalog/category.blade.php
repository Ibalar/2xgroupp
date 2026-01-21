@extends('layouts.app')

@section('title', $category->name . ' — Каталог')

@section('content')

    @include('partials.breadcrumbs', ['title' => $category->name])



    <section class="home-page__catalog home-catalog__block">
        <div class="home-catalog__container">

             @if($products->isEmpty())
                <div class="home-catalog__title">
                    Товаров в категории пока нет.
                </div>
            @else
                <div class="tabs__content">
                    <div class="home-catalog__tabs _active" id="all">
                        <div class="home-catalog__row">
                            @foreach($products as $product)
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
                                            <p class="catalog-price__value"><span>по запросу</span></p>
                                        @endif
                                    </div>

                                    <div class="catalog-button__block">
                                        <div class="button-block__button">
                                            <a
                                                href="{{ route('catalog.product', ['category' => $category->slug, 'product' => $product->slug]) }}"
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

                <div style="margin-top: 20px;">
                    {{ $products->links() }}
                </div>

        </div>
    </section>
    @endif




@endsection
