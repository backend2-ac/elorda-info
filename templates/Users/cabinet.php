<?php 
	$cur_role = '';
	if( $userAuth['role'] == 'author' ){
		$cur_role = 'author';
	} elseif( $userAuth['role'] == 'reviewer' ){
		$cur_role = 'reviewer';
	}
?>

<main>
	<section class="art">
		<div class="container">
			<div class="art__container content">
				<h2 class="art__title title">
					<?php if( $cur_role == 'author' ): ?>
						<span>Личный кабинет Автора</span>
					<?php elseif( $cur_role == 'reviewer' ): ?>
						<span>Личный кабинет Рецензента</span>
					<?php else: ?>
						<span>Личный кабинет</span>
					<?php endif; ?>
				</h2>
				<div class="art__box">
					<div class="art__box-header">
						<div class="art__box-title">
							<span>Данные</span>
							<a href="javascript:;" class="art__box-title-js">Данные
								<svg width="14" height="6" viewBox="0 0 14 6" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7 6L13.0622 0H0.937822L7 6Z" fill="#949494"/>
								</svg>
							</a>
						</div>
						<a href="/<?= $lang ?>users/security" class="art__box-link">Изменить пароль</a>
					</div>
					<div class="art__box-form">
						<?php echo $this->Form->create($userAuth, [
								'url' => '/'.$lang.'users/cabinet',
								'type' => 'file',
								'onsubmit' => 'submitForm()',
							]); ?>
							<?= $this->Form->hidden('id'); ?>
							<div class="form-col">
								<span>Имя</span>
								<?= $this->Form->input('name', array('id' => 'lname', 'class' => 'art__box-input', 'placeholder' => 'Введите Имя', 'required')); ?>
							</div>
							<div class="form-col">
								<span>Фамилия</span>
								<?= $this->Form->input('surname', array('id' => 'lsurname', 'class' => 'art__box-input', 'placeholder' => 'Введите Фамилию', 'required')); ?>
							</div>
							<div class="form-col">
								<span>Электронная почта</span>
								<div class="art__box-input"><?= $userAuth['username'] ?></div>
							</div>
							<div class="form-col">
								<span>Телефон</span>
								<?= $this->Form->tel('phone', array('id' => 'lphone', 'class' => 'art__box-input', 'placeholder' => 'Введите телефон', 'required')); ?>
							</div>
							<div class="form-col">
								<input type="submit" value="Сохранить изменения" class="art__box-submit">
							</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>

				<!-- Удалить после исправления шапки для ЛК BEGIN -->
					<p>
						<a href="/<?= $lang ?>users/logout">Выйти</a>
					</p>
					<br>
				<!-- Удалить после исправления шапки для ЛК END -->

				<?php if( $cur_role == 'author' ): ?>

					<div class="art__box">
						<div class="art__box-header">
							<div class="art__box-title">Мои статьи</div>
							<a href="javascript:;" class="art__box-link yellow add-article-link">Добавить статью</a>
						</div>
						<?php if( $articles ): ?>
							<div class="art__items">
								<?php foreach( $articles as $item ): ?>
									<div class="art__item" data-id="<?= $item['id'] ?>">
										<table class="data" border="1">
											<tr>
												<th>Дата последнего редактирования</th>
												<th>Серия журнала</th>
												<th>Файл</th>
												<th>Название статьи</th>
												<th>Статус</th>
												<th>Действия</th>
											</tr>
											<tr>
												<td><?= ($item['user_updated_at']) ? $this->Time->format($item['user_updated_at'], 'dd.MM.yyyy') : '-' ?></td>
												<td><?= $journals_series[$item['journals_series_id']] ?></td>
												<td><a href="/files/articles/<?= $item['doc'] ?>" download="<?= $item['id'].'-'.$item['title'] ?>">Скачать</a></td>
												<td><?= $item['title'] ?></td>
												<td>
													<span class="status success active status_<?= $item['status'] ?>"><?= $articles_statuses[$item['status']] ?></span>
												</td>
												<td>
													<?php if( $item['status'] == 'for_correction' ): ?>
														<button class="table-button js-edit active">Редактировать</button>
													<?php endif; ?>
													<button class="table-button js-view active">Просмотр</button>
												</td>
											</tr>
										</table>
										<?php if( $item['comment'] || $item['admin_updated_at'] ): ?>
											<div class="art__item-box">
												<div class="art__item-header">
													<div class="art__item-title">Комментарий администратора</div>
													<a href="javascript:;" class="art__item-link">
														<span class="hide">Скрыть</span>
														<span class="show active">Показать</span>
													</a>
												</div>
												<div class="table">
													<table class="admin" border="1">
														<tr>
															<th>Дата последнего редактирования</th>
															<th>Комментарий</th>
														</tr>
														<tr>
															<td><?= ($item['admin_updated_at']) ? $this->Time->format($item['admin_updated_at'], 'dd.MM.yyyy') : '-' ?></td>
															<td><?= $item['comment'] ?></td>
														</tr>
													</table>
												</div>
											</div>
										<?php endif; ?>

										<?php if( $item['users_articles'] ): ?>
											<div class="art__item-box">
												<div class="art__item-header">
													<div class="art__item-title">Комментарии рецензентов</div>
													<a href="javascript:;" class="art__item-link">
														<span class="hide">Скрыть</span>
														<span class="show active">Показать</span>
													</a>
												</div>
												<div class="table">
													<table class="reviewer" border="1">
														<tr>
															<th>Дата последнего редактирования</th>
															<th>Актуальность</th>
															<th>Структура</th>
															<th>Новизна</th>
															<th>Методология</th>
															<th>Ценность</th>
															<th>Литература</th>
														</tr>
														<?php foreach( $item['users_articles'] as $rev_comment ): ?>
															<tr>
																<td><?= $this->Time->format($rev_comment['updated_at'], 'dd.MM.yyyy') ?></td>
																<td>
																	<div><?= $rev_comment['actuality'] ?></div>
																</td>
																<td>
																	<div><?= $rev_comment['structure'] ?></div>
																</td>
																<td>
																	<div><?= $rev_comment['novelty'] ?></div>
																</td>
																<td>
																	<div><?= $rev_comment['innovation'] ?></div>
																</td>
																<td>
																	<div><?= $rev_comment['quality'] ?></div>
																</td>
																<td>
																	<div><?= $rev_comment['lit_level'] ?></div>
																</td>
															</tr>
														<?php endforeach; ?>
													</table>
												</div>
											</div>
										<?php endif; ?>
										<div hidden style="display: none;"><?= json_encode($item); ?></div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php else: ?>
							<p>У вас пока нет статей</p>
						<?php endif; ?>
					</div>

					<?php if( $articles ): ?>
						<ul class="pagination">
							<?php 
								$cur_lang = '';
								if( $l != 'ru' ){
									$cur_lang = $l;
								}

								$paginator_query = $this->request->getQuery();
								unset($paginator_query['page']);

								$this->Paginator->options([
									'url' => [
										'lang' => $cur_lang,
										'?' => $paginator_query,
									]
								]);

								$this->Paginator->setTemplates([
									'prevActive' => '<li class="pagination__item prev-arr"><a href="{{url}}" class="pagination__item-link"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><circle r="25" transform="matrix(-1 0 0 1 25 25)" fill="#FEED01"/><path d="M14.2929 25.7071C13.9024 25.3166 13.9024 24.6834 14.2929 24.2929L20.6569 17.9289C21.0474 17.5384 21.6805 17.5384 22.0711 17.9289C22.4616 18.3195 22.4616 18.9526 22.0711 19.3431L16.4142 25L22.0711 30.6569C22.4616 31.0474 22.4616 31.6805 22.0711 32.0711C21.6805 32.4616 21.0474 32.4616 20.6569 32.0711L14.2929 25.7071ZM35 26H15V24H35V26Z" fill="black"/></svg></a></li>',
									'nextActive' => '<li class="pagination__item nexr-arr"><a href="{{url}}" class="pagination__item-link"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="25" cy="25" r="25" fill="#FEED01"/><path d="M35.7071 25.7071C36.0976 25.3166 36.0976 24.6834 35.7071 24.2929L29.3431 17.9289C28.9526 17.5384 28.3195 17.5384 27.9289 17.9289C27.5384 18.3195 27.5384 18.9526 27.9289 19.3431L33.5858 25L27.9289 30.6569C27.5384 31.0474 27.5384 31.6805 27.9289 32.0711C28.3195 32.4616 28.9526 32.4616 29.3431 32.0711L35.7071 25.7071ZM15 26H35V24H15V26Z" fill="black"/></svg></a></li>',
									'number' => '<li class="pagination__item"><a href="{{url}}" class="pagination__item-link">{{text}}</a></li>',
									'current' => '<li class="pagination__item"><a href="{{url}}" class="pagination__item-link active">{{text}}</a></li>',
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
					<?php endif; ?>

				<?php elseif( $cur_role == 'reviewer' ): ?>

					<div class="rev__header">
						<div class="rev__header-title">Статьи на проверку</div>
					</div>

					<?php if( $articles ): ?>
						<div class="rev__box">
							<div class="rev__items">
								<?php foreach( $articles as $item ): ?>
									<?php if( $item['status'] == 'canceled' ): ?>
										<div class="rev__delete">
											<table border="1">
												<tr>
													<th>Серия журнала</th>
													<th>Название статьи</th>
												</tr>
												<tr>
													<td><?= $journals_series[$item['article']['journals_series_id']] ?></td>
													<td><?= $item['article']['title'] ?></td>
												</tr>
											</table>
											<div class="rev__delete-title">Вы больше не являетесь рецензентом данной статьи</div>
										</div>
									<?php else: ?>
										<div class="rev__item">
											<table border="1">
												<tr>
													<th>Статус файла</th>
													<th>Дата последнего редактирования</th>
													<th>Серия журнала</th>
													<th>Название статьи</th>
													<th>Файл</th>
												</tr>
												<tr>
													<td>
														<span class="new status_<?= $item['status'] ?>"><?= $users_articles_statuses[$item['status']] ?></span>
														<!-- <span class="corrected">Исправлено</span> -->
													</td>
													<td><?= $this->Time->format($item['article']['updated_at'], 'dd.MM.yyyy') ?></td>
													<td><?= $journals_series[$item['article']['journals_series_id']] ?></td>
													<td><?= $item['article']['title'] ?></td>
													<td><a href="/files/articles/<?= $item['article']['doc'] ?>" download="<?= $item['article']['id'].'-'.$item['article']['title'] ?>">Скачать</a></td>
												</tr>
											</table>
											<div class="rev__item-box">
												<div class="rev__item-header">
													<div class="rev__item-title">Оставить комментарии к категориям</div>
													<a href="javascript:;" class="rev__item-link">
														<span class="show">Показать</span>
														<span class="hide">Скрыть</span>
														<svg width="14" height="6" viewBox="0 0 14 6" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M7 6L13.0622 0H0.937822L7 6Z" fill="#949494"/>
														</svg>
													</a>
												</div>
												<?php echo $this->Form->create($item, [
														'url' => '/'.$lang.'users/users-article-edit/'.$item['id'],
													    'type' => 'file',
													    'onsubmit' => 'submitForm()',
													    'class' => 'rev__item-form'
													]); ?>

													<?php 
														$has_edit = true; 
														$is_disabled = '';
														if( $item['status'] == 'new' || $item['status'] == 'for_correction' || $item['status'] == 'fixed' ){
															$has_edit = true;
														} else{
															$has_edit = false;
														}

														if( $has_edit ){
															$is_disabled = '';
														} else{
															$is_disabled = 'disabled';
														}
													?>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Актуальность</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('actuality', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Структура</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('structure', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Новизна</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('novelty', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Методология</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('innovation', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Ценность</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('quality', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<div class="rev__item-com">
														<div class="rev__item-headline">
															<div class="rev__item-name">Литература</div>
															<div class="rev__item-desc">Важность, полезность и/или применимость идей, методов, технологий</div>
														</div>
														<?= $this->Form->textarea('lit_level', array('placeholder' => 'Оставьте комментарий', $is_disabled)); ?>
													</div>
													<?php if( $has_edit ): ?>
														<div class="rev__item-status">
															<div class="rev__item-select">
																<span>Проставить статус статьи</span>
																<?= $this->Form->select('status', $users_articles_statuses, array('empty' => 'Выберите статус', 'required', 'default' => $item['status'], 'disabled' => $system_statuses)) ?>
															</div>
															<div class="rev__item-submit">
																<span>Последние изменения: <?= $this->Time->format($item['updated_at'], 'dd.MM.yyyy') ?></span>
																<input type="submit" value="Сохранить изменения">
															</div>
														</div>
													<?php endif; ?>
												<?php echo $this->Form->end(); ?>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
						<ul class="pagination">
							<?php 
								$cur_lang = '';
								if( $l != 'ru' ){
									$cur_lang = $l;
								}

								$paginator_query = $this->request->getQuery();
								unset($paginator_query['page']);

								$this->Paginator->options([
									'url' => [
										'lang' => $cur_lang,
										'?' => $paginator_query,
									]
								]);

								$this->Paginator->setTemplates([
									'prevActive' => '<li class="pagination__item prev-arr"><a href="{{url}}" class="pagination__item-link"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><circle r="25" transform="matrix(-1 0 0 1 25 25)" fill="#FEED01"/><path d="M14.2929 25.7071C13.9024 25.3166 13.9024 24.6834 14.2929 24.2929L20.6569 17.9289C21.0474 17.5384 21.6805 17.5384 22.0711 17.9289C22.4616 18.3195 22.4616 18.9526 22.0711 19.3431L16.4142 25L22.0711 30.6569C22.4616 31.0474 22.4616 31.6805 22.0711 32.0711C21.6805 32.4616 21.0474 32.4616 20.6569 32.0711L14.2929 25.7071ZM35 26H15V24H35V26Z" fill="black"/></svg></a></li>',
									'nextActive' => '<li class="pagination__item nexr-arr"><a href="{{url}}" class="pagination__item-link"><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="25" cy="25" r="25" fill="#FEED01"/><path d="M35.7071 25.7071C36.0976 25.3166 36.0976 24.6834 35.7071 24.2929L29.3431 17.9289C28.9526 17.5384 28.3195 17.5384 27.9289 17.9289C27.5384 18.3195 27.5384 18.9526 27.9289 19.3431L33.5858 25L27.9289 30.6569C27.5384 31.0474 27.5384 31.6805 27.9289 32.0711C28.3195 32.4616 28.9526 32.4616 29.3431 32.0711L35.7071 25.7071ZM15 26H35V24H15V26Z" fill="black"/></svg></a></li>',
									'number' => '<li class="pagination__item"><a href="{{url}}" class="pagination__item-link">{{text}}</a></li>',
									'current' => '<li class="pagination__item"><a href="{{url}}" class="pagination__item-link active">{{text}}</a></li>',
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
						<p>У вас нет статей для рецензирования</p>
					<?php endif; ?>

				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php if( $cur_role == 'author' ): ?>
	<!-- просмотр статьи -->
	<div class="popup-article">
		<div class="container">
			<div class="popup-article__box">
				<div class="popup-article__header">
					<div class="popup-article__title">Просмотр статьи</div>
					<a href="javascript:;" class="popup-article__close">
						<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.999 17.54L15.409 14L18.999 10.46C19.0989 10.3665 19.1785 10.2534 19.233 10.1278C19.2874 10.0023 19.3155 9.86686 19.3155 9.72999C19.3155 9.59313 19.2874 9.45772 19.233 9.33215C19.1785 9.20658 19.0989 9.09353 18.999 8.99999C18.9055 8.90731 18.7947 8.83399 18.6729 8.78422C18.5511 8.73446 18.4206 8.70923 18.289 8.70999C18.0266 8.7111 17.7752 8.81525 17.589 8.99999L13.999 12.59L10.459 8.99999C10.2727 8.81525 10.0213 8.7111 9.75899 8.70999C9.62738 8.70923 9.49692 8.73446 9.37508 8.78422C9.25325 8.83399 9.14243 8.90731 9.04899 8.99999C8.86274 9.18736 8.7582 9.44081 8.7582 9.70499C8.7582 9.96918 8.86274 10.2226 9.04899 10.41L12.589 14L9.04899 17.54C8.88516 17.7313 8.79956 17.9774 8.80928 18.229C8.819 18.4807 8.92333 18.7195 9.10143 18.8976C9.27952 19.0757 9.51826 19.18 9.76994 19.1897C10.0216 19.1994 10.2677 19.1138 10.459 18.95L13.999 15.41L17.539 18.95C17.6316 19.0459 17.7421 19.1225 17.8643 19.1757C17.9866 19.2288 18.1181 19.2574 18.2513 19.2597C18.3846 19.262 18.517 19.2381 18.641 19.1892C18.765 19.1404 18.8781 19.0676 18.974 18.975C19.0699 18.8824 19.1465 18.7719 19.1997 18.6496C19.2528 18.5274 19.2814 18.3959 19.2837 18.2627C19.286 18.1294 19.2621 17.997 19.2132 17.873C19.1644 17.749 19.0916 17.6359 18.999 17.54ZM23.899 4.09999C21.941 2.1422 19.4464 0.808969 16.7307 0.268892C14.015 -0.271185 11.2002 0.00614548 8.6421 1.06581C6.08402 2.12548 3.8976 3.9199 2.35933 6.22216C0.82105 8.52442 0 11.2311 0 14C0 16.7689 0.82105 19.4756 2.35933 21.7778C3.8976 24.0801 6.08402 25.8745 8.6421 26.9342C11.2002 27.9938 14.015 28.2712 16.7307 27.7311C19.4464 27.191 21.941 25.8578 23.899 23.9C25.1992 22.6 26.2305 21.0565 26.9342 19.3579C27.6378 17.6592 28 15.8386 28 14C28 12.1614 27.6378 10.3407 26.9342 8.64209C26.2305 6.94344 25.1992 5.40003 23.899 4.09999ZM22.489 22.49C20.8091 24.1641 18.6708 25.3028 16.3442 25.7625C14.0176 26.2221 11.6069 25.982 9.41663 25.0726C7.22634 24.1631 5.35466 22.625 4.03792 20.6525C2.72119 18.68 2.01845 16.3616 2.01845 13.99C2.01845 11.6184 2.72119 9.29997 4.03792 7.32748C5.35466 5.35499 7.22634 3.8169 9.41663 2.90743C11.6069 1.99795 14.0176 1.75788 16.3442 2.21753C18.6708 2.67718 20.8091 3.81593 22.489 5.48999C23.6077 6.60483 24.4953 7.92955 25.101 9.38817C25.7067 10.8468 26.0185 12.4106 26.0185 13.99C26.0185 15.5694 25.7067 17.1332 25.101 18.5918C24.4953 20.0504 23.6077 21.3752 22.489 22.49Z" fill="black"/>
						</svg>
					</a>
				</div>
				<div class="popup-article__form">
					<div class="popup-article__form-col">
						<span>Серия журнала</span>
						<div class="data"></div>
					</div>
					<div class="popup-article__form-col">
						<span>Файл</span>
						<div class="data"></div>
					</div>
					<div class="popup-article__form-col">
						<span>Дата редактирования статьи</span>
						<div class="data"></div>
					</div>
					<div class="popup-article__form-col">
						<span>Название статьи</span>
						<div class="data"></div>
					</div>
					<div class="popup-article__form-col">
						<span>Статус </span>
						<div class="data"></div>
					</div>
				</div>
				<div class="popup-article__admin">
					<div class="popup-article__admin-header">
						<div class="popup-article__admin-title">Комментарий администратора</div>
						<div class="popup-article__admin-date">Дата последнего редактирования администратора: <span></span></div>
					</div>
					<div class="popup-article__admin-comment"></div>
				</div>
				<div class="popup-article__wrapper">
					<div class="popup-article__reviewer">
						<div class="popup-article__reviewer-header">
							<div class="popup-article__reviewer-title">Комментарии <span>1</span> рецензента</div>
							<div class="popup-article__reviewer-date">Дата последнего редактирования 1 рецензента: <span></span></div>
						</div>
						<div class="popup-article__reviewer-items">
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Структура</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Новизна</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Методология</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Ценность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Литература</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
						</div>
					</div>
					<div class="popup-article__reviewer">
						<div class="popup-article__reviewer-header">
							<div class="popup-article__reviewer-title">Комментарии <span>2</span> рецензента</div>
							<div class="popup-article__reviewer-date">Дата последнего редактирования 2 рецензента: <span></span></div>
						</div>
						<div class="popup-article__reviewer-items">
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
							<div class="popup-article__reviewer-item">
								<span>Актуальность</span>
								<div class="popup-article__reviewer-info"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- добавление статьи -->
	<div class="popupform js-popup-add">
		<div class="popupform__block">
			<div class="popupform__block-header">
				<div class="popupform__block-title">Добавить статью</div>
				<div class="popupform__block-close">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.999 19.54L17.409 16L20.999 12.46C21.0989 12.3665 21.1785 12.2534 21.233 12.1278C21.2874 12.0023 21.3155 11.8669 21.3155 11.73C21.3155 11.5931 21.2874 11.4577 21.233 11.3322C21.1785 11.2066 21.0989 11.0935 20.999 11C20.9055 10.9073 20.7947 10.834 20.6729 10.7842C20.5511 10.7345 20.4206 10.7092 20.289 10.71C20.0266 10.7111 19.7752 10.8152 19.589 11L15.999 14.59L12.459 11C12.2727 10.8152 12.0213 10.7111 11.759 10.71C11.6274 10.7092 11.4969 10.7345 11.3751 10.7842C11.2532 10.834 11.1424 10.9073 11.049 11C10.8627 11.1874 10.7582 11.4408 10.7582 11.705C10.7582 11.9692 10.8627 12.2226 11.049 12.41L14.589 16L11.049 19.54C10.8852 19.7313 10.7996 19.9774 10.8093 20.229C10.819 20.4807 10.9233 20.7195 11.1014 20.8976C11.2795 21.0757 11.5183 21.18 11.7699 21.1897C12.0216 21.1994 12.2677 21.1138 12.459 20.95L15.999 17.41L19.539 20.95C19.6316 21.0459 19.7421 21.1225 19.8643 21.1757C19.9866 21.2288 20.1181 21.2574 20.2513 21.2597C20.3846 21.262 20.517 21.2381 20.641 21.1892C20.765 21.1404 20.8781 21.0676 20.974 20.975C21.0699 20.8824 21.1465 20.7719 21.1997 20.6496C21.2528 20.5274 21.2814 20.3959 21.2837 20.2627C21.286 20.1294 21.2621 19.997 21.2132 19.873C21.1644 19.749 21.0916 19.6359 20.999 19.54ZM25.899 6.09999C23.941 4.1422 21.4464 2.80897 18.7307 2.26889C16.015 1.72882 13.2002 2.00615 10.6421 3.06581C8.08402 4.12548 5.8976 5.9199 4.35933 8.22216C2.82105 10.5244 2 13.2311 2 16C2 18.7689 2.82105 21.4756 4.35933 23.7778C5.8976 26.0801 8.08402 27.8745 10.6421 28.9342C13.2002 29.9938 16.015 30.2712 18.7307 29.7311C21.4464 29.191 23.941 27.8578 25.899 25.9C27.1992 24.6 28.2305 23.0565 28.9342 21.3579C29.6378 19.6592 30 17.8386 30 16C30 14.1614 29.6378 12.3407 28.9342 10.6421C28.2305 8.94344 27.1992 7.40003 25.899 6.09999ZM24.489 24.49C22.8091 26.1641 20.6708 27.3028 18.3442 27.7625C16.0176 28.2221 13.6069 27.982 11.4166 27.0726C9.22634 26.1631 7.35466 24.625 6.03792 22.6525C4.72119 20.68 4.01845 18.3616 4.01845 15.99C4.01845 13.6184 4.72119 11.3 6.03792 9.32748C7.35466 7.35499 9.22634 5.8169 11.4166 4.90743C13.6069 3.99795 16.0176 3.75788 18.3442 4.21753C20.6708 4.67718 22.8091 5.81593 24.489 7.48999C25.6077 8.60483 26.4953 9.92955 27.101 11.3882C27.7067 12.8468 28.0185 14.4106 28.0185 15.99C28.0185 17.5694 27.7067 19.1332 27.101 20.5918C26.4953 22.0504 25.6077 23.3752 24.489 24.49Z" fill="black"/>
					</svg>
				</div>
			</div>
			<?php echo $this->Form->create(null, [
                    'url' => '/'.$lang.'users/article-add',
                    'type' => 'file',
                    'onsubmit' => 'showLoader()',
                ]); ?>
				<div class="popupform__block-col">
					<span>Название статьи</span>
					<input name="title" type="text" placeholder="Введите название статьи" required="">
				</div>
				<div class="popupform__block-col">
					<span>Файл</span>
					<label for="add-file">
						<input type="file" id="add-file" class="popupform__block-file" name="doc" required="">
						<div class="add-file-name">Прикрепить файл</div>
					</label>
				</div>
				<div class="popupform__block-col">
					<span>Выбор серии</span>
					<?= $this->Form->select('journals_series_id', $journals_series, array('empty' => 'Выберите серию', 'required')) ?>
				</div>
				<div class="popupform__block-col">
					<input type="submit" class="popupform__block-submit">
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	<!-- редактирование статьи -->
	<div class="popupform js-popup-edit">
		<div class="popupform__block">
			<div class="popupform__block-header">
				<div class="popupform__block-title">Редактировать статью</div>
				<div class="popupform__block-close js-close-edit-popup">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M20.999 19.54L17.409 16L20.999 12.46C21.0989 12.3665 21.1785 12.2534 21.233 12.1278C21.2874 12.0023 21.3155 11.8669 21.3155 11.73C21.3155 11.5931 21.2874 11.4577 21.233 11.3322C21.1785 11.2066 21.0989 11.0935 20.999 11C20.9055 10.9073 20.7947 10.834 20.6729 10.7842C20.5511 10.7345 20.4206 10.7092 20.289 10.71C20.0266 10.7111 19.7752 10.8152 19.589 11L15.999 14.59L12.459 11C12.2727 10.8152 12.0213 10.7111 11.759 10.71C11.6274 10.7092 11.4969 10.7345 11.3751 10.7842C11.2532 10.834 11.1424 10.9073 11.049 11C10.8627 11.1874 10.7582 11.4408 10.7582 11.705C10.7582 11.9692 10.8627 12.2226 11.049 12.41L14.589 16L11.049 19.54C10.8852 19.7313 10.7996 19.9774 10.8093 20.229C10.819 20.4807 10.9233 20.7195 11.1014 20.8976C11.2795 21.0757 11.5183 21.18 11.7699 21.1897C12.0216 21.1994 12.2677 21.1138 12.459 20.95L15.999 17.41L19.539 20.95C19.6316 21.0459 19.7421 21.1225 19.8643 21.1757C19.9866 21.2288 20.1181 21.2574 20.2513 21.2597C20.3846 21.262 20.517 21.2381 20.641 21.1892C20.765 21.1404 20.8781 21.0676 20.974 20.975C21.0699 20.8824 21.1465 20.7719 21.1997 20.6496C21.2528 20.5274 21.2814 20.3959 21.2837 20.2627C21.286 20.1294 21.2621 19.997 21.2132 19.873C21.1644 19.749 21.0916 19.6359 20.999 19.54ZM25.899 6.09999C23.941 4.1422 21.4464 2.80897 18.7307 2.26889C16.015 1.72882 13.2002 2.00615 10.6421 3.06581C8.08402 4.12548 5.8976 5.9199 4.35933 8.22216C2.82105 10.5244 2 13.2311 2 16C2 18.7689 2.82105 21.4756 4.35933 23.7778C5.8976 26.0801 8.08402 27.8745 10.6421 28.9342C13.2002 29.9938 16.015 30.2712 18.7307 29.7311C21.4464 29.191 23.941 27.8578 25.899 25.9C27.1992 24.6 28.2305 23.0565 28.9342 21.3579C29.6378 19.6592 30 17.8386 30 16C30 14.1614 29.6378 12.3407 28.9342 10.6421C28.2305 8.94344 27.1992 7.40003 25.899 6.09999ZM24.489 24.49C22.8091 26.1641 20.6708 27.3028 18.3442 27.7625C16.0176 28.2221 13.6069 27.982 11.4166 27.0726C9.22634 26.1631 7.35466 24.625 6.03792 22.6525C4.72119 20.68 4.01845 18.3616 4.01845 15.99C4.01845 13.6184 4.72119 11.3 6.03792 9.32748C7.35466 7.35499 9.22634 5.8169 11.4166 4.90743C13.6069 3.99795 16.0176 3.75788 18.3442 4.21753C20.6708 4.67718 22.8091 5.81593 24.489 7.48999C25.6077 8.60483 26.4953 9.92955 27.101 11.3882C27.7067 12.8468 28.0185 14.4106 28.0185 15.99C28.0185 17.5694 27.7067 19.1332 27.101 20.5918C26.4953 22.0504 25.6077 23.3752 24.489 24.49Z" fill="black"/>
					</svg>
				</div>
			</div>
			<?php echo $this->Form->create(null, [
                    'url' => '/'.$lang.'users/article-edit/',
                    'type' => 'file',
                    'onsubmit' => 'showLoader()',
                ]); ?>
				<div class="popupform__block-col">
					<span>Название статьи</span>
					<input name="title" type="text" placeholder="Введите название статьи" required="">
				</div>
				<div class="popupform__block-col">
					<span>Файл</span>
					<label for="edit-file">
						<input type="file" id="edit-file" class="popupform__block-file" name="doc">
						<div class="edit-file-name">Прикрепить файл</div>
					</label>
				</div>
				<div class="popupform__block-col">
					<span>Выбор серии</span>
					<?= $this->Form->select('journals_series_id', $journals_series, array('empty' => 'Выберите серию', 'required')) ?>
				</div>
				<div class="popupform__block-col">
					<input type="submit" class="popupform__block-submit">
				</div>
				<input type="text" id="hidden-input-value" hidden name="id">
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
<?php endif; ?>

