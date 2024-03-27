<!-- asdasd -->
<main>
        <div class="container">
            <div class="wrapper-parent">
                <div class="wrapper">
                    <div class="wrapper-col">
                        <section class="holiday">
                            <div class="holiday__container">
                                <h2 class="holiday__title">
                                    День республики <span>25 октября</span>
                                </h2>
                                <div class="holiday__text">
                                    Выходной во всех муниципальных учреждениях
                                </div>
                            </div>
                        </section>
                        <?php if( $main_articles ): ?>
	                        <section class="hero">
	                            <div class="hero__container">
	                                <div class="hero__swiper swiper">
	                                    <div class="swiper-wrapper">
											<?php foreach( $main_articles as $index => $item ): ?>
												 <div class="swiper-slide">
		                                            <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="hero__swiper-slide">
		                                                <div class="hero__swiper-img">
		                                                  <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" />
		                                                </div>

		                                                <div class="hero__swiper-tag">
		                                                	<?= __('Актуально') ?>
                                                		</div>

		                                                <div class="hero__swiper-title"><?= $item['title'] ?></div>
                                                        <?php if (isset($full_categories[$item['category_id']]) && isset($categories_slug_parts[$full_categories[$item['category_id']]['alias']])): ?>
                                                            <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="hero__swiper-link">
                                                                <?= __('Читать далее') ?>
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M2.40002 13.2L13.2 2.40002M13.2 2.40002H2.40002M13.2 2.40002V13.2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                                                </svg>
                                                            </a>
                                                        <?php endif; ?>
		                                            </a>
		                                        </div>
											<?php endforeach; ?>
		                                    <div class="swiper-pagination"></div>
		                                </div>
	                            	</div>
                            	</div>
	                        </section>
                        <?php endif; ?>
                        <?php if( $capital_news ): ?>
                        <section class="capital">
                            <div class="capital__container block">
                                <div class="block__header">
                                    <h2 class="capital__title block__title"><?= __('Новости столицы') ?></h2>
                                    <a href="/<?= $lang . $capital_news[0]['category']['alias'] ?>" class="capital__link block__link">
                                        <?= __('На страницу новостей столицы') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <?php foreach( $capital_news as $index => $item ): ?>
                                	<?php if($index === 0):?>
                                		<a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="capital__main">
		                                    <div class="capital__main-img">
		                                        <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
		                                    </div>
		                                    <div class="capital__main-header block-elems">
		                                        <div class="capital__main-date date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
<!--		                                        <div class="capital__main-watch watch">-->
<!--		                                            <img src="/img/watch.png" alt="" class="svg-icon">-->
<!--		                                            --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                        </div>-->
		                                    </div>
		                                    <div class="capital__main-title"><?= $item['title'] ?></div>
		                                    <div class="capital__main-link">
		                                        <?= __('Читать далее') ?>
		                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		                                            <path d="M2.40002 13.2L13.2 2.40002M13.2 2.40002H2.40002M13.2 2.40002V13.2" stroke="white" stroke-width="2" stroke-linecap="round"/>
		                                        </svg>
		                                    </div>
		                                </a>
									<?php endif ?>
								<?php endforeach; ?>
                                <div class="capital__items">
	                                <?php foreach( $capital_news as $index => $item ): ?>
	                                	<?php if($index != 0):?>
			                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="capital__item article__item">
		                                        <div class="article__item-img">
		                                             <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
		                                            <div class="article__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
		                                        </div>
		                                        <div class="article__item-title"><?= $item['title'] ?></div>
<!--		                                        <div class="article__item-watch">-->
<!--		                                            <img src="/img/watch-gray.png" alt="">-->
<!--		                                             --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                        </div>-->
		                                    </a>

										<?php endif ?>
									<?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                         <?php endif; ?>
                         <?php if( $society_news ): ?>
                        <section class="socium">
                            <div class="socium__container block">
                                <div class="block__header">
                                    <h2 class="socium__title block__title"><?= __('Социум') ?></h2>
                                    <a href="/<?= $lang . $society_news[0]['category']['alias'] ?>" class="socium__link block__link">
                                        <?= __('На страницу социума') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="socium__wrapper">
                                    <div class="socium__left">
                                    	 <?php foreach( $society_news as $index => $item ): ?>
		                                	<?php if($index === 0):?>
				                                <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="socium__main">
                                                    <?php if ($item['img'] || $item['img_path']): ?>
                                                    <div class="socium__main-img">
		                                                 <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
		                                            </div>
                                                    <?php endif; ?>
                                                    <div class="socium__main-header block-elems">
		                                                <div class="socium__main-date date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
<!--		                                                <div class="socium__main-watch watch">-->
<!--		                                                    <img src="/img/watch.png" alt="" class="svg-icon">-->
<!--		                                                    --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                                </div>-->
		                                            </div>
		                                            <div class="socium__main-title"><?= $item['title'] ?></div>
		                                            <div class="socium__main-link">
		                                                <?= __('Читать далее') ?>
		                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		                                                    <path d="M2.40002 13.2L13.2 2.40002M13.2 2.40002H2.40002M13.2 2.40002V13.2" stroke="white" stroke-width="2" stroke-linecap="round"/>
		                                                </svg>
		                                            </div>

		                                        </a>
											<?php endif ?>
										<?php endforeach; ?>

                                        <div class="socium__childs">
                                        	<?php foreach( $society_news as $index => $item ): ?>
			                                	<?php if($index === 1 || $index === 2 ):?>

			                                        <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="socium__child article__item">
		                                                <div class="article__item-img">
		                                                     <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
		                                                    <div class="article__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
		                                                </div>
		                                                <div class="article__item-title"><?= $item['title'] ?></div>
<!--		                                                <div class="article__item-watch">-->
<!--		                                                    <img src="/img/watch-gray.png" alt="">-->
<!--		                                                    --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                                </div>-->
		                                            </a>
												<?php endif ?>
											<?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="socium__right">
                                        <div class="socium__items">
                                        	<?php foreach( $society_news as $index => $item ): ?>

			                                	<?php if($index != 0 && $index != 1  && $index != 2 ):?>

		                                            <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="socium__item">
		                                                <div class="socium__item-header">
		                                                    <div class="date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?></div>
<!--		                                                    <div class="watch">-->
<!--		                                                        <img src="/img/watch-gray.png" alt="">-->
<!--		                                                        --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                                    </div>-->
		                                                </div>
		                                                <div class="socium__item-title"><?= $item['title'] ?></div>
		                                            </a>
												<?php endif ?>
											<?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <?php endif; ?>
                         <?php if( $politica_news ): ?>
                        <section class="politic">
                            <div class="politic__container block">
                                <div class="block__header">
                                    <h2 class="politic__title block__title"><?= __('Политика') ?></h2>
                                    <a href="/<?= $lang . $politica_news[0]['category']['alias'] ?>" class="politic__link block__link">
                                        <?= __('На страницу политики') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="politic__items">
                                	<?php foreach( $politica_news as $index => $item ): ?>
                                        <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="politic__item">
                                            <?php if ($item['img'] || $item['img_path']): ?>
                                                <div class="politic__item-img">
	                                             <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
	                                        </div>
                                            <?php endif; ?>
                                            <div class="politic__info">

	                                            <div class="politic__item-title"><?= $item['title'] ?></div>
                                                <?php
                                                $body_text = strip_tags($item['body']);
                                                $short_desc = mb_substr($body_text, 0, 260);
                                                $short_desc = substr($short_desc, 0, strrpos($short_desc, ' '));
                                                ?>
	                                            <div class="politic__item-text"><?= $short_desc ?></div>
<!--	                                            <div class="politic__item-watch">-->
<!--	                                                <img src="/img/watch-gray.png" alt="">-->
<!--	                                                --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--	                                            </div>-->
	                                        </div>
	                                    </a>
									<?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                         <?php endif; ?>
                         <?php if( $culture_news ): ?>
                        <section class="culture">
                            <div class="culture__container block">
                                <div class="block__header">
                                    <h2 class="culture__title block__title"><?= __('Культура') ?></h2>
                                    <a href="/<?= $lang . $culture_news[0]['category']['alias'] ?>" class="culture__link block__link">
                                        <?= __('На страницу культуры') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="culture__wrapper">
                                	<a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="culture__main">
	                                	<?php foreach( $culture_news as $index => $item ): ?>
	                                		<?php if($index === 0): ?>
                                                <?php if ($item['img'] || $item['img_path']): ?>
                                                    <div class="culture__main-img">
			                                            <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
			                                        </div>
                                                <?php endif; ?>
                                                <div class="culture__main-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
			                                        <div class="culture__main-title"><?= $item['title'] ?></div>
			                                        <div class="culture__main-link">
			                                            <?= __('Читать далее') ?>
			                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			                                                <path d="M2.09998 11.55L11.55 2.09998M11.55 2.09998H2.09998M11.55 2.09998V11.55" stroke="white" stroke-width="2" stroke-linecap="round"/>
			                                            </svg>
			                                        </div>
			                                <?php endif ?>
										<?php endforeach; ?>
                                    </a>

                                    <div class="culture__items">
                                    	<?php foreach( $culture_news as $index => $item ): ?>
	                                		<?php if($index != 0): ?>
			                                    <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="culture__item">
                                                    <?php if ($item['img'] || $item['img_path']): ?>
                                                        <div class="culture__item-img">
                                                           <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="culture__item-info">
		                                                <div class="culture__item-header">
		                                                    <div class="date">
		                                                        <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
		                                                    </div>
<!--		                                                    <div class="watch">-->
<!--		                                                        <img src="/img/watch-gray.png" alt="">-->
<!--		                                                        --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--		                                                    </div>-->
		                                                </div>
		                                                <div class="culture__item-title"><?= $item['title'] ?></div>
		                                            </div>
		                                        </a>
			                                <?php endif ?>
										<?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <?php endif; ?>
                          <?php if( $heroes_news ): ?>
                        <section class="heroes">
                            <div class="heroes__container block">
                                <div class="block__header">
                                    <h2 class="heroes__title block__title"><?= __('Герои столицы') ?></h2>
                                    <a href="/<?= $lang . $heroes_news[0]['category']['alias'] ?>" class="heroes__link block__link">
                                        <?= __('На страницу героев столицы') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="heroes__items">
                                	<?php foreach( $heroes_news as $index => $item ): ?>
		                                <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="heroes__child article__item">
	                                        <div class="article__item-img">
	                                            <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
	                                            <div class="article__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
	                                        </div>
	                                        <div class="article__item-title"><?= $item['title'] ?></div>
<!--	                                        <div class="article__item-watch">-->
<!--	                                            <img src="/img/watch-gray.png" alt="">-->
<!--	                                             --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--	                                        </div>-->
	                                    </a>
									<?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
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
	                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
	                                        </div>
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
		                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
		                                        </div>
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
                        <div class="widget__tg">
                            <!-- <img src="/img/comps/<?=$comps[16]['img']?>" alt=""> -->
                            <div class="widget__tg-block">
                                <a href="#" target="_blank" class="widget__tg-header">
                                    Популярное в нашем Telegram-канале
                                    <img src="/img/tg-widget-icon.png" alt="">
                                </a>
                                <div class="widget__tg-items">
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" target="_blank" class="widget__tg-item">
                                        <div class="widget__tg-title">Программа льготного кредитования жилья "Елорда жастары": опубликованы результаты отбора</div>
                                        <div class="widget__tg-elems">
                                            <!-- views -->
                                            <div class="widget__tg-elem">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M24.8411 12.0137C24.6177 11.7082 19.2963 4.53296 12.4998 4.53296C5.70341 4.53296 0.381733 11.7082 0.158638 12.0134C0.0555513 12.1547 0 12.325 0 12.4998C0 12.6747 0.0555513 12.845 0.158638 12.9862C0.381733 13.2917 5.70341 20.467 12.4998 20.467C19.2963 20.467 24.6177 13.2917 24.8411 12.9865C24.9443 12.8453 24.9999 12.675 24.9999 12.5001C24.9999 12.3252 24.9443 12.1549 24.8411 12.0137ZM12.4998 18.8187C7.49355 18.8187 3.15756 14.0563 1.87402 12.4994C3.1559 10.9412 7.48281 6.1813 12.4998 6.1813C17.5059 6.1813 21.8416 10.9428 23.1257 12.5005C21.8438 14.0587 17.5169 18.8187 12.4998 18.8187Z" fill="#8D9093"/>
                                                    <path d="M12.4999 7.55493C9.77322 7.55493 7.55481 9.77334 7.55481 12.5C7.55481 15.2267 9.77322 17.4451 12.4999 17.4451C15.2265 17.4451 17.4449 15.2267 17.4449 12.5C17.4449 9.77334 15.2265 7.55493 12.4999 7.55493ZM12.4999 15.7967C10.682 15.7967 9.2032 14.3178 9.2032 12.5C9.2032 10.6822 10.6821 9.20332 12.4999 9.20332C14.3177 9.20332 15.7966 10.6822 15.7966 12.5C15.7966 14.3178 14.3177 15.7967 12.4999 15.7967Z" fill="#8D9093"/>
                                                </svg>
                                                356
                                            </div>
                                            <!-- date -->
                                            <div class="widget__tg-elem">
                                                11.10.23
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="widget__youtube">
                            <!-- <div class="widget__youtube-header">
                                <img src="/img/comps/<?=$comps[17]['img']?>" alt="">
                            </div>
                            <?php if (isset($comps[18]['body'])): ?>
                                <div class="widget__youtubte-frame">
                                    <?=$comps[18]['body']?>
                                </div>
                            <?php endif; ?> -->
                            <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                            <div class="elfsight-app-c146067f-4880-4b8e-be10-919895c2a90f" data-elfsight-app-lazy></div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
