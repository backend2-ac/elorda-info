
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
                                <?= $page_comps[9]['body'] ?>
                            </div>
                            <?php foreach( $branches as $index => $branche ): ?>
                                <div class="media__table">
<!--	                                <div class="media__table-header">--><?php //= $branche['title'] ?><!--</div>-->
	                                <table>
	                                    <thead>
	                                        <tr>
                                                <th></th>
                                                <th></th>
<!--	                                            <th>--><?php //= __('ФИО сотрудника') ?><!--</th>-->
<!--	                                            <th>--><?php //= __('Должность') ?><!--</th>-->
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php foreach( $employees as $index => $employee ): ?>
	                                    		<?php if($employee['branche_id'] ===$branche['id'] ): ?>
			                                        <tr>
			                                            <td>
			                                                <div class="media__table-title"><?= $employee['name'] ?></div>
			                                                <a href="mailto:" class="media__table-mail">
			                                                    <img src="/img/mail-icon.png" alt="">
			                                                    <?= $employee['mail'] ?>
			                                                </a>
			                                            </td>
			                                            <td>
			                                                <div class="media__table-title"><?= $employee['position'] ?></div>
			                                            </td>
			                                        </tr>
			                                    <?php endif ?>
	                                        <?php endforeach; ?>

	                                    </tbody>
	                                </table>
	                            </div>
							<?php endforeach; ?>

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
                                        <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm')  ?></div>
                                        <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                    </div>
                                </a>
							<?php endforeach; ?>
                        </div>
                        <div class="news-actual__items" data-id="2">
                            <?php foreach( $popular_news as $index => $item ): ?>
                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                    <div class="news-actual__item-img">
                                        <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm')  ?></div>
                                        <div class="news-actual__item-title"><?= $item['title'] ?></div>
                                    </div>
                                </a>
							<?php endforeach; ?>
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
                </div>
            </div>
        </div>
    </div>
</main>
