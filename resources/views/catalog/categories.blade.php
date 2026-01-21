@extends('layouts.app')

@section('title', 'Каталог')

@section('content')

    @include('partials.breadcrumbs', ['title' => 'Каталог'])




    <section class="home-page__services home-services__block">
        <div class="home-services__container">
                @if($categories->isEmpty())
                    <p>Категорий пока нет.</p>
                @else
                    <div class="home-services__row">
                        @foreach($categories as $category)
                            <div class="home-services__item">
                                <a href="{{ route('catalog.category', $category->slug) }}" class="services-img__link">
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
                                        <a href="{{ route('catalog.category', $category->slug) }}" class="services-item__link">
                                            {{ $category->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </section>
@endsection
