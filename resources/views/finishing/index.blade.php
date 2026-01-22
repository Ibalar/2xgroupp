@extends('layouts.app')

@section('title', 'Виды отделки')

@section('content')

    @include('partials.breadcrumbs', ['title' => 'Виды отделки'])

    <section class="home-page__services home-services__block">
        <div class="home-services__container">
            <h2 class="home-services__title" style="margin-bottom: 30px;">Внутренняя отделка</h2>
            
            @if($internalTypes->isEmpty())
                <p>Пока нет доступных видов внутренней отделки.</p>
            @else
                <div class="home-services__row">
                    @foreach($internalTypes as $type)
                        <div class="home-services__item">
                            <a href="{{ route('finishing.show', ['type' => $type->type, 'finishingType' => $type->id]) }}" class="services-img__link">
                                <img
                                    src="{{ $type->first_image ? asset('storage/' . $type->first_image) : asset('img/services/img-services__01.jpg') }}"
                                    alt="{{ $type->name }}"
                                    class="services-item__img"
                                    loading="lazy"
                                >
                            </a>

                            <div class="services-title__block">
                                <div class="services-item__num">
                                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                <div class="services-item__title">
                                    <a href="{{ route('finishing.show', ['type' => $type->type, 'finishingType' => $type->id]) }}" class="services-item__link">
                                        {{ $type->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="home-page__services home-services__block" style="padding-top: 50px;">
        <div class="home-services__container">
            <h2 class="home-services__title" style="margin-bottom: 30px;">Наружная отделка</h2>
            
            @if($externalTypes->isEmpty())
                <p>Пока нет доступных видов наружной отделки.</p>
            @else
                <div class="home-services__row">
                    @foreach($externalTypes as $type)
                        <div class="home-services__item">
                            <a href="{{ route('finishing.show', ['type' => $type->type, 'finishingType' => $type->id]) }}" class="services-img__link">
                                <img
                                    src="{{ $type->first_image ? asset('storage/' . $type->first_image) : asset('img/services/img-services__01.jpg') }}"
                                    alt="{{ $type->name }}"
                                    class="services-item__img"
                                    loading="lazy"
                                >
                            </a>

                            <div class="services-title__block">
                                <div class="services-item__num">
                                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                <div class="services-item__title">
                                    <a href="{{ route('finishing.show', ['type' => $type->type, 'finishingType' => $type->id]) }}" class="services-item__link">
                                        {{ $type->name }}
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
