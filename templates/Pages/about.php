<!-- <main>
	<section class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs__container">
				<h1><?= $page['title'] ?></h1>
				<ul class="breadcrumbs__list">
					<li><a href="/<?= $lang ?>"><?= __('Главная') ?></a></li>
					<li class="active"><?= $page['title'] ?></li>
				</ul>
			</div>
		</div>
	</section>
	<section class="about section">
		<div class="container">
			<div class="about__container">
				<div class="about__desc">
					<?= $page_comps[9]['body'] ?>
				</div>
			</div>
		</div>
	</section>
</main> -->

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
	                                <div class="media__table-header"><?= $branche['title'] ?></div>
	                                <table>
	                                    <thead>
	                                        <tr>
	                                            <th>ФИО сотрудника</th>
	                                            <th>Должность</th>
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
                            <a href="javascript:;" class="news-actual__header-tab active" data-id="1">Последние</a>
                            <a href="javascript:;" class="news-actual__header-tab" data-id="2">Популярные</a>
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
