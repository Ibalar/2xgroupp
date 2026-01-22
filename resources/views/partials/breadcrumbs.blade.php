@php
    /**
     * Supported call styles:
     * - @include('partials.breadcrumbs', ['title' => '...'])
     * - @include('partials.breadcrumbs', ['breadcrumbs' => [['url' => '...', 'title' => '...'], ['title' => '...']]])
     */

    $pageTitle = $title ?? null;

    if (empty($pageTitle) && isset($breadcrumbs) && is_array($breadcrumbs)) {
        $pageTitle = collect($breadcrumbs)->last()['title'] ?? null;
    }
@endphp

<section class="category-page__crumbs category-crumbs__block">
    <div class="category-crumbs__container">
        <div class="category-crumbs__row">
            <ul class="category-crumbs__list">
                @if(isset($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs) > 0)
                    @foreach($breadcrumbs as $crumb)
                        <li class="category-crumbs__item">
                            @if(!empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}">{{ $crumb['title'] ?? '' }}</a>
                            @else
                                {{ $crumb['title'] ?? '' }}
                            @endif
                        </li>
                    @endforeach
                @else
                    <li class="category-crumbs__item">
                        <a href="{{ route('home') }}">Главная</a>
                    </li>

                    {{-- Каталог --}}
                    @if(request()->routeIs('catalog.*'))
                        <li class="category-crumbs__item">
                            <a href="{{ route('catalog.categories') }}">Каталог</a>
                        </li>
                    @endif

                    {{-- Страница категории --}}
                    @if(request()->routeIs('catalog.category'))
                        <li class="category-crumbs__item">{{ $title }}</li>
                    @endif

                    {{-- Страница товара --}}
                    @if(request()->routeIs('catalog.product') && isset($category))
                        <li class="category-crumbs__item">
                            <a href="{{ route('catalog.category', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                        <li class="category-crumbs__item">{{ $title }}</li>
                    @endif

                    {{-- Виды отделки --}}
                    @if(request()->routeIs('finishing.index'))
                        <li class="category-crumbs__item">{{ $title }}</li>
                    @endif

                    @if(request()->routeIs('finishing.show'))
                        <li class="category-crumbs__item">
                            <a href="{{ route('finishing.index') }}">Виды отделки</a>
                        </li>
                        <li class="category-crumbs__item">{{ $title }}</li>
                    @endif

                    {{-- Обычная страница (pages) --}}
                    @if(request()->routeIs('page.show'))
                        <li class="category-crumbs__item">{{ $title }}</li>
                    @endif
                @endif
            </ul>
        </div>

        <div class="category-crumbs__title">{{ $pageTitle }}</div>
    </div>
</section>
