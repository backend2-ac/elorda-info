<main>
    <div class="container">
        <div class="wrapper-parent">
            <div class="wrapper">
                <div class="wrapper-col">
                    <section class="hero news-page">
                        <div class="hero__container">
                            <ul class="breadcrumbs-absolute">
                                <li>
                                    <a href="/<?= $lang ?>"><?= __('Главная') ?></a>
                                </li>
                                <li>
                                    <?php if ($cur_cat): ?>
                                        <a href="#"><?= $cur_cat['title'] ?></a>
                                    <?php else: ?>
                                        <a href="#"><?= $l == 'kz' ? 'Барлық жаңалықтар' : 'Все новости' ?></a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                            <div class="hero__swiper swiper">
                            	<div class="swiper-wrapper">
                            		<?php if( $data ): ?>
										<?php foreach( $data as $index => $item ): ?>
                                            <?=$index?>
											<?php if($index < 2 ): ?>
											 <div class="swiper-slide">
	                                            <div class="hero__swiper-slide">
	                                                <div class="hero__swiper-img">
	                                                  <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" />
	                                                </div>
	                                                <div class="hero__swiper-tag">
		                                                	<?= __('Актуально') ?>
                                                		</div>
	                                                <div class="hero__swiper-title"><?= $item['title'] ?></div>
	                                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="hero__swiper-link">
	                                                    <?= __('Читать далее') ?>
	                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	                                                        <path d="M2.40002 13.2L13.2 2.40002M13.2 2.40002H2.40002M13.2 2.40002V13.2" stroke="white" stroke-width="2" stroke-linecap="round"/>
	                                                    </svg>
	                                                </a>
	                                            </div>
	                                        </div>
	                                        <?php endif ?>
										<?php endforeach; ?>
									<?php endif ?>
                                </div>
                                <div class="swiper-pagination"></div>
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
                        	<?php if( $data ): ?>
                            <?php foreach( $last_news as $index => $item ): ?>
                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                    <div class="news-actual__item-img">
                                        <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
                                        </div>
                                        <div href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item-title"><?= $item['title'] ?></div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </div>
                        <div class="news-actual__items" data-id="2">
                        	<?php if( $popular_news ): ?>
                            <?php foreach( $popular_news as $index => $item ): ?>
                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news-actual__item">
                                    <div class="news-actual__item-img">
                                        <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="<?= $item['title'] ?>">
                                    </div>
                                    <div class="news-actual__item-info">
                                        <div class="news-actual__item-date">
                                            <?= $this->Time->format($item['date'], 'dd.MM.yyyy | HH:mm') ?>
                                        </div>
                                        <div href='/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>' class="news-actual__item-title"><?= $item['title'] ?></div>
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
                </div>
            </div>
            <section class="news">
                <div class="news__container block">
                    <div class="news__items">
                    	<?php if( $data ): ?>
	                    	<?php foreach( $data as $index => $item ): ?>
								<?php if($index >= 2 ): ?>
								 <div class="news__item">
		                            <a href="<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news__item-img">
		                                <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" />
		                                <div class="news__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy') ?></div>
		                            </a>
		                            <div class="news__item-info">
		                            	<?php if( $item['tags'] ): ?>
											<div class="news__item-tags">
			                                	<?php foreach( $item['tags'] as $tag ): ?>
													<a href="/<?= $lang ?>tag/<?= $tag['alias'] ?>" class="news__item-tag">#<?= $tag['title'] ?></a>
												<?php endforeach; ?>
			                                </div>
										<?php endif; ?>
		                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news__item-title"><?= $item['title'] ?></a>
		                                <div class="news__item-text"><?= $item['short_desc'] ?></div>
		                                <div class="news__item-watch">
		                                    <img src="/img/watch-gray.png" alt="">
		                                     <?= number_format($item['views'], 0, '', ' ') ?>
		                                </div>
		                            </div>
		                        </div>
		                        <?php endif ?>
							<?php endforeach; ?>
                            <ul class="rubric__pagination pagination">
                                <?php
                                $cur_lang = '';
                                if( $l != 'kz' ){
                                    $cur_lang = $l;
                                }

                                $paginator_query = $this->request->getQuery();
                                unset($paginator_query['page']);

                                $this->Paginator->options([
                                    'url' => [
                                         $cur_cat['alias'],
                                        'lang' => $cur_lang,
                                        '?' => $paginator_query,
                                    ],
                                ]);

                                $this->Paginator->setTemplates([
                                    'prevActive' => '<li class="prev"><a href="{{url}}">'. __('Назад') .'</a></li>',
                                    'nextActive' => '<li class="next"><a href="{{url}}">'. __('Вперед') .'</a></li>',
                                    'number' => '<li><a href="{{url}}">{{text}}</a></li>',
                                    'current' => '<li class="active"><a>{{text}}</a></li>',
                                ]);

                                if( $this->Paginator->hasPrev() ){
                                    echo $this->Paginator->prev('<');
                                }

                                echo $this->Paginator->numbers([
                                    'first' => 1, 'last' => 1, 'modulus' => 2,
                                ]);

                                if( $this->Paginator->hasNext() ){
                                    echo $this->Paginator->next('>');
                                }
                                ?>
                            </ul>
                        <?php else: ?>
                            <p><?= __('К сожалению по вашему запросу ничего не найдено') ?> ...</p>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="loader">
                        <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_121_1202)">
                            <path d="M28.789 12.866C32.3418 12.866 35.222 9.98587 35.222 6.43302C35.222 2.88016 32.3418 0 28.789 0C25.2361 0 22.356 2.88016 22.356 6.43302C22.356 9.98587 25.2361 12.866 28.789 12.866Z" fill="#1D489C"/>
                            <path d="M28.789 55C30.9204 55 32.6484 53.2721 32.6484 51.1406C32.6484 49.0092 30.9204 47.2812 28.789 47.2812C26.6575 47.2812 24.9296 49.0092 24.9296 51.1406C24.9296 53.2721 26.6575 55 28.789 55Z" fill="#1D489C"/>
                            <path d="M12.9819 18.7689C16.1797 18.7689 18.772 16.1765 18.772 12.9787C18.772 9.78093 16.1797 7.1886 12.9819 7.1886C9.7841 7.1886 7.19177 9.78093 7.19177 12.9787C7.19177 16.1765 9.7841 18.7689 12.9819 18.7689Z" fill="#1D489C"/>
                            <path d="M44.5959 47.8072C46.3723 47.8072 47.8124 46.3671 47.8124 44.5907C47.8124 42.8142 46.3723 41.3741 44.5959 41.3741C42.8195 41.3741 41.3794 42.8142 41.3794 44.5907C41.3794 46.3671 42.8195 47.8072 44.5959 47.8072Z" fill="#1D489C"/>
                            <path d="M6.4341 33.933C9.2757 33.933 11.5793 31.6295 11.5793 28.7879C11.5793 25.9463 9.2757 23.6427 6.4341 23.6427C3.59251 23.6427 1.28894 25.9463 1.28894 28.7879C1.28894 31.6295 3.59251 33.933 6.4341 33.933Z" fill="#1D489C"/>
                            <path d="M51.1417 31.3573C52.5619 31.3573 53.7133 30.206 53.7133 28.7858C53.7133 27.3656 52.5619 26.2142 51.1417 26.2142C49.7215 26.2142 48.5702 27.3656 48.5702 28.7858C48.5702 30.206 49.7215 31.3573 51.1417 31.3573Z" fill="#1D489C"/>
                            <path d="M9.79882 41.4118C9.38039 41.8296 9.04844 42.3257 8.82195 42.8719C8.59546 43.4181 8.47888 44.0036 8.47888 44.5949C8.47888 45.1862 8.59546 45.7717 8.82195 46.3179C9.04844 46.864 9.38039 47.3602 9.79882 47.778C10.2166 48.1964 10.7128 48.5284 11.259 48.7549C11.8052 48.9814 12.3906 49.0979 12.9819 49.0979C13.5732 49.0979 14.1587 48.9814 14.7049 48.7549C15.2511 48.5284 15.7473 48.1964 16.165 47.778C16.5835 47.3602 16.9154 46.864 17.1419 46.3179C17.3684 45.7717 17.485 45.1862 17.485 44.5949C17.485 44.0036 17.3684 43.4181 17.1419 42.8719C16.9154 42.3257 16.5835 41.8296 16.165 41.4118C15.7485 40.9911 15.2528 40.6571 14.7064 40.4292C14.16 40.2013 13.5739 40.084 12.9819 40.084C12.3899 40.084 11.8038 40.2013 11.2575 40.4292C10.7111 40.6571 10.2153 40.9911 9.79882 41.4118Z" fill="#1D489C"/>
                            <path d="M44.5939 14.9074C45.6591 14.9074 46.5226 14.0439 46.5226 12.9787C46.5226 11.9135 45.6591 11.05 44.5939 11.05C43.5288 11.05 42.6653 11.9135 42.6653 12.9787C42.6653 14.0439 43.5288 14.9074 44.5939 14.9074Z" fill="#1D489C"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_121_1202">
                            <rect width="55" height="55" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                        Загрузка
                    </div> -->
                </div>
            </section>
        </div>
    </div>
</main>
