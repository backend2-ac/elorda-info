
<main>
        <div class="container">
            <div class="wrapper-parent">
                <section class="search">
                    <div class="search__container block">
                        <ul class="breadcrumbs">
                            <li>
                                <a href="/<?= $lang ?>"><?= __('Главная') ?></a>
                            </li>
                            <li>
                                <a href="#"><?= __('Поиск') ?></a>
                            </li>
                        </ul>
                        <h2 class="search__title title"><?= __('Результаты по вашему запросу') ?></h2>
                        <form action="/<?= $lang ?>search" method="GET">
                            <div class="search__form">
                                <label for="search" class="search__form-input">
                                    <input type="text" placeholder="<?= __('Поиск') ?>"  name="q" id="search" value="<?= $search_text ?>" required>
                                    <button type="submit">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="10.9985" cy="10.7888" r="8.03854" stroke="#1D489C" stroke-width="2" stroke-linecap="square"/>
                                            <path d="M16.4873 16.7084L21.0408 21.25" stroke="#1D489C" stroke-width="2" stroke-linecap="square"/>
                                        </svg>
                                    </button>
                                </label>
                                <div class="search__form-tags">
                                	<?php if( $tags ): ?>
                                		 <label for="search-1" class="search__form-tag">
	                                        <input type="checkbox" id="search-1">
	                                        <div><?= __('Все') ?></div>
	                                    </label>
                                		<?php foreach( $tags as   $tag ): ?>
			                                    <label for="search-<?= $tag['id'] ?>" class="search__form-tag">
			                                        <input type="checkbox" id="search-<?= $tag['id'] ?>"
			                                         <?php if($selected_tag_ids): ?>
			                                         	<?php foreach( $selected_tag_ids as   $id ): ?>
			                                         		<?=$id?>
			                                         		 <?php if( $id == $tag['id'] ): ?>
			                                         			checked=""
			                                         	<?php endif; ?>
			                                         <?php endforeach; ?>
		                                    		 <?php endif; ?>
			                                         name="tags[]" value="<?=$tag['id']?>">
			                                        <div><?= $tag['title'] ?></div>
			                                    </label>
	                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                        	<?php if( $data ): ?>
						<div class="search__result">
						<div class="news__items">
							<?php foreach( $data as $item ): ?>
								<div class="news__item">
	                                <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news__item-img">
	                                    <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="">
	                                    <div class="news__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy HH:mm') ?></div>
	                                </a>
	                                <div class="news__item-info">
	                                	<?php if( $item['tags'] ): ?>
	                                		<div class="news__item-tags">

	                                		<?php foreach( $item['tags']as   $tag ): ?>
		                                        <a href="/<?= $lang ?>tag/<?= $tag['alias'] ?>" class="news__item-tag"><?= $tag['title'] ?></a>
		                                    <?php endforeach; ?>
		                                    </div>

										<?php endif; ?>

	                                    <a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="news__item-title"><?= $item['title'] ?></a>
                                        <?php
                                        $body_text = strip_tags($item['body']);
                                        $short_desc = mb_substr($body_text, 0, 260);
                                        $short_desc = substr($short_desc, 0, strrpos($short_desc, ' '));
                                        ?>
                                        <div class="news__item-text"><?= $short_desc ?></div>
<!--	                                    <div class="news__item-watch">-->
<!--	                                        <img src="/img/watch-gray.png" alt="">-->
<!--	                                        --><?php //= number_format($item['views'], 0, '', ' ') ?>
<!--	                                    </div>-->
	                                </div>
	                            </div>
							<?php endforeach; ?>
						</div>
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
											// $cur_cat['alias'],
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
						</div>

						<?php else: ?>
							<p><?= __('К сожалению по вашему запросу ничего не найдено') ?> ...</p>
						<?php endif; ?>


                    </div>
                </section>
            </div>
        </div>
    </main>
