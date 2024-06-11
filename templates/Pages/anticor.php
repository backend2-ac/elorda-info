
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
                            <h1 class="media__title title"><?= __('Антикоррупционный комплаенс') ?></h1>
                            <div class="media__text">
                                <?php if ($docs): ?>
                                    <div class="inner__text">
                                        <?php foreach ($docs as $index => $doc): ?>
                                            <?php if ($index < 2): ?>
                                                <p><a href="/files/docs/<?= $doc['doc'] ?>"><?= $doc['title'] ?></a></p>
                                            <?php else: ?>
                                                <p><?= $index - 1 ?>. <a href="<?= $index == (count($docs) - 1) ? '/' . $lang . 'doc-content' : '/files/docs/' . $doc['doc'] ?>"><?= $doc['title'] ?></a></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
<!--                            <div class="inner__text">-->
<!--                                --><?php //= isset($page_comps[36]['body']) ? $page_comps[36]['body'] : '' ?>
<!--                            </div>-->
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
                            <?php if( $last_news ): ?>
                                <?php foreach( $last_news as $index => $item ): ?>
                                    <a href="/<?= $lang ?><?= $category_alias ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                        <div class="news-actual__item-img">
                                            <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                        </div>
                                        <div class="news-actual__item-info">
                                            <div class="news-actual__item-date">
                                                <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?>
                                            </div>
                                            <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                        <div class="news-actual__items" data-id="2">
                            <?php if( $popular_news ): ?>
                                <?php foreach( $popular_news as $index => $item ): ?>
                                    <a href="/<?= $lang ?><?= $category_alias ?>/<?= $item['alias'] ?>"  class="news-actual__item">
                                        <div class="news-actual__item-img">
                                            <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                        </div>
                                        <div class="news-actual__item-info">
                                            <div class="news-actual__item-date">
                                                <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?>
                                            </div>
                                            <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                        <?php if ($l == 'kz'): ?>
                            <a href="/<?= $lang ?>latest-news" class="news-actual__link">
                                Барлық жаңалықтар
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.39999 12.2L12.2 1.40002M12.2 1.40002H1.39999M12.2 1.40002V12.2" stroke="#1D489C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        <?php else: ?>
                            <a href="/<?= $lang ?>latest-news" class="news-actual__link">
                                <?= __('Все новости') ?>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.39999 12.2L12.2 1.40002M12.2 1.40002H1.39999M12.2 1.40002V12.2" stroke="#1D489C" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?= $this->element('telegram') ?>
                    <?= $this->element('youtube') ?>
                </div>
            </div>
        </div>
    </div>
</main>
