
<footer class="footer">
    <div class="container">
        <div class="footer__container">
            <div class="footer__top">
                <div class="footer__col">
                    <a href="/<?= $lang ?>" class="footer__logo">
                        <img src="/img/f-logo.png" alt="">
                    </a>
                    <div class="footer__street"><?= $comps[33]['body'] ?></div>
                </div>
                <?php if ($l == 'kz'): ?>
                    <div class="footer__list">
<!--                        <div class="footer__list-title">Жоба жайлы</div>-->
                        <ul>
                            <li>
                                <a href="/<?= $lang ?>about">Редакция туралы</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>contact">Байланыс</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>cooperation">Жарнама үшін</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>rules">Сайт ережесі</a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="footer__list">
<!--                        <div class="footer__list-title">О проекте</div>-->
                        <ul>
                            <li>
                                <a href="/<?= $lang ?>about">О редакции</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>contact">Контакты</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>cooperation">Для рекламы</a>
                            </li>
                            <li>
                                <a href="/<?= $lang ?>rules">Правила сайта</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="footer__items">
                    <div class="footer__socials">
                        <a href="<?= $comps[14]['body'] ?>" target="_blank">
                            <img src="/img/TT-icon.svg" alt="" class="icon-svg">
                        </a>
                        <a href="<?= $comps[7]['body'] ?>" target="_blank">
                            <img src="/img/F-icon.svg" alt="" class="icon-svg">
                        </a>
                        <a href="<?= $comps[8]['body'] ?>" target="_blank">
                            <img src="/img/INST-icon.svg" alt="" class="icon-svg">
                        </a>
                        <a href="<?= $comps[32]['body'] ?>" target="_blank">
                            <img src="/img/TG-icon.svg" alt="" class="icon-svg">
                        </a>
                    </div>
<!--                    <a href="mailto:--><?php //= $comps[6]['body'] ?><!--" class="footer__mail">--><?php //= $comps[6]['body'] ?><!--</a>-->
                    <a href="https://wa.me/<?=$comps[26]['body']?>" target="_blank" class="footer__feedback"><?= __('Напишите нам') ?></a>
                </div>
            </div>
            <div class="footer__bot">
                <span>© 2009 — <?= date('Y') ?>. <?= __('Все права защищены') ?></span>
                <a href="https://astanacreative.kz" target="_blank"><?= __('Дизайн и разработка') ?></a>
            </div>
        </div>
    </div>
</footer>
