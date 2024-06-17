<?php
if ($rates_data) {
    foreach ($rates_data->channel->item as $item) {
        if ($item->title == 'USD') {
            $dollar = $item->description;
        } elseif ($item->title == 'EUR') {
            $eur = $item->description;
        } elseif ($item->title == 'RUB') {
            $rub = $item->description;
        }
    }
}
?>
<header class="header way way-header">
        <div class="header__container">
            <div class="header__top-wrap">
                <div class="container">
                <div class="header__top">
                    <a href="/<?= $lang ?>" class="header__logo">
                        <img src="/img/logo.svg" alt="ELORDA INFO">
                    </a>
                    <nav class="header__nav">
                        <ul class="header__nav-list">
                            <li class="header__nav-item">
                                <a href="/<?= $lang ?>" class="header__nav-link <?= ($request['action'] == 'home') ? 'active' : '' ?>"><?= __('Главная') ?></a>
                            </li>
                            <?php if ($l == 'kz'): ?>
                                <li class="header__nav-item">
                                    <a href="/<?= $lang ?>elorda-janalyktary" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'elorda-janalyktary') ? 'active' : '' ?>"><?= $full_categories[1]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                  <a href="/<?= $lang ?>sayasat" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'sayasat') ? 'active' : '' ?>"><?= $full_categories[17]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                    <a href="/<?= $lang ?>aleumet" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'aleumet') ? 'active' : '' ?>"><?= $full_categories[16]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                     <a href="/<?= $lang ?>madeniet" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'madeniet') ? 'active' : '' ?>"><?= $full_categories[20]['title'] ?></a>
                                </li>
                            <?php else: ?>
                                <li class="header__nav-item">
                                     <a href="/<?= $lang ?>novosti-stolicy-ru" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'novosti-stolicy-ru') ? 'active' : '' ?>"><?= $full_categories[2]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                    <a href="/<?= $lang ?>politika-ru" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'politika-ru') ? 'active' : '' ?>"><?= $full_categories[12]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                    <a href="/<?= $lang ?>sotsium-ru" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'sotsium-ru') ? 'active' : '' ?>"><?= $full_categories[6]['title'] ?></a>
                                </li>
                                <li class="header__nav-item">
                                    <a href="/<?= $lang ?>kultura-ru" class="header__nav-link <?= ($request['pass'] && $request['pass'][0] == 'kultura-ru') ? 'active' : '' ?>"><?= $full_categories[9]['title'] ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="header__nav-item">
                                <a href="/<?= $lang ?>anticor" class="header__nav-link <?= ($request['action'] && $request['action'] == 'anticor') ? 'active' : '' ?>">Антикор</a>
                            </li>
                            <?php if ($userAuth): ?>
                                <li class="header__nav-item">
                                    <a href="/admin" class="header__nav-link">Админ</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    <a href="javascript:;" class="header__burger">
                        <div>
                            <span><?= __('Меню') ?></span>
                            <svg width="29" height="18" viewBox="0 0 29 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 2C12.0523 2 12.5 1.55228 12.5 1C12.5 0.447715 12.0523 0 11.5 0V2ZM11.5 0H0L0 2H11.5V0Z" fill="#1D489C"/>
                                <path d="M28 10C28.5523 10 29 9.55228 29 9C29 8.44772 28.5523 8 28 8V10ZM0 10H28V8H0V10Z" fill="#1D489C"/>
                                <path d="M28 18C28.5523 18 29 17.5523 29 17C29 16.4477 28.5523 16 28 16V18ZM0 18H28V16H0V18Z" fill="#1D489C"/>
                            </svg>
                        </div>
                        <div>
                            <span><?= __('Закрыть') ?></span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 21L20.9706 4.02944" stroke="#1D489C" stroke-width="2" stroke-linecap="round"/>
                                <path d="M4 4L20.9706 20.9706" stroke="#1D489C" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </a>
                </div>
                </div>
            </div>
            <div class="header__bot-wrap">
                <div class="container">
                <div class="header__bot">
                    <div class="header__time">
                        <img src="/img/time-icon.svg" class="icon-svg" alt="">
                        <span class="js-time">00:00</span>
                    </div>
                    <div class="header__weather">
                        <img src="" alt="">
                        <div>
                            Астана
                            <span>
                                -10oC
                            </span>
                        </div>
                    </div>
                    <div class="header__socials">
                        <a href="<?= $comps[14]['body'] ?>" target="_blank" class="header__socials-item">
                            <img src="/img/TT-icon.svg" class="icon-svg" alt="">
                        </a>
                        <a href="<?= $comps[7]['body'] ?>" target="_blank" class="header__socials-item">
                            <img src="/img/F-icon.svg" class="icon-svg" alt="">
                        </a>
                        <a href="<?= $comps[8]['body'] ?>" target="_blank" class="header__socials-item">
                            <img src="/img/INST-icon.svg" class="icon-svg" alt="">
                        </a>
                        <a href="<?= $comps[32]['body'] ?>" target="_blank" class="header__socials-item">
                            <img src="/img/TG-icon.svg" class="icon-svg" alt="">
                        </a>
                    </div>
                    <div class="header__currency">
                        <div class="header__currency-item">
                            <?php if (isset($dollar) && $dollar): ?>
                                <div class="header__currency-icon">
                                    <img src="/img/dollar-icon.png" alt="" class="icon-svg">
                                </div>
                                <div class="header__currency-name">USD:</div>
                                <div class="header__currency-value"><?= $dollar ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="header__currency-item">
                            <?php if (isset($eur) && $eur): ?>
                                <div class="header__currency-icon">
                                    <img src="/img/euro-icon.png" alt="" class="icon-svg">
                                </div>
                                <div class="header__currency-name">EUR:</div>
                                <div class="header__currency-value"><?= $eur ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="header__currency-item">
                            <?php if (isset($rub) && $rub): ?>
                                <div class="header__currency-icon">
                                    <img src="/img/rub-icon.png" alt="" class="icon-svg">
                                </div>
                                <div class="header__currency-name">RUB:</div>
                                <div class="header__currency-value"><?= $rub ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
<!--                    <div class="header__currency">-->
<!--                        <div class="header__currency-item">-->
<!--                            <div class="header__currency-icon">-->
<!--                                <img src="/img/dollar-icon.png" alt="" class="icon-svg">-->
<!--                            </div>-->
<!--                            <div class="header__currency-name">USD:</div>-->
<!--                            <div class="header__currency-value">478.1</div>-->
<!--                        </div>-->
<!--                        <div class="header__currency-item">-->
<!--                            <div class="header__currency-icon">-->
<!--                                <img src="/img/euro-icon.png" alt="" class="icon-svg">-->
<!--                            </div>-->
<!--                            <div class="header__currency-name">EUR:</div>-->
<!--                            <div class="header__currency-value">502.1</div>-->
<!--                        </div>-->
<!--                        <div class="header__currency-item">-->
<!--                            <div class="header__currency-icon">-->
<!--                                <img src="/img/rub-icon.png" alt="" class="icon-svg">-->
<!--                            </div>-->
<!--                            <div class="header__currency-name">RUB:</div>-->
<!--                            <div class="header__currency-value">4.75</div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <a href="/<?= $lang ?>search" class="header__search">
                        <img src="/img/search-icon.svg" alt="" class="icon-svg">
                        <?= __('Поиск') ?>
                    </a>
                    <div class="header__lang">
                        <a href="javascript:;" class="header__lang-active">
                            <img src="/img/lang-icon.svg" alt="" class="icon-svg">
                            <?php if($l == 'ru'): ?>
                            	RU
                        	<?php else: ?>
                        		KZ
                        	<?php endif ?>

                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 5L8 10L13 5" stroke="white" stroke-width="1.5"/>
                            </svg>
                        </a>
                        <div class="header__lang-other">
                            <?php if ($request['controller'] == 'Articles'): ?>
                                <a href="/ru/">RU</a>
                                <a href="/">KZ</a>
                            <?php elseif($request['controller'] == 'Pages' && $request['action'] == 'home'): ?>
                                <a href="/ru/">RU</a>
                                <a href="/">KZ</a>
                            <?php else: ?>
                                <a href="/ru<?= str_replace(['/ru/', '/en/'], '/', $_SERVER['REQUEST_URI']) ?>">RU</a>
                                <a href="<?= str_replace(['/ru/', '/en/'], '/', $_SERVER['REQUEST_URI']) ?>">KZ</a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="header__menu">
            <div class="header__menu-wrap">
                <div class="header__menu-text">Меню</div>
                <div class="header__menu-scroll">
                    <div class="header__menu-links">
                        <?php if ($l == 'kz'): ?>
                            <a href="/<?= $lang ?>elorda-janalyktary" class="header__menu-link">Елорда жаңалықтары</a>
                            <a href="/<?= $lang ?>kozkaras" class="header__menu-link">Көзқарас</a>
                            <a href="/<?= $lang ?>sayasat" class="header__menu-link">Саясат</a>
                            <a href="/<?= $lang ?>video" class="header__menu-link">Видео</a>
                            <a href="/<?= $lang ?>aleumet" class="header__menu-link">Әлеумет</a>
                            <a href="/<?= $lang ?>alem" class="header__menu-link">Әлем</a>
                            <a href="/<?= $lang ?>ekonomika" class="header__menu-link">Экономика</a>
                            <a href="/<?= $lang ?>joldau" class="header__menu-link">Жолдау</a>
                            <a href="/<?= $lang ?>sport" class="header__menu-link">Спорт</a>
                            <a href="/<?= $lang ?>sluzhba-komplaens-kz" class="header__menu-link">Комплаенс қызметі</a>
                            <a href="/<?= $lang ?>madeniet" class="header__menu-link">Мәдениет</a>
                            <a href="/<?= $lang ?>adep-kodeksi" class="header__menu-link">Әдеп кодексі</a>
                            <a href="/<?= $lang ?>ar-turli" class="header__menu-link">Әртүрлі</a>
                            <a href="/<?= $lang ?>elge-kyzmet" class="header__menu-link">Елге қызмет</a>
                        <?php else: ?>
                            <a href="/<?= $lang ?>novosti-stolicy-ru" class="header__menu-link">Новости столицы</a>
                            <a href="/<?= $lang ?>mnenie-ru" class="header__menu-link">Мнение</a>
                            <a href="/<?= $lang ?>politika-ru" class="header__menu-link">Политика</a>
                            <a href="/<?= $lang ?>video-ru" class="header__menu-link">Видео</a>
                            <a href="/<?= $lang ?>sotsium-ru" class="header__menu-link">Социум</a>
                            <a href="/<?= $lang ?>mir" class="header__menu-link">Мир</a>
                            <a href="/<?= $lang ?>ekonomika-ru" class="header__menu-link">Экономика</a>
                            <a href="/<?= $lang ?>poslanie-ru" class="header__menu-link">Послание</a>
                            <a href="/<?= $lang ?>sport-ru" class="header__menu-link">Спорт</a>
                            <a href="/<?= $lang ?>sluzhba-komplaens-ru" class="header__menu-link">Служба Комплаенс</a>
                            <a href="/<?= $lang ?>kultura-ru" class="header__menu-link">Культура</a>
                            <a href="/<?= $lang ?>kodeks-etiki" class="header__menu-link">Этический кодекс</a>
                            <a href="/<?= $lang ?>raznoe-ru" class="header__menu-link">Разное</a>
                            <a href="/<?= $lang ?>sluzhu-strane" class="header__menu-link">Служу стране</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__form-search">
            <div class="header__form-search_bg">
                <div class="container">
                    <form action="/<?= $lang ?>search" method="GET"">
                        <div class="header__form-search_wrapper">
                            <input type="text" placeholder="Поиск по сайту">
                            <button type="button" class="search-form-clear">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.26104 13.0522C9.84216 12.4712 9.84216 11.529 9.26104 10.9479L4.84349 6.53032C4.37769 6.06451 4.37769 5.3093 4.8435 4.8435C5.3093 4.37769 6.06451 4.37769 6.53032 4.8435L10.9479 9.26104C11.529 9.84216 12.4712 9.84216 13.0522 9.26104L17.4698 4.84349C17.9357 4.37769 18.6909 4.37769 19.1566 4.84349C19.6225 5.3093 19.6225 6.06451 19.1566 6.53032L14.7391 10.9479C14.158 11.529 14.158 12.4712 14.7391 13.0522L19.1566 17.4698C19.6225 17.9357 19.6225 18.6909 19.1566 19.1566C18.6909 19.6225 17.9357 19.6225 17.4698 19.1566L13.0522 14.7391C12.4712 14.158 11.529 14.158 10.9479 14.7391L6.53031 19.1566C6.06451 19.6225 5.3093 19.6225 4.84349 19.1566C4.37769 18.6909 4.37769 17.9357 4.8435 17.4698L9.26104 13.0522Z" fill="#1B2227"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="header-space"></div>
