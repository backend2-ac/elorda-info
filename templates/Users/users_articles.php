<main class="section_bg regestr-main">
	<header class="reg-header">
		<div class="header-container">
			<div class="header__title__block">
				<a class="header-arrow" href="javascript:;"><img src="/img/header-arrow.svg" alt=""></a>
				<h1 class="title header-title">Статьи для рецензирования</h1>
			</div>
			<div class="header__kebab">
				<img src="/img/menukebab.svg" alt="">
			</div>
		</div>
	</header>
	<section class="register-section">
		<div class="section-container">
			<div class="registration-content">
				<div class="register-forms" style="width: 100%;">
					<div class="save-vacancy__tabs">
						<div class="blue__block">
							<div class="blue__block__big__text">Всего статей: <?= $this->Paginator->counter('{{count}}'); ?></div>
						</div>

						<form action="/<?= $lang ?>users/users-articles" method="GET" style="width: 100%;">
							<div class="filter__vacancy__top__block">
								<div>
									<label>Название статьи:</label>
									<input type="text" name="s_title" value="<?= $s_title ?>" placeholder="Введите название">
								</div>
								<div class="">
									<label>Серия:</label>
									<?= $this->Form->select('j_series_id', $journals_series, array('id' => 'inputCity', 'class' => 'form-control', 'value' => $j_series_id, 'empty' => 'Все')); ?>
								</div>
								<div class="">
									<label>Статус:</label>
									<?= $this->Form->select('u_a_status_id', $users_articles_statuses, array('id' => 'inputCity', 'class' => 'form-control', 'value' => $u_a_status_id, 'empty' => 'Все')); ?>
								</div>
							</div>
							<button class="main-form__button" style="display: table; margin: 20px auto 0;"><?= __('Применить') ?></button>
						</form>

						<?php if( $data ): ?>
							<div class="save-vacancy__contents">
								<table class="articles_table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Серия</th>
											<th>Название статьи</th>
											<th>Файл</th>
											<th>Статус</th>
											<th>Действия</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach( $data as $item ): ?>
											<tr>
												<td align="center"><?= $item['id'] ?></td>
												<?php if( $item['status'] == 'canceled' ): ?>
													<td colspan="5">
														<p align="center">Вы больше не являетесь рецензетом этой статьи</p>
													</td>
												<?php else: ?>
													<td>
														<?= $journals_series[$item['article']['journals_series_id']] ?>
													</td>
													<td><?= $item['article']['title'] ?></td>
													<td align="center">
														<a href="/files/articles/<?= $item['article']['doc'] ?>" target="_blank">Файл</a>
													</td>
													<td align="center">
														<?= $users_articles_statuses[$item['status']] ?>
													</td>
													<td>
														<div class="save-vacancy__bottom__btns" style="justify-content: center;">
															<?php if( $item['status'] == 'new' || $item['status'] == 'for_correction' || $item['status'] == 'fixed' ): ?>
																<a class="blue-btn" href="/<?= $lang ?>users/users-article-edit/<?= $item['id'] ?>">Редактировать</a>
															<?php endif; ?>
														</div>
													</td>
												<?php endif; ?>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								
								<ul class="vacancy__paginations">
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
											'prevActive' => '<li><a href="{{url}}" class="pagination__link"><svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.10625 0L9.875 1.76875L4.14375 7.5L9.875 13.2312L8.10625 15L0.606249 7.5L8.10625 0Z" fill="#32374A"></path></svg></a></li>',
											'nextActive' => '<li><a href="{{url}}" class="pagination__link"><svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.10625 0L9.875 1.76875L4.14375 7.5L9.875 13.2312L8.10625 15L0.606249 7.5L8.10625 0Z" fill="#32374A"></path></svg></a></li>',
											'number' => '<li><a class="pagination__link" href="{{url}}">{{text}}</a></li>',
											'current' => '<li><a class="pagination__link active" href="{{url}}">{{text}}</a></li>',
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
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<style type="text/css">
	.articles_table{
		width: 100%;
		border-collapse: collapse;
	}
	.articles_table td,
	.articles_table th{
		padding: 5px 10px;
		border: 1px solid #333;
	}
</style>
