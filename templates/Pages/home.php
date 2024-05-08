<!-- asdasd -->
<main>
        <div class="container">
            <div class="wrapper-parent">
                <div class="wrapper">
                    <div class="wrapper-col">
                        <?php if (isset($comps[34]['body']) && $comps[34]['body']): ?>
                            <section class="holiday">
                                <div class="holiday__container">
                                    <h2 class="holiday__title">
                                        <?= $comps[34]['body'] ?>
                                    </h2>
                                    <?php if ($comps[35]['body']): ?>
                                        <div class="holiday__text">
                                            <?= $comps[35]['body'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
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
                                                            <div class="hero__swiper-link">
                                                                <?= __('Читать далее') ?>
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M2.40002 13.2L13.2 2.40002M13.2 2.40002H2.40002M13.2 2.40002V13.2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                                                </svg>
                                                            </div>
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
                                    <a href="/<?= $l == 'kz' ? 'elorda-janalyktary' : 'ru/novosti-stolicy-ru' ?>" class="capital__link block__link">
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
		                                        <div class="capital__main-date date"><?=$this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
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
		                                            <div class="article__item-date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
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
                                    <a href="/<?= $l == 'kz' ? 'aleumet' : 'ru/sotsium-ru' ?>" class="socium__link block__link">
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
		                                                <div class="socium__main-date date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
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
		                                                    <div class="article__item-date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
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
		                                                    <div class="date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?></div>
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
                                    <a href="/<?= $l == 'kz' ? 'sayasat' : 'ru/politika-ru' ?>" class="politic__link block__link">
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
                                    <a href="/<?= $l == 'kz' ? 'madeniet' : 'ru/kultura-ru' ?>" class="culture__link block__link">
                                        <?= __('На страницу культуры') ?>
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.7 15.35L14.85 3.19995M14.85 3.19995H2.7M14.85 3.19995V15.35" stroke="#1D489C" stroke-width="2.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="culture__wrapper">
	                                	<?php foreach( $culture_news as $index => $item ): ?>
	                                		<?php if($index == 0): ?>
                                                <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="culture__main">
                                                <?php if ($item['img'] || $item['img_path']): ?>
                                                    <div class="culture__main-img">
			                                            <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
			                                        </div>
                                                <?php endif; ?>
                                                <div class="culture__main-date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
			                                        <div class="culture__main-title"><?= $item['title'] ?></div>
			                                        <div class="culture__main-link">
			                                            <?= __('Читать далее') ?>
			                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			                                                <path d="M2.09998 11.55L11.55 2.09998M11.55 2.09998H2.09998M11.55 2.09998V11.55" stroke="white" stroke-width="2" stroke-linecap="round"/>
			                                            </svg>
			                                        </div>
                                                </a>
			                                <?php endif ?>
										<?php endforeach; ?>

                                    <div class="culture__items">
                                    	<?php foreach( $culture_news as $index => $item ): ?>
	                                		<?php if($index > 0): ?>
			                                    <a href="/<?= $lang . $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="culture__item">
                                                    <?php if ($item['img'] || $item['img_path']): ?>
                                                        <div class="culture__item-img">
                                                           <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="culture__item-info">
		                                                <div class="culture__item-header">
		                                                    <div class="date">
                                                                <?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy | HH:mm') ?>		                                                    </div>
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
                                    <a href="/<?= $l == 'kz' ? 'elorda-erzhyrektery' : 'ru/geroi-stolicy-ru' ?>" class="heroes__link block__link">
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
	                                            <div class="article__item-date"><?= $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy') ?></div>
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
                        <?php if(isset($tg_posts) && $tg_posts): ?>
                            <div class="widget__tg">
                                <div class="widget__tg-block">
                                    <a href="<?= $comps[8]['body'] ?>" target="_blank" class="widget__tg-header">
                                        <?= __('Последние в нашем Telegram-канале') ?>
                                        <img src="/img/tg-widget-icon.png" alt="">
                                    </a>
                                    <div class="widget__tg-items">
                                        <?php foreach ($tg_posts as $tg_post): ?>
                                            <?php if ($tg_post['title']): ?>
                                                <a href="<?= $tg_post['link'] ?>" target="_blank" class="widget__tg-item">
                                                        <div class="widget__tg-title"><?= $tg_post['title'] ?></div>
                                                    <div class="widget__tg-elems">
                                                        <div class="widget__tg-elem">
                                                            <?= date('d.m.Y | H:m', $tg_post['date']) ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="widget__youtube">
                            <!-- <div class="widget__youtube-header">
                                <img src="/img/comps/<?=$comps[17]['img']?>" alt="">
                            </div>
                            <?php if (isset($comps[18]['body'])): ?>
                                <div class="widget__youtubte-frame">
                                    <?=$comps[18]['body']?>
                                </div>
                            <?php endif; ?> -->
                            <a href="https://www.youtube.com/@elordaaqparat2341" target="_blank" class="widget__youtube-header">
                                <img src="../img/el-h-2.jpg" alt="">
                            </a>
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Sn_8FJkgANI?si=0_41jzCRuncKqOWL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            <!-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script> -->
                            <!-- <div class="elfsight-app-c146067f-4880-4b8e-be10-919895c2a90f" data-elfsight-app-lazy></div> -->
                            <!--  -->
                        </div>
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
