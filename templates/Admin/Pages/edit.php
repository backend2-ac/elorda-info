<?php
	$kz = false;
	if( isset($cur_locale) && $cur_locale == 'kz' ){
		$kz = true;
	}

	$langs = ['ru', 'kz', 'en'];
	$langs_ids = [4, 9, 10];
?>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Редактирование</h1>
			</div>
		</div>
	</div>
</section>

 <section>
	<div class="row">
		<div class="col-12 col-sm-12">
			<div class="card card-primary card-tabs">
				<div class="card-header p-0 pt-1">
					<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="custom-tabs-one-main-tab" data-toggle="pill" href="#custom-tabs-one-main" role="tab" aria-controls="custom-tabs-one-main" aria-selected="true">Данные</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" id="custom-tabs-one-docs-tab" data-toggle="pill" href="#custom-tabs-one-docs" role="tab" aria-controls="custom-tabs-one-docs" aria-selected="true">Документы</a>
						</li> -->

						<?php if( $kz ): ?>
							<?php if( $page_comps ): ?>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-comps-tab" data-toggle="pill" href="#custom-tabs-one-comps" role="tab" aria-controls="custom-tabs-one-comps" aria-selected="true">Элементы</a>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					</ul>
				</div>

				<div class="card-body">
					<div class="tab-content" id="custom-tabs-one-tabContent">
						<div class="tab-pane fade show active" id="custom-tabs-one-main" role="tabpanel" aria-labelledby="custom-tabs-main-tab">
							<?php echo $this->Form->create($data, ['type' => 'file', 'onsubmit' => 'submitForm()']); ?>
								<div class="card-body">
									<?php if( $kz ): ?>
										<div class="form-group">
											<label for="inputItemOrder">Приоритет</label>
											<?= $this->Form->number('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required', 'value' => 0)); ?>
										</div>
									<?php endif; ?>

									<div class="form-group">
										<label for="inputTitle">Название</label>
										<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required' => 'required')); ?>
									</div>

									<div class="submit_row">
										<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
									</div>
								</div>
								<div class="col-md-12">
									<div class="card card-secondary">
										<div class="card-header">
											<h3 class="card-title">SEO</h3>
											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
													<i class="fas fa-minus"></i>
												</button>
											</div>
										</div>
										<div class="card-body">
											<div class="form-group">
												<label for="seoMetaTitle">Мета заголовок</label>
												<?php echo $this->Form->text('meta_title', array('class' => 'form-control', 'id' => 'seoMetaTitle')); ?>
											</div>
											<div class="form-group">
												<label for="seoKeywords">Ключевые слова</label>
												<?php echo $this->Form->text('meta_keywords', array('class' => 'form-control', 'id' => 'seoKeywords')); ?>
											</div>
											<div class="form-group">
												<label for="seoDescription">Описание</label>
												<?php echo $this->Form->textarea('meta_description', array('class' => 'form-control', 'id' => 'seoDescription')); ?>
											</div>

											<div class="submit_row">
												<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
											</div>
										</div>
									</div>
								</div>
							<?php echo $this->Form->end(); ?>
						</div>

						<div class="tab-pane fade show" id="custom-tabs-one-docs" role="tabpanel" aria-labelledby="custom-tabs-docs-tab">
							<?php echo $this->Form->create(null, [
									'url' => '/admin/documents/add',
									'type' => 'file',
									'onsubmit' => 'submitForm()'
								]); ?>
								<div class="card-body">
									<div class="form-group">
										<label for="inputOrder">Приоритет</label>
										<?= $this->Form->number('item_order', array('id' => 'inputOrder', 'class' => 'form-control', 'value' => 0, 'required')); ?>
									</div>

									<div class="form-group">
										<label for="inputTitle">Название файла</label>
										<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control')); ?>
									</div>

									<?= $this->element('admin/img_input', [
										'custom_input_params' => ['title' => 'Файл', 'field' => 'doc', 'model' => 'Documents', 'required' => 'required'],
										]);
									?>

									<?= $this->Form->hidden('lang', array('value' => $cur_locale)) ?>

									<div class="submit_row">
										<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
								    </div>
								</div>
							<?php echo $this->Form->end(); ?>

							<div class="card-body p-0">
								<?php if(!empty($documents)): ?>
									<table class="table table-striped projects">
										<thead>
											<tr>
												<th style="width: 1%">ID</th>
												<th style="width: 8%">Файл</th>
												<th style="width: 8%">Приоритет</th>
												<th style="width: 8%; text-align: right;">Редактирование</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($documents as $item): ?>
												<tr>
													<td>
														<?=$item['id']?>
													</td>
													<td>
														<img src="/files/docs/<?= $item['doc'] ?>" alt="">
													</td>
													<td>
														<?= $item['item_order'] ?>
													</td>
													<td class="project-actions text-right">
														<a class="btn btn-info btn-sm" href="/admin/documents/edit/<?=$item['id']?>">
															<i class="fas fa-pencil-alt"></i> Редактировать
														</a>
														<?php  echo $this->Form->postLink('Удалить', "/admin/documents/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								<?php else: ?>
									<div class="emty_data">
										К сожалению в данном разделе еще не добавлена информация...
									</div>
								<?php endif ?>
							</div>
						</div>

						<?php if( $kz ): ?>
							<?php if( $page_comps ): ?>
								<div class="tab-pane fade show" id="custom-tabs-one-comps" role="tabpanel" aria-labelledby="custom-tabs-comps-tab">
									<div class="card-body p-0">
										<table class="table table-striped comps-table">
											<thead>
												<tr>
													<th style="width: 1%">ID</th>
													<th style="width: 10%">Название</th>
													<th style="width: 20%">Картинка / Текст</th>
													<th style="width: 12%; text-align: right;">Редактирование</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($page_comps as $item): ?>
													<tr>
														<td>
															<?=$item['id']?>
														</td>
														<td>
															<b><?=$item['title']?></b>
														</td>
														<td>
															<?php if( $item['img'] ): ?>
																<img src="/img/comps/thumbs/<?= $item['img'] ?>" width="150" alt="">
															<?php else: ?>
																<?php foreach( $langs as $index => $key ): ?>
																	<?php if( isset($item['_translations'][$key]) && $item['_translations'][$key]['body'] ): ?>
																		<p> <b><?=$key?>:</b> <?= (mb_strlen($item['_translations'][$key]['body']) > 150) ? mb_substr($item['_translations'][$key]['body'], 0, 150) . '...' : $item['_translations'][$key]['body'] ?></p>
																	<?php endif; ?>
																<?php endforeach; ?>
															<?php endif; ?>
														</td>
														<td class="project-actions text-right">
															<?php if( in_array($item['id'], $langs_ids) ): ?>
																<a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=ru">
																	<i class="fas fa-pencil-alt"></i> rus
																</a>
																<a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=kz">
																	<i class="fas fa-pencil-alt"></i> kaz
																</a>
															<?php else: ?>
																<a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=ru">
																	<i class="fas fa-pencil-alt"></i> Редактировать
																</a>
															<?php endif; ?>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>


