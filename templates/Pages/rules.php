
<main>
    <div class="container">
        <div class="wrapper-parent">
            <div class="wrapper">
                <div class="wrapper-col">
                    <section class="media">
                        <div class="media__container block">
                            <ul class="breadcrumbs">
                                <li>
                                    <a  href="/<?= $lang ?>"><?= __('Главная') ?></a>
                                </li>
                                <li>
                                    <a href="#"><?= $page['title'] ?></a>
                                </li>
                            </ul>
                            <h1 class="media__title title"><?= $page['title'] ?></h1>
                            <div class="media__text">
                                <?= $page_comps[19]['body'] ?>
                            </div>

                        </div>
                    </section>
                </div>
                <div class="wrapper-col">
                    <div class="news-actual__block">
                        <div class="news-actual__header">
                            <a href="javascript:;" class="news-actual__header-tab active" data-id="1"><?= __('Последние') ?></a>
                            <a href="javascript:;" class="news-actual__header-tab" data-id="2"><?= __('Популярные') ?></a>
                        </div>
                        <div class="news-actual__items active" data-id="1">
                            <?php foreach( $last_news as $index => $item ): ?>
                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                    <div class="news-actual__item-img">
                                        <img src="/img/articles/<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
                                        </div>
                                        <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                    </div>
                                </a>
							<?php endforeach; ?>
                        </div>
                        <div class="news-actual__items" data-id="2">
                            <?php foreach( $popular_news as $index => $item ): ?>
                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                    <div class="news-actual__item-img">
                                        <img src="/img/articles/<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
                                        </div>
                                        <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                    </div>
                                </a>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
