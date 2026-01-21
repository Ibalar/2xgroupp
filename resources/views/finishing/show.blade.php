@extends('layouts.app')

@section('title', $finishingType->name)

@section('content')

    @php
        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => 'Виды отделки', 'url' => route('finishing.index')],
            ['title' => $finishingType->name],
        ];
    @endphp

    @include('partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'title' => $finishingType->name])

    <section class="finishing-page__content finishing-content__block">
        <div class="finishing-content__container">
            <div class="finishing-content__header">
                <h1 class="finishing-content__title">{{ $finishingType->name }}</h1>
                @if($finishingType->type === 'internal')
                    <span class="finishing-content__type">Внутренняя отделка</span>
                @else
                    <span class="finishing-content__type">Наружная отделка</span>
                @endif
            </div>

            @if($finishingType->image)
                <div class="finishing-content__image">
                    <img
                        src="{{ asset('storage/' . $finishingType->image) }}"
                        alt="{{ $finishingType->name }}"
                        loading="eager"
                    >
                </div>
            @endif

            <div class="finishing-content__description">
                {!! nl2br(e($finishingType->description)) !!}
            </div>

            <div class="finishing-content__action">
                <a href="#callback" class="service-button__send open-popup-link animate__animated animate__pulse animate__infinite">
                    ЗАКАЗАТЬ КОНСУЛЬТАЦИЮ
                </a>
            </div>

            {{-- Похожие виды отделки --}}
            @if($similar->isNotEmpty())
                <section class="finishing-page__similar finishing-similar__block">
                    <h2 class="finishing-similar__title">Похожие виды отделки</h2>
                    <div class="finishing-similar__row">
                        @foreach($similar as $item)
                            <div class="finishing-similar__item">
                                <a href="{{ route('finishing.show', ['type' => $item->type, 'finishingType' => $item->id]) }}" class="finishing-similar__link">
                                    @if($item->image)
                                        <img
                                            src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $item->name }}"
                                            class="finishing-similar__img"
                                            loading="lazy"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('img/services/img-services__01.jpg') }}"
                                            alt="{{ $item->name }}"
                                            class="finishing-similar__img"
                                            loading="lazy"
                                        >
                                    @endif
                                    <div class="finishing-similar__name">{{ $item->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection
