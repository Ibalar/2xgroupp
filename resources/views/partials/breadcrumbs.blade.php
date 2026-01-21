<section class="category-page__crumbs category-crumbs__block">
    <div class="category-crumbs__container">
        <div class="category-crumbs__row">
            <ul class="category-crumbs__list">
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

                {{-- Обычная страница (pages) --}}
                @if(request()->routeIs('page.show'))
                    <li class="category-crumbs__item">{{ $title }}</li>
                @endif
            </ul>
        </div>

        <div class="category-crumbs__title">{{ $title }}</div>
    </div>
</section>
