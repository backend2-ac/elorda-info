
<main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js"></script>
    <style>
        #pdf-viewer {
            width: 100%;
            height: 100vh; /* Full viewport height */
            border: none;
        }

    </style>
    <div class="container">
        <div class="wrapper-parent">
            <div class="wrapper">
                <div class="wrapper-col">
                    <section class="media">
                        <div class="media__container block">
                            <?php if ($doc): ?>
                                <div class="inner__text">
                                    <h2><?= $doc['title'] ?></h2>
                                    <div id="pdf-viewer"></div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            PDFObject.embed("/files/docs/<?= $doc['doc'] ?>", "#pdf-viewer");
                                        });
                                    </script>
                                </div>
                            <?php else: ?>
                                <div class="inner__text">
                                    <p>No document found.</p>
                                </div>
                            <?php endif; ?>
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
                                    <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                        <?php if ($item['img'] || $item['img_path']): ?>
                                            <div class="news-actual__item-img">
                                                <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="news-actual__item-info">
                                            <div class="news-actual__item-date">
                                                <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?></div>
                                            <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="news-actual__items" data-id="2">
                            <?php if( $popular_news ): ?>
                                <?php foreach( $popular_news as $index => $item ): ?>
                                    <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                        <?php if ($item['img'] || $item['img_path']): ?>
                                            <div class="news-actual__item-img">
                                                <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="news-actual__item-info">
                                            <div class="news-actual__item-date">
                                                <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?></div>
                                            <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
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
                    <a href="http://astana-akshamy.kz/" target="_blank" class="ban ban-2">
                        <img src="/img/ban-3.JPG" alt="">
                    </a>
                    <a href="http://vechastana.kz/" target="_blank" class="ban ban-1">
                        <img src="/img/ban-4.JPG" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
