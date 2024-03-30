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
<!--                            --><?php //if ($l == 'kz'): ?>
<!--                                <li class="header__nav-item">-->
<!--                                    <a href="/--><?php //= $lang ?><!--elorda-janalyktary" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'elorda-janalyktary') ? 'active' : '' ?><!--">--><?php //= $full_categories[1]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                  <a href="/--><?php //= $lang ?><!--sayasat" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'sayasat') ? 'active' : '' ?><!--">--><?php //= $full_categories[17]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                    <a href="/--><?php //= $lang ?><!--aleumet" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'aleumet') ? 'active' : '' ?><!--">--><?php //= $full_categories[16]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                     <a href="/--><?php //= $lang ?><!--madeniet" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'madeniet') ? 'active' : '' ?><!--">--><?php //= $full_categories[20]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                            --><?php //else: ?>
<!--                                <li class="header__nav-item">-->
<!--                                     <a href="/--><?php //= $lang ?><!--novosti-stolicy-ru" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'novosti-stolicy-ru') ? 'active' : '' ?><!--">--><?php //= $full_categories[2]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                    <a href="/--><?php //= $lang ?><!--politika-ru" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'politika-ru') ? 'active' : '' ?><!--">--><?php //= $full_categories[12]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                    <a href="/--><?php //= $lang ?><!--sotsium-ru" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'sotsium-ru') ? 'active' : '' ?><!--">--><?php //= $full_categories[6]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="header__nav-item">-->
<!--                                    <a href="/--><?php //= $lang ?><!--kultura-ru" class="header__nav-link --><?php //= ($request['pass'] && $request['pass'][0] == 'kultura-ru') ? 'active' : '' ?><!--">--><?php //= $full_categories[9]['title'] ?><!--</a>-->
<!--                                </li>-->
<!--                            --><?php //endif; ?>
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
                        <!-- <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.7482 5.09753C25.6284 5.1092 25.5182 5.16797 25.4417 5.2609C25.3653 5.35384 25.3289 5.47333 25.3405 5.5931L25.4766 6.98705C25.4883 7.1068 25.5471 7.217 25.64 7.29345C25.733 7.36989 25.8524 7.40631 25.9722 7.39472C26.092 7.38304 26.2022 7.32428 26.2786 7.23134C26.3551 7.13841 26.3915 7.01892 26.3799 6.89914L26.2437 5.5052C26.2193 5.25528 25.9914 5.07551 25.7482 5.09753ZM33.3893 7.678L32.5002 8.75995C32.4267 8.85324 32.3927 8.97163 32.4055 9.08971C32.4182 9.20779 32.4768 9.31616 32.5685 9.39159C32.6603 9.46701 32.7779 9.50348 32.8962 9.49316C33.0146 9.48285 33.1241 9.42658 33.2014 9.33641L34.0905 8.25447C34.164 8.16117 34.198 8.04279 34.1853 7.92471C34.1725 7.80663 34.114 7.69825 34.0222 7.62283C33.9305 7.5474 33.8128 7.51094 33.6945 7.52125C33.5762 7.53157 33.4666 7.58784 33.3893 7.678ZM37.6065 14.8437L36.2126 14.9802C36.0928 14.992 35.9826 15.0509 35.9062 15.1439C35.8299 15.2369 35.7935 15.3564 35.8052 15.4762C35.817 15.5959 35.8759 15.7061 35.9689 15.7825C36.0619 15.8588 36.1814 15.8952 36.3012 15.8835L37.6951 15.747C37.9444 15.7225 38.1269 15.5005 38.1025 15.251C38.078 15.0015 37.8543 14.8186 37.6065 14.8437ZM34.4401 22.0034C34.3468 21.9299 34.2284 21.8959 34.1103 21.9087C33.9922 21.9214 33.8839 21.98 33.8084 22.0717C33.733 22.1635 33.6965 22.2811 33.7069 22.3995C33.7172 22.5178 33.7734 22.6273 33.8636 22.7047L34.9455 23.5941C35.0266 23.6609 35.1284 23.6974 35.2334 23.6972C35.3646 23.6972 35.4947 23.6409 35.5844 23.5317C35.6608 23.4387 35.6972 23.3192 35.6855 23.1994C35.6738 23.0796 35.615 22.9693 35.522 22.8929L34.4401 22.0034ZM18.1123 9.17158C18.0359 9.26458 17.9995 9.38412 18.0112 9.50392C18.0229 9.62372 18.0817 9.73397 18.1747 9.81043L19.2567 10.6999C19.3377 10.7667 19.4395 10.8032 19.5445 10.803C19.6757 10.803 19.8058 10.7467 19.8955 10.6375C19.9719 10.5445 20.0083 10.425 19.9966 10.3052C19.9849 10.1854 19.9261 10.0751 19.8331 9.99865L18.7512 9.10919C18.558 8.94961 18.2711 8.97803 18.1123 9.17158Z" fill="#CC9933" stroke="#CC9933" stroke-width="0.8"/>
                            <path d="M31.6586 24.9742C31.7501 24.5801 31.7962 24.1769 31.7962 23.7724C31.7962 22.9768 31.6156 22.2242 31.3009 21.5458C32.938 20.1401 33.8941 17.9919 33.6687 15.6857C33.3011 11.925 29.9431 9.16377 26.1807 9.53137C23.1392 9.82898 20.7632 12.0864 20.1563 14.9276C19.2834 14.6276 18.3526 14.4682 17.3941 14.4682C14.0813 14.4682 11.1164 16.368 9.72255 19.3441C9.26569 19.1978 8.78881 19.1237 8.3091 19.1243C5.74638 19.1243 3.66109 21.2095 3.66109 23.7723C3.66109 24.0627 3.68943 24.3544 3.7458 24.6444C2.02538 25.4229 0.895142 27.1479 0.895142 29.057C0.895142 31.7296 3.0697 33.9042 5.74234 33.9042H29.0461C31.7187 33.9042 33.8933 31.7296 33.8933 29.057C33.8937 28.2435 33.6891 27.4431 33.2986 26.7295C32.908 26.0159 32.344 25.4122 31.6586 24.9742ZM26.269 10.4346C26.4627 10.4157 26.6572 10.4063 26.8518 10.4063C29.8722 10.4063 32.4658 12.7067 32.7654 15.7736V15.774C32.9549 17.7122 32.1812 19.5211 30.8417 20.7415C29.8802 19.3621 28.2846 18.4558 26.4795 18.4558C25.8912 18.4551 25.307 18.5529 24.751 18.7451C23.871 17.2019 22.5574 16.0086 21.0095 15.2784C21.4778 12.7371 23.5726 10.6983 26.269 10.4346ZM29.0462 32.9967H5.74241C3.56999 32.9967 1.80273 31.2295 1.80273 29.057C1.80273 27.3941 2.85809 25.903 4.42891 25.3471C4.53771 25.3085 4.62774 25.2299 4.68069 25.1273C4.73363 25.0247 4.74552 24.9058 4.71394 24.7948C4.61751 24.4562 4.56861 24.112 4.56861 23.7724C4.56861 21.7099 6.24652 20.032 8.30903 20.032C8.81707 20.0313 9.31986 20.1348 9.7863 20.3361C9.84175 20.36 9.90141 20.3727 9.96179 20.3733C10.0222 20.3739 10.0821 20.3625 10.138 20.3397C10.1938 20.3168 10.2445 20.283 10.2871 20.2403C10.3298 20.1976 10.3634 20.1467 10.3862 20.0909C11.5536 17.2268 14.3042 15.3759 17.3941 15.3759C20.2525 15.3759 22.8366 16.9634 24.1372 19.5194C24.1897 19.6225 24.2795 19.7016 24.3884 19.7407C24.4972 19.7798 24.6169 19.7758 24.7229 19.7296C25.2768 19.4875 25.875 19.3627 26.4795 19.3634C28.9108 19.3634 30.8886 21.3412 30.8886 23.7725C30.8886 24.2082 30.8241 24.6407 30.6972 25.0576C30.6666 25.1577 30.6716 25.2654 30.7114 25.3623C30.7513 25.4591 30.8234 25.5392 30.9155 25.5889C32.1925 26.2788 32.9859 27.6075 32.9859 29.0571C32.9859 31.2295 31.2186 32.9967 29.0462 32.9967Z" fill="#CC9933" stroke="#CC9933" stroke-width="0.8"/>
                        </svg> -->
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
                            <div class="header__currency-icon">
                                <img src="/img/dollar-icon.png" alt="" class="icon-svg">
                            </div>
                            <div class="header__currency-name">USD:</div>
                            <div class="header__currency-value">478.1</div>
                        </div>
                        <div class="header__currency-item">
                            <div class="header__currency-icon">
                                <img src="/img/euro-icon.png" alt="" class="icon-svg">
                            </div>
                            <div class="header__currency-name">EUR:</div>
                            <div class="header__currency-value">502.1</div>
                        </div>
                        <div class="header__currency-item">
                            <div class="header__currency-icon">
                                <img src="/img/rub-icon.png" alt="" class="icon-svg">
                            </div>
                            <div class="header__currency-name">RUB:</div>
                            <div class="header__currency-value">4.75</div>
                        </div>
                    </div>
                    <a href="/<?= $lang ?>search" class="header__search">
                        <img src="/img/search-icon.svg" alt="" class="icon-svg">
                        <?= __('Поиск') ?>
                    </a>
                    <div class="header__lang">
                        <a href="javascript:;" class="header__lang-active">
                            <img src="/img/lang-icon.svg" alt="" class="icon-svg">
                            <?php if($l == 'ru'): ?>
                            	рус
                        	<?php else: ?>
                        		қаз
                        	<?php endif ?>

                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 5L8 10L13 5" stroke="white" stroke-width="1.5"/>
                            </svg>
                        </a>
                        <div class="header__lang-other">
                            <?php if ($request['controller'] == 'Articles'): ?>
                                <a href="/ru">рус</a>
                                <a href="/">қаз</a>
                            <?php else: ?>
                                <a href="/ru<?= str_replace(['/ru/', '/en/'], '/', $_SERVER['REQUEST_URI']) ?>">рус</a>
                                <a href="<?= str_replace(['/ru/', '/en/'], '/', $_SERVER['REQUEST_URI']) ?>">қаз</a>
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
<!--                        --><?php //if ($l == 'kz'): ?>
<!--                            <a href="/--><?php //= $lang ?><!--elorda-janalyktary" class="header__menu-link">Елорда жаңалықтары</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sayasat" class="header__menu-link">Саясат</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--aleumet" class="header__menu-link">Әлеумет</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--ekonomika" class="header__menu-link">Экономика</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sport" class="header__menu-link">Спорт</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--madeniet" class="header__menu-link">Мәдениет</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--ar-turli" class="header__menu-link">Әртүрлі</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--kozkaras" class="header__menu-link">Көзқарас</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--video" class="header__menu-link">Видео</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--alem" class="header__menu-link">Әлем</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--joldau" class="header__menu-link">Жолдау</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sluzhba-komplaens-kz" class="header__menu-link">Комплаенс қызметі</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--adep-kodeksi" class="header__menu-link">Әдеп кодексі</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--elge-kyzmet" class="header__menu-link">Елге қызмет</a>-->
<!--                        --><?php //else: ?>
<!--                            <a href="/--><?php //= $lang ?><!--novosti-stolicy-ru" class="header__menu-link">Новости столицы</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--politika-ru" class="header__menu-link">Политика</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sotsium-ru" class="header__menu-link">Социум</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--ekonomika-ru" class="header__menu-link">Экономика</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sport-ru" class="header__menu-link">Спорт</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--kultura-ru" class="header__menu-link">Культура</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--raznoe-ru" class="header__menu-link">Разное</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--mnenie-ru" class="header__menu-link">Мнение</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--video-ru" class="header__menu-link">Видео</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--mir" class="header__menu-link">Мир</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--poslanie-ru" class="header__menu-link">Послание</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sluzhba-komplaens-ru" class="header__menu-link">Служба Комплаенс</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--kodeks-etiki" class="header__menu-link">Этический кодекс</a>-->
<!--                            <a href="/--><?php //= $lang ?><!--sluzhu-strane" class="header__menu-link">Служу стране</a>-->
<!--                        --><?php //endif; ?>
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
