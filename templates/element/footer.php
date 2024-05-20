
<footer class="footer">
    <div class="container">
        <div class="footer__container">
            <div class="footer__top">
                <div class="footer__col">
                    <a href="/<?= $lang ?>" class="footer__logo">
                        <img src="/img/f-logo.png" alt="">
                    </a>
                    <div class="footer__street">
                        <span><?= $comps[33]['body'] ?></span>
                        <a href="tel:+7 705 532 22 84">+7 705 532 22 84</a>
                        <a href="mailto:Elorda.info2023@gmail.com">Elorda.info2023@gmail.com</a>
                    </div>
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
<!--                            <li>-->
<!--                                <a href="/--><?php //= $lang ?><!--rules">Сайт ережесі</a>-->
<!--                            </li>-->
                            <li>
                                <a href="/<?= $lang ?>anticor">Антикор</a>
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
<!--                            <li>-->
<!--                                <a href="/--><?php //= $lang ?><!--rules">Правила сайта</a>-->
<!--                            </li>-->
                            <li>
                                <a href="/<?= $lang ?>anticor">Антикор</a>
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
                    <!-- <a href="https://wa.me/<?=$comps[26]['body']?>" target="_blank" class="footer__feedback"><?= __('Напишите нам') ?></a> -->
                    <!-- Google Tag Manager (noscript) -->
                    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M964JQBS"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
                    <!-- End Google Tag Manager (noscript) -->
                    <!-- Google tag (gtag.js) -->
                    <script async src="https://www.googletagmanager.com/gtag/js?id=G-14414JMZLQ"></script>
                    <script>
                    window.dataLayer = window.dataLayer || [];
                    function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());

                    gtag('config', 'G-14414JMZLQ');
                    </script>


                    <!-- Yandex.Metrika informer -->
                    <a href="https://metrika.yandex.ru/stat/?id=95942695&amp;from=informer"
                       target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/95942695/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                           style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="95942695" data-lang="ru" /></a>
                    <!-- /Yandex.Metrika informer -->

                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript" >
                        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                            m[i].l=1*new Date();
                            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

                        ym(95942695, "init", {
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/95942695" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->

                    <!--LiveInternet counter-->
                    <a href="https://www.liveinternet.ru/click"
                        target="_blank">
                        <img id="licnt1443" width="88" height="31" style="border:0"
                        title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7"
                        alt=""/>
                    </a>
                    <script>
                        (function(d,s){d.getElementById("licnt1443").src=
                        "https://counter.yadro.ru/hit?t11.6;r"+escape(d.referrer)+
                        ((typeof(s)=="undefined")?"":";s"+s.width+""+s.height+""+
                        (s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+
                        ";h"+escape(d.title.substring(0,150))+";"+Math.random()})
                        (document,screen)
                    </script>
                    <!--/LiveInternet-->

                </div>
            </div>
            <div class="footer__text">
                <span>Қазақстан Республикасының Ақпарат және коммуникация министрлігінің Байланыс, ақпараттандыру және бұқаралық ақпарат құралдары саласындағы мемлекеттік бақылау комитетіне тіркеліп, 10.03.2017 жылы N16386-СИ куәлігі берілді.</span>
            </div>
            <div class="footer__bot">
                <span>© 2009 — <?= date('Y') ?>. <?= __('Все права защищены') ?></span>
                <!-- <a href="https://astanacreative.kz" target="_blank"><?= __('Дизайн и разработка') ?></a> -->
            </div>
        </div>
    </div>
</footer>
