<footer class="footer footer__block">
    <div class="footer-block__container">
        <div class="footer-block__top">
            <div class="footer-top__row">
                <div class="footer-top__item">
                    <p>Производственно-строительная компания</p>
                    <p>ООО «2Х групп»</p>
                    <p><strong>УНП:</strong> 191775194</p>
                    <p><strong class="d-block">Почтовый адрес:</strong> 220101, г. Минск, а/я 163</p>
                </div>
                <div class="footer-top__item">
                    <div class="footer-item__title">Наша продукция</div>
                    <div class="footer-item__list">
                        @foreach($footerCategories as $category)
                            <li class="footer-list__item">
                                <a href="{{ route('catalog.category', $category->slug) }}" class="footer-list__link">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </div>
                <div class="footer-top__item">
                    <div class="footer-item__title">Наши контакты</div>
                    <div class="footer-item__list">
                        <ul>
                            <li class="footer-list__item">+375 (29) 677-51-81</li>
                            <li class="footer-list__item">+375 (29) 682-12-17</li>
                            <li class="footer-list__item">Пуховичский район</li>
                            <li class="footer-list__item">п. Дружный, территория ВЗС</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-block__bottom">
            <div class="footer-bottom__row">
                <div class="footer-bottom__item">2022-2025 «www.2xgroupp.by» <a href="#" class="footer-bottom__link">Правовая информация</a></div>
                <div class="footer-bottom__item">Разработка сайта - <a href="https://webart.by" class="footer-bottom__link">WebArt.BY</a></div>
            </div>
        </div>
    </div>
</footer>
