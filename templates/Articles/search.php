 <!-- <main>
	<section class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs__container">
				<?php if( $search_mode == 'tag' ): ?>
					<?php if( $cur_tag ): ?>
						<h1>Тег: #<?= $cur_tag['title'] ?></h1>
					<?php else: ?>
						<h1>Тег не найден</h1>
					<?php endif; ?>

				<?php else: ?>
					<h1>Поиск</h1>
				<?php endif; ?>

				<ul class="breadcrumbs__list">
					<li><a href="/<?= $lang ?>"><?= __('Главная') ?></a></li>
					<li class="active">Поиск</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="search section">
		<div class="container">
			<div class="search__container">
				<?php if( $search_mode == 'tag' ): ?>
					<form id="sorting" class="search__sort form sorting" action="/<?= $lang ?>search" method="GET">
						<div class="sorting__wrap">
							<span class="sort__sp">Сортировать по: </span>
							<select name="sorting" id="" class="sort__select custom-select" onchange="this.form.submit();">
								<option value="date_desc" <?= (!$chkd_sort || $chkd_sort == 'date_desc') ? 'selected' : '' ?> >сначала свежие</option>
								<option value="date_asc" <?= ($chkd_sort == 'date_asc') ? 'selected' : '' ?> >сначала старые</option>
								<option value="title_asc" <?= ($chkd_sort == 'title_asc') ? 'selected' : '' ?> >А-Я</option>
								<option value="title_desc" <?= ($chkd_sort == 'title_desc') ? 'selected' : '' ?> >Я-А</option>
							</select>
						</div>
						<input type="hidden" name="tag_id" value="<?= ($cur_tag) ? $cur_tag['id'] : '' ?>">
						<input type="text" id="form__sort" value="<?= $chkd_sort ?>">
					</form>

				<?php else: ?>
					<form id="search" class="search__form form" action="/<?= $lang ?>search" method="GET">
						<div class="form__wrap">
							<!-- <input type="text" id="date-mask" class="form__date" placeholder="dd/mm/yyyy"
							onkeyup="
							let v = this.value;
							if (v.match(/^\d{2}$/) !== null) {
								this.value = v + '/';
							} else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
								this.value = v + '/';
							}"
							maxlength="10"> -->
							<!-- <input type="date" class="form__date" name="date" placeholder="дд.мм.гггг" value="<?= ($chkd_date) ? $chkd_date : '' ?>"> -->
							<!-- <input type="text" placeholder="дд.мм.гггг" class="form__date" name="date"
							onfocus="this.type='date';this.focus();" 
   						onblur="if(this.value == '') this.type='text';"> -->
							<!-- <div class="date__box dateclass" placeholder="дд.мм.гггг">
								<input
								type="date"
								value="<?= ($chkd_date) ? $chkd_date : '' ?>"
								class="form__date">
							</div> 
							<input type="text" class="form__search" name="q_str" placeholder="Введите поисковой запрос..." value="<?= $str ?>">
							<div class="form__check">
								<label class="custom__check">
									<input type="checkbox" name="search_type[]" id="" value="author" <?= ($chkd_types && in_array('author', $chkd_types)) ? 'checked' : '' ?> >
									<span>по автору</span>
								</label>
								<label class="custom__check">
									<input type="checkbox" name="search_type[]" id="" value="tag" <?= ($chkd_types && in_array('tag', $chkd_types)) ? 'checked' : '' ?> >
									<span>по тегу</span>
								</label>
								<label class="custom__check">
									<input type="checkbox" name="search_type[]" id="" value="text" <?= ($chkd_types && in_array('text', $chkd_types)) ? 'checked' : '' ?> >
									<span>по тексту</span>
								</label>
							</div>
							<input type="text" id="form__sort" name="sorting" value="<?= $chkd_sort ?>">
							<button class="form__btn button">Найти</button>
						</div>
						  <!-- <ul class="search__tags tags">
							<li><a>Теги</a></li>
							<li><a href="">#tesla</a></li>
							<li><a href="">#автомобиль</a></li>
							<li><a href="">#modely</a></li>
						</ul> 
					</form>
					<div id="sorting__box" class="search__sort form sorting">
						<div class="sorting__wrap">
							<span class="sort__sp">Сортировать по: </span>
							<select name="sorting" id="" class="sort__select custom-select">
								<option value="date_desc" <?= (!$chkd_sort || $chkd_sort == 'date_desc') ? 'selected' : '' ?> >сначала свежие</option>
								<option value="date_asc" <?= ($chkd_sort == 'date_asc') ? 'selected' : '' ?> >сначала старые</option>
								<option value="title_asc" <?= ($chkd_sort == 'title_asc') ? 'selected' : '' ?> >А-Я</option>
								<option value="title_desc" <?= ($chkd_sort == 'title_desc') ? 'selected' : '' ?> >Я-А</option>
							</select>
						</div>
					</div>
				<?php endif; ?>

				<?php if( $data ): ?>
					<div class="search__result">
						<div class="search__cards cards_cl-3">
							<?php foreach( $data as $item ): ?>
								<a href="/<?= $lang ?><?= $categories_slug_parts[$full_categories[$item['category_id']]['alias']] ?>/<?= $item['alias'] ?>" class="search__card card card_lg">
									<div class="card__img">
										<img src="/img/articles/<?= $item['img'] ?>" alt="" />
									</div>
									<div class="card__description">
										<?php if( $item['rubric'] ): ?>
											<span class="card__type"><?= $item['rubric']['title'] ?></span>
										<?php endif; ?>
										<h5 class="card__caption"><?= $item['title'] ?></h5>
										<div class="card__elements">
											<div class="card__date card__elem">
												<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" >
													<path d="M7 13C10.3137 13 13 10.3137 13 7C13 3.68629 10.3137 1 7 1C3.68629 1 1 3.68629 1 7C1 10.3137 3.68629 13 7 13Z" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M7 3.40002V7.00002L9.4 8.20002" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" />
												</svg>
												<span><?= $this->Time->format($item['date'], 'dd.MM.yyyy HH:mm') ?></span>
											</div>
											<?php if( false ): ?>
												<div class="card__view card__elem">
													<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg" >
														<path d="M1 7C1 7 3.57143 1 9.57143 1C15.5714 1 18.1429 7 18.1429 7C18.1429 7 15.5714 13 9.57143 13C3.57143 13 1 7 1 7Z" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M9.57143 9.57145C10.9916 9.57145 12.1429 8.42018 12.1429 7.00002C12.1429 5.57986 10.9916 4.42859 9.57143 4.42859C8.15127 4.42859 7 5.57986 7 7.00002C7 8.42018 8.15127 9.57145 9.57143 9.57145Z" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" />
													</svg>
													<span><?= number_format($item['views'], 0, '', ' ') ?></span>
												</div>
											<?php endif; ?>
										</div>
										<div class="card__txt"><?= $item['short_desc'] ?></div>
									</div>
								</a>
							<?php endforeach; ?>
						</div>
						<ul class="rubric__pagination pagination">
							<?php 
								$cur_lang = '';
								if( $l != 'ru' ){
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
					<p>К сожалению по вашему запросу ничего не найдено ...</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<div id="popup__form" class="popup popup-fr">
		<div class="popup__container popup-fr__container">
			<button class="popup__close">
				<svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M21 38.5C30.665 38.5 38.5 30.665 38.5 21C38.5 11.335 30.665 3.5 21 3.5C11.335 3.5 3.5 11.335 3.5 21C3.5 30.665 11.335 38.5 21 38.5Z" fill="#EBEBEB"/>
					<path d="M26.25 15.75L15.75 26.25" stroke="#393939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M15.75 15.75L26.25 26.25" stroke="#393939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>        
			</button>
			<form action="" class="feetback__form">
				<div class="feetback__box">
					<span>Введите имя</span>
					<input type="text" name="" id="" placeholder="Имя">
				</div>
				<div class="feetback__box">
					<span>Введите телефон</span>
					<input type="text" name="" id="" placeholder="+7 (111) 111-11-11">
				</div>
				<div class="feetback__box">
					<span>Задайте вопрос</span>
					<textarea name="" id="" placeholder="Например, как купить машину выгодно..."></textarea>
				</div>
				<button class="feetback__btn button">Отправить</button>
			</form>      
		</div>
	</div>
</main> -->
<main>
        <div class="container">
            <div class="wrapper-parent">
                <section class="search">
                    <div class="search__container block">
                        <ul class="breadcrumbs">
                            <li>
                                <a href="#">Главная</a>
                            </li>
                            <li>
                                <a href="#">О медиахолдинге</a>
                            </li>
                        </ul>
                        <h2 class="search__title title">Результаты по вашему запросу</h2>
                        <form action="/<?= $lang ?>search" method="GET">
                            <div class="search__form">
                                <label for="search" class="search__form-input">
                                    <input type="text" placeholder="Запрос"  name="q_str" id="search" value="<?= $str ?>">
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
	                                        <div>Все</div>
	                                    </label>
                                		<?php foreach( $tags as   $tag ): ?>
                                			
			                                    <label for="<?= $tag['id'] ?>" class="search__form-tag">
			                                        <input type="checkbox" id="<?= $tag['id'] ?>"
			                                         <?php if( $tags_ids): ?>
			                                         	<?php foreach( $tags_ids as   $id ): ?>
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
                                   <!--  <label for="search-3" class="search__form-tag">
                                        <input type="checkbox" id="search-3">
                                        <div>Культура</div>
                                    </label>
                                    <label for="search-4" class="search__form-tag">
                                        <input type="checkbox" id="search-4">
                                        <div>Политика</div>
                                    </label>
                                    <label for="search-5" class="search__form-tag">
                                        <input type="checkbox" id="search-5">
                                        <div>Экономика</div>
                                    </label>
                                    <label for="search-6" class="search__form-tag">
                                        <input type="checkbox" id="search-6">
                                        <div>Социум</div>
                                    </label> -->
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
	                                    <img src="/img/articles/<?= $item['img'] ?>" alt="">
	                                    <div class="news__item-date"><?= $this->Time->format($item['date'], 'dd.MM.yyyy HH:mm') ?></div>
	                                </a>
	                                <div class="news__item-info">
	                                	<?php if( $item['tags'] ): ?>
	                                		<div class="news__item-tags">

	                                		<?php foreach( $item['tags']as   $tag ): ?>
		                                        <a href="/<?= $lang ?>search?tag_id=<?= $tag['id'] ?>" class="news__item-tag"><?= $tag['title'] ?></a>
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
								
							<?php endforeach; ?>
						</div>
							<ul class="rubric__pagination pagination">
								<?php 
									$cur_lang = '';
									if( $l != 'ru' ){
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
							<p>К сожалению по вашему запросу ничего не найдено ...</p>
						<?php endif; ?>
                            
                       
                    </div>
                </section>
            </div>
        </div>
    </main>