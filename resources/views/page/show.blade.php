@extends('layouts.app')

@section('title', $page->title)



@section('content')

    @include('partials.breadcrumbs', ['title' => $page->title])

    <section class="product-page__characteristic product-characteristic__block">
        <div class="product-characteristic__container">
            <div class="product-characteristic__row">
                <div class="product-characteristic__row">
                    <div class="product-description__col">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('partials.categories-block')



@endsection
