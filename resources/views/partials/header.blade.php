<header class="header header-block">
    <div class="header-block__container">
        <div class="header-top__block">
            <div class="header-top__row">
                <div class="header-top__item logo-item">
                    @if(request()->is('/'))
                        <img src="{{ asset('img/logo.png') }}" alt="Логотип">
                    @else
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Логотип">
                        </a>
                    @endif
                </div>
                <div class="header-top__item header-mail">
                    <a href="mailto:info@2xgroupp.by" class="header-mail__link">info@2xgroupp.by</a>
                </div>
                <div class="header-top__item header-phone">
                    <a href="tel:+375296775181" class="header-phone__link">+375 (29) 677-51-81</a>
                </div>
                <div class="header-top__item header-phone">
                    <a href="tel:+375296821217" class="header-phone__link">+375 (29) 682-12-17</a>
                </div>
                <div class="header-top__item header-messeng">
                    <a href="#" class="header-messeng__link"><img src="{{ asset('img/icons/icon-viber.svg') }}" alt="Viber"></a>
                    <a href="#" class="header-messeng__link" target="_blank"><img src="{{ asset('img/icons/icon-insta.svg') }}" alt="Instagram"></a>
                    <a href="#" class="header-messeng__link"><img src="{{ asset('img/icons/icon-tiktok.svg') }}" alt="TikTok"></a>
                </div>
                <div class="header-top__item burger-item">
                    <div class="header__burger">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom__block menu-item">
            <ul class="header-menu__list">
                <li class="header-menu__item"><a href="{{ route('home') }}" class="menu__link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a></li>
                <li class="header-menu__item"><a href="{{ route('catalog.categories') }}" class="menu__link {{ request()->routeIs('catalog.categories') ? 'active' : '' }}">Каталог</a></li>
                <li class="header-menu__item"><a href="{{ route('finishing.index') }}" class="menu__link {{ request()->routeIs('finishing.*') ? 'active' : '' }}">Виды отделки</a></li>
                @foreach($menuPages as $page)
                    <li class="header-menu__item">
                        <a href="{{ url('/' . $page->slug) }}"
                           class="menu__link {{ request()->routeIs($page->slug) || request()->is($page->slug) ? 'active' : '' }}">
                            {{ $page->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</header>
