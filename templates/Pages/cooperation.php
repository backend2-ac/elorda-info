 <main>
        <div class="container">
            <div class="wrapper-parent">
                <div class="block">
                    <section class="preview">
                        <ul class="breadcrumbs-absolute">
                            <li>
                                <a href="#"><?= __('Главная') ?></a>
                            </li>
                            <li>
                                <a href="#"><?= __('Для рекламы сайта') ?></a>
                            </li>
                        </ul>
                        <img src="/img/preview-bg.jpg" alt="" class="preview__bg">
                        <div class="preview__container">
                            <div class="preview__logo">
                                <img src="/img/preview-logo.png" alt="">
                            </div>
                            <div class="preview__title"><?= __('Media kit новостного портала Elorda info') ?></div>
                            <div class="preview__date"><?= date('Y') ?></div>
                        </div>
                    </section>
                    <section class="stats">
                        <div class="stats__container">
                            <h2 class="stats__title title"><?= __('Статистика на сайте <span>в месяц</span>') ?></h2>
                            <div class="stats__items">
                                <div class="stats__item">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <div class="stats__item blue">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <div class="stats__item">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <div class="stats__item">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <div class="stats__item blue">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <div class="stats__item">
                                    <div class="stats__item-header"><?= __('На сайте каждый месяц') ?></div>
                                    <div class="stats__item-counter">52%</div>
                                    <div class="stats__item-text"><?= __('новых посетителей') ?></div>
                                    <a href="#" target="_blank" class="stats__item-link">Яндекс.Метрика</a>
                                </div>
                                <?= $this->Form->create(null, [
                                    'url' => '/'.$lang.'requests/send',
                                    'accept-charset' => 'utf-8',
                                    'onsubmit' => 'submitForm()'
                                ]) ?>
                                    <div class="stats__form">
                                        <div class="stats__form-title"><?= __('Оставьте заявку на сотрудничество') ?></div>
                                        <div class="stats__form-text"><?= __('Разместите рекламу на нашем сайте, чтобы гарантировать себе просмотры и постоянных читателей. Оставьте свои контактные данные и мы с вами свяжемся для обсуждения деталей') ?></div>
                                        <div class="stats__form-elems">
                                            <input type="text" name="email" placeholder="zarina.zarina@mail.ru" required="required">
                                            <button type="submit"><?= __('Оставить заявку') ?></button>
                                        </div>
                                    </div>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </section>
                    <section class="follower">
                        <div class="follower__container">
                            <h2 class="follower__title title"><?= __('Подписчики в социальных сетях') ?></h2>
                            <div class="follower__items">
                                <div class="follower__item">
                                    <div class="follower__item-img">
                                        <img src="/img/f-1.png" alt="">
                                    </div>
                                    <div class="follower__item-title"><?= __('Страница') ?></div>
                                    <a href="#" target="_blank" class="follower__item-link">facebook.com/aikyn.kz</a>
                                    <div class="follower__item-count">10088</div>
                                </div>
                                <div class="follower__item">
                                    <div class="follower__item-img">
                                        <img src="/img/f-2.png" alt="">
                                    </div>
                                    <div class="follower__item-title"><?= __('Аккаунт') ?></div>
                                    <a href="#" target="_blank" class="follower__item-link">facebook.com/aikyn.kz</a>
                                    <div class="follower__item-count">10088</div>
                                </div>
                                <div class="follower__item">
                                    <div class="follower__item-img">
                                        <img src="/img/f-3.png" alt="">
                                    </div>
                                    <div class="follower__item-title"><?= __('Страница') ?></div>
                                    <a href="#" target="_blank" class="follower__item-link">facebook.com/aikyn.kz</a>
                                    <div class="follower__item-count">10088</div>
                                </div>
                                <div class="follower__item">
                                    <div class="follower__item-img">
                                        <img src="/img/f-4.png" alt="">
                                    </div>
                                    <div class="follower__item-title">Аккаунт</div>
                                    <a href="#" target="_blank" class="follower__item-link">facebook.com/aikyn.kz</a>
                                    <div class="follower__item-count">10088</div>
                                </div>
                            </div>
                            <div class="follower__total">
                                <div class="follower__total-text"><?= __('Всего подписчиков:') ?></div>
                                <div class="follower__total-title">37994</div>
                            </div>
                        </div>
                    </section>
                    <section class="place">
                        <div class="place__container">
                            <h2 class="place__title title"><?= __('Места на сайте') ?></h2>
                            <div class="place__main-accordeons">
                                <div class="place__main-accordeon">
                                    <a href="javascript:;" class="place__main-title js-accordeons__item-title">
                                        top_1140x100
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 16L27 16" stroke="#1B2227" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 27L16 5" stroke="#1B2227" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="place__main-body js-accordeons__item-body" data-fancybox data-src="/img/place.jpg">
                                        <img src="/img/place.jpg" alt="">
                                    </div>
                                </div>
                                <div class="place__main-accordeon">
                                    <a href="javascript:;" class="place__main-title js-accordeons__item-title">
                                        240x400
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 16L27 16" stroke="#1B2227" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16 27L16 5" stroke="#1B2227" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <div class="place__main-body js-accordeons__item-body" data-fancybox data-src="/img/place.jpg">
                                        <img src="/img/place.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
<!--                    <section class="brand">-->
<!--                        <div class="brand__container">-->
<!--                            <h2 class="brand__title title">--><?php //= __('С кем мы сотрудничаем') ?><!--</h2>-->
<!--                            <div class="brand__items marquee" data-duplicated="true">-->
<!--                                <div class="brand__item"><img src="/img/mar1.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar2.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar3.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar1.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar2.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar3.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar1.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar2.png" alt=""></div>-->
<!--                                <div class="brand__item"><img src="/img/mar3.png" alt=""></div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </section>-->
                    <section class="feedback">
                        <div class="feedback__container">
                            <?= $this->Form->create(null, [
                                'url' => '/'.$lang.'requests/send',
                                'accept-charset' => 'utf-8',
                                'onsubmit' => 'submitForm()'
                            ]) ?>
                                <div class="feedback__form">
                                    <div class="feedback__form-logo"><img src="/img/form-logo.png" alt=""></div>
                                    <h2 class="feedback__title title"><?= __('Оставьте заявку на сотрудничество') ?></h2>
                                    <div class="feedback__text"><?= __('Оставьте свои контактные данные и мы с вами свяжемся для обсуждения деталей') ?></div>
                                    <div class="feedback__elems">
                                        <input type="text" name="email" placeholder="zarina.zarina@mail.ru" required="required">
                                        <button type="submit"><?= __('Оставить заявку') ?></button>
                                    </div>
                                </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </section>
                    <section class="contact">
                        <div class="container">
                            <div class="contact__container">
                                <div class="contact__block">
                                    <div class="contact__info">
                                        <h2 class="contact__info-title title"><?= __('Контакты') ?></h2>
                                        <ul class="contact__info-list">
                                            <li>
                                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.476 25.1256C21.3632 21.4439 25 16.0949 25 12.5109C25 6.5678 20.5228 1.75 15 1.75C9.47715 1.75 5 6.5678 5 12.5109C5 16.0949 8.63682 21.4439 11.524 25.1256C13.0303 27.0464 13.7835 28.0068 15 28.0068C16.2165 28.0068 16.9697 27.0464 18.476 25.1256ZM15 16.75C12.9289 16.75 11.25 15.0711 11.25 13C11.25 10.9289 12.9289 9.25 15 9.25C17.0711 9.25 18.75 10.9289 18.75 13C18.75 15.0711 17.0711 16.75 15 16.75Z" fill="#1D489C"/>
                                                </svg>
                                                <span><span><?=$contact_comps[20]['body']?></span></span>
                                            </li>
                                            <li>
                                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.1398 4.21881C8.82468 3.0104 6.80324 3.0104 5.48813 4.21881C5.43427 4.2683 5.37677 4.32581 5.30211 4.40049L4.18024 5.52236C3.05135 6.65125 2.57745 8.27865 2.92378 9.83712C4.88874 18.6794 11.7944 25.5851 20.6367 27.5501C22.1952 27.8964 23.8226 27.4225 24.9515 26.2936L26.0733 25.1719C26.148 25.0971 26.2055 25.0396 26.255 24.9857C27.4635 23.6706 27.4635 21.6492 26.255 20.3341C26.2055 20.2802 26.148 20.2227 26.0733 20.1479L24.2367 18.3114C22.9616 17.0362 21.0359 16.6716 19.3828 17.3921C18.4364 17.8047 17.334 17.5959 16.604 16.8659L13.608 13.8699C12.878 13.1399 12.6692 12.0374 13.0817 11.091C13.8023 9.43796 13.4376 7.5123 12.1625 6.23717L10.3258 4.40051C10.2512 4.32582 10.1937 4.26831 10.1398 4.21881Z" fill="#1D489C"/>
                                                    <path d="M17.841 7.04411C17.95 7.04411 17.9947 7.04413 18.031 7.04465C20.9055 7.08582 23.2257 9.40606 23.2669 12.2805C23.2674 12.3169 23.2674 12.3615 23.2674 12.4706V13.1777C23.2674 13.6954 23.6872 14.1152 24.2049 14.1152C24.7227 14.1152 25.1424 13.6954 25.1424 13.1777V12.4615C25.1424 12.3644 25.1424 12.3052 25.1417 12.2537C25.086 8.36469 21.9469 5.22554 18.0579 5.16984C18.0063 5.1691 17.9472 5.16911 17.8501 5.16911H17.1339C16.6161 5.16911 16.1964 5.58884 16.1964 6.10661C16.1964 6.62437 16.6161 7.04411 17.1339 7.04411H17.841Z" fill="#1D489C"/>
                                                </svg>
                                                <a href="tel:<?=$contact_comps[21]['body']?>"><?=$contact_comps[21]['body']?></a>
                                            </li>
                                            <li>
                                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.91653 8.51184C2.5 10.0618 2.5 12.2001 2.5 15.5C2.5 20.1872 2.5 22.5307 3.69364 24.1737C4.07914 24.7043 4.54575 25.1709 5.07634 25.5564C6.71925 26.75 9.06283 26.75 13.75 26.75H16.25C20.9372 26.75 23.2808 26.75 24.9237 25.5564C25.4543 25.1709 25.9209 24.7043 26.3064 24.1737C27.5 22.5307 27.5 20.1872 27.5 15.5C27.5 12.1891 27.5 10.0476 27.0793 8.49636L24.4508 11.1248C22.4105 13.1652 20.8115 14.7642 19.3962 15.844C17.9476 16.9493 16.5816 17.5987 14.9998 17.5987C13.418 17.5987 12.0521 16.9493 10.6034 15.844C9.18811 14.7641 7.58914 13.1652 5.5488 11.1248L3.10482 8.68082L2.91653 8.51184Z" fill="#1D489C"/>
                                                    <path d="M3.75 6.75L3.88606 6.86259L4.39484 7.31919L6.82391 9.74826C8.92598 11.8503 10.4373 13.3588 11.7408 14.3533C13.0226 15.3314 13.9928 15.7237 14.9998 15.7237C16.0068 15.7237 16.977 15.3314 18.2589 14.3533C19.5624 13.3588 21.0737 11.8503 23.1757 9.74826L26.0606 6.86338L26.2176 6.70724C25.8321 6.17665 25.4543 5.82914 24.9237 5.44364C23.2808 4.25 20.9372 4.25 16.25 4.25H13.75C9.06283 4.25 6.71925 4.25 5.07634 5.44364C4.54575 5.82914 4.1355 6.21941 3.75 6.75Z" fill="#1D489C"/>
                                                </svg>
                                                <a href="mailto:<?=$contact_comps[22]['body']?>"><?=$contact_comps[22]['body']?></a>
                                            </li>
                                        </ul>
                                        <div class="contact__info-text">
                                            <?=$contact_comps[23]['body']?> <a href="mailto:<?=$contact_comps[22]['body']?>"><?=$contact_comps[22]['body']?></a>
                                        </div>
                                            <ul class="contact__info-schedule">
                                                <li>
                                                    <svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.32634 4.69364C4.11836 4.11821 5.07323 3.82018 6.375 3.66583V4.75C6.375 5.78553 7.21447 6.625 8.25 6.625C9.28553 6.625 10.125 5.78553 10.125 4.75V3.50351C10.7051 3.5 11.3285 3.5 12 3.5C12.6715 3.5 13.2949 3.5 13.875 3.50351V4.75C13.875 5.78553 14.7145 6.625 15.75 6.625C16.7855 6.625 17.625 5.78553 17.625 4.75V3.66583C18.9268 3.82018 19.8816 4.11821 20.6737 4.69364C21.2043 5.07914 21.6709 5.54575 22.0564 6.07634C22.7618 7.04729 23.0503 8.26297 23.1683 10.0625H0.83167C0.94968 8.26297 1.23821 7.04729 1.94364 6.07634C2.32914 5.54575 2.79575 5.07914 3.32634 4.69364Z" fill="#1D489C"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.763373 11.9372C0.75 12.7698 0.75 13.7012 0.75 14.75C0.75 19.4372 0.75 21.7808 1.94364 23.4237C2.32914 23.9543 2.79575 24.4209 3.32634 24.8064C4.96925 26 7.31283 26 12 26C13.0487 26 13.98 26 14.8125 25.9866L14.8125 25.899C14.8124 24.834 14.8124 24.1852 14.901 23.6256C15.3881 20.5501 17.8001 18.1381 20.8756 17.651C21.4352 17.5624 22.084 17.5624 23.149 17.5625L23.2366 17.5625C23.25 16.73 23.25 15.7987 23.25 14.75C23.25 13.7012 23.25 12.7697 23.2366 11.9372L23.2137 11.9375H0.786011L0.763373 11.9372ZM8.25 15.0625C7.73223 15.0625 7.3125 15.4822 7.3125 16C7.3125 16.5178 7.73223 16.9375 8.25 16.9375H15.75C16.2678 16.9375 16.6875 16.5178 16.6875 16C16.6875 15.4822 16.2678 15.0625 15.75 15.0625H8.25Z" fill="#1D489C"/>
                                                        <path d="M20.6737 24.8064C19.7027 25.5118 18.487 25.8003 16.6875 25.9183C16.6877 24.7804 16.6919 24.3044 16.7529 23.9189C17.1129 21.6458 18.8958 19.8629 21.1689 19.5029C21.5544 19.4419 22.0304 19.4377 23.1683 19.4375C23.0503 21.237 22.7618 22.4527 22.0564 23.4237C21.6709 23.9543 21.2043 24.4209 20.6737 24.8064Z" fill="#1D489C"/>
                                                        <path d="M9.1875 1C9.1875 0.482233 8.76777 0.0625 8.25 0.0625C7.73223 0.0625 7.3125 0.482233 7.3125 1V4.75C7.3125 5.26777 7.73223 5.6875 8.25 5.6875C8.76777 5.6875 9.1875 5.26777 9.1875 4.75V1Z" fill="#1D489C"/>
                                                        <path d="M16.6875 1C16.6875 0.482233 16.2678 0.0625 15.75 0.0625C15.2322 0.0625 14.8125 0.482233 14.8125 1V4.75C14.8125 5.26777 15.2322 5.6875 15.75 5.6875C16.2678 5.6875 16.6875 5.26777 16.6875 4.75V1Z" fill="#1D489C"/>
                                                    </svg>
                                                    <?=$contact_comps[24]['body']?>
                                                </li>
                                            </ul>
                                        <a href="<?=$contact_comps[27]['body']?>" target="_blank" class="contact__info-path"><?= __('Как добраться?') ?></a>
                                    </div>
                                    <div class="contact__map">
                                        <iframe src="<?=$contact_comps[25]['body']?>" width="100%" height="400" frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
