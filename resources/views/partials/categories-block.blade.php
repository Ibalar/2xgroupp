<section class="home-page__services home-services__block">
    <div class="home-services__container">
        <div class="home-services__title">Наши услуги</div>
        <div class="home-services__row">
            @foreach($categories as $category)
                <div class="home-services__item">
                    <a href="{{ url('/catalog/' . $category->slug) }}" class="services-img__link">
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
                            <a href="{{ url('/catalog/' . $category->slug) }}" class="services-item__link">
                                {{ $category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="home-services__item house-item__callback">
                <div class="house-callback__title">Не нашли то, что надо?</div>
                <div class="house-callback__subtitle">Оставьте заявку и мы постараемся Вам помочь</div>
                <div class="house-callback__button">
                    <a href="#callback" class="house-callback__send open-popup-link">Связаться с нами</a>
                    <span class="house-callback__icon"></span>
                </div>
            </div>
        </div>
    </div>
</section>
