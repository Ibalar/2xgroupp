@extends('layouts.app')

@section('title', 'Виды отделки')

@section('content')

    @include('partials.breadcrumbs', ['title' => 'Виды отделки'])

    <section class="home-page__services home-services__block">
        <div class="home-services__container">
            {{-- Внутренняя отделка --}}
            @if($internalTypes->isNotEmpty())
                <div class="home-services__section">
                    <h2 class="home-services__section-title">Внутренняя отделка</h2>
                    <div class="home-services__row">
                        @foreach($internalTypes as $type)
                            <div class="home-services__item">
                                <a href="{{ route('finishing.show', ['type' => 'internal', 'finishingType' => $type->id]) }}" class="services-img__link">
                                    <img
                                        src="{{ $type->image ? asset('storage/' . $type->image) : asset('img/services/img-services__01.jpg') }}"
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
                                        <a href="{{ route('finishing.show', ['type' => 'internal', 'finishingType' => $type->id]) }}" class="services-item__link">
                                            {{ $type->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Наружная отделка --}}
            @if($externalTypes->isNotEmpty())
                <div class="home-services__section">
                    <h2 class="home-services__section-title">Наружная отделка</h2>
                    <div class="home-services__row">
                        @foreach($externalTypes as $type)
                            <div class="home-services__item">
                                <a href="{{ route('finishing.show', ['type' => 'external', 'finishingType' => $type->id]) }}" class="services-img__link">
                                    <img
                                        src="{{ $type->image ? asset('storage/' . $type->image) : asset('img/services/img-services__01.jpg') }}"
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
                                        <a href="{{ route('finishing.show', ['type' => 'external', 'finishingType' => $type->id]) }}" class="services-item__link">
                                            {{ $type->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($internalTypes->isEmpty() && $externalTypes->isEmpty())
                <p>Видов отделки пока нет.</p>
            @endif
        </div>
    </section>
@endsection
