<?php
$cur_user = $this->request->getSession()->read('Auth.User');
$cur_user_id = $cur_user['id'];
$author_id = $cur_user['author_id'];
$cur_user_role = $cur_user['role'];
$is_kz_articles = strpos($_SERVER['REQUEST_URI'], 'kz');
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

<?php echo $this->Form->create($data, ['type' => 'file', 'onsubmit' => 'submitForm()']); ?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Данные</h3>
					<div class="card-tools">
						<a href="/admin/articles-<?= $is_kz_articles ? 'kz' : 'ru' ?>" type="button" class="btn btn-tool">
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body form_cols">

                    <?php if ($cur_user_role == 'admin'): ?>
                        <div class="form-group col_2">
                            <label for="inputAuthorId">Автор</label>
                            <?= $this->Form->select('author_id', $authors, array('id' => 'inputAuthorId', 'class' => 'form-control', 'empty' => 'Нет')); ?>
                        </div>
                    <?php else: ?>
                        <?= $this->Form->hidden('author_id', array('value' => $author_id)) ?>
                    <?php endif; ?>
                    <?= $this->Form->hidden('updated_by_id', array('value' => $cur_user_id)) ?>

						<div class="form-group col_2">
							<label for="inputCategoryId">Категория</label>
							<?= $this->Form->select('category_id', $categories, array('id' => 'inputCategoryId', 'class' => 'form-control', 'required', 'empty' => 'Выбрать')); ?>
						</div>

					<div class="form-group">
						<label for="inputTitle">Название</label>
						<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required')); ?>
					</div>

					<div class="form-group">
						<label for="inputBody">Описание</label>
						<?= $this->Form->textarea('body', array('id' => 'inputBody', 'class' => 'form-control')); ?>
					</div>

                    <?php
                    $img_path = '/img/articles/thumbs/';
                    $img_name = $data['img'];
                    if (!file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $data['img'])) {
                        $img_path = '/img/articles';
                        $img_name = $data['img_path'];
                    }
                    ?>
<!--                    --><?php //= $this->element('admin/img_input', [
//                        'custom_input_params' => ['title' => 'Картинка', 'field' => 'img', 'path' => $img_path, 'file_name' => $img_name],
//                        ]);
//                    ?>

                    <?= $this->element('admin/img_input', [
                        'custom_input_params' => [
                            'title' => 'Картинка',
                            'field' => 'img',
                            'path' => $img_path,
                            'file_name' => $img_name,
                            'accept' => '.jpg,.jpeg,.png,.gif,.webp' // Добавляем поддержку формата WebP
                        ]
                    ]); ?>



                    <div class="form-group">
                        <label for="inputImgText">Текст картинки (alt)</label>
                        <?= $this->Form->text('img_text', array('id' => 'inputImgText', 'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputImgSource">Подпись под фото</label>
                        <?= $this->Form->text('cover_photo_source', array('id' => 'inputImgSource', 'class' => 'form-control')); ?>
                    </div>

                    <div class="form-group col_4">
                        <label>Дата</label>
                        <div class="input-group date col-3" id="articles_date" data-target-input="nearest">
                            <?= $this->Form->text('date', array('class' => 'form-control datetimepicker-input', 'data-target' => '#articles_date', 'required' => 'required', 'value' => $this->Time->format($data['date'], 'Y-MM-dd HH:mm') )); ?>
                            <div class="input-group-append" data-target="#articles_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col_4">
                        <label>Дата старт публикации</label>
                        <div class="input-group date col-3" id="articles_publish_start_at" data-target-input="nearest">
                            <?= $this->Form->text('publish_start_at', array('class' => 'form-control datetimepicker-input', 'data-target' => '#articles_publish_start_at')); ?>
                            <div class="input-group-append" data-target="#articles_publish_start_at" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

<!--                    <div class="form-group col_4">-->
<!--                        <label>Дата end публикации</label>-->
<!--                        <div class="input-group date col-3" id="articles_publish_end_at" data-target-input="nearest">-->
<!--                            --><?php //= $this->Form->text('publish_end_at', array('class' => 'form-control datetimepicker-input', 'data-target' => '#articles_publish_end_at')); ?>
<!--                            <div class="input-group-append" data-target="#articles_publish_end_at" data-toggle="datetimepicker">-->
<!--                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="form-group">-->
<!--                        <div class="custom-control custom-switch">-->
<!--                            --><?php //= $this->Form->input('on_main', array('class' => 'custom-control-input', 'id' => 'on_main', 'type' => 'checkbox'));  ?>
<!--                            <label class="custom-control-label" for="on_main">закрепить на Главной</label>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="inputImgText">Теги</label>
                        <select class="js-tags-multiple" name="articles_tags[]" multiple="multiple">
                            <?php foreach ($tags_list as $index => $item): ?>
                                <option value="<?= $index ?>" <?= (in_array($index, $data_tags)) ? 'selected' : '' ?> ><?= $item ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
<!--					<div class="form-group">-->
<!--					    <label for="tags">Теги</label>-->
<!--					    <select class="form-control" id="tags" name="articles_tags[]" multiple="multiple">-->
<!--					        --><?php //foreach( $tags_list as $item_id => $item ): ?>
<!--					            <option value="--><?php //= $item_id ?><!--" --><?php //= (in_array($item_id, $data_tags)) ? 'selected' : '' ?><!-- >--><?php //= $item ?><!--</option>-->
<!--					        --><?php //endforeach ?>
<!--					    </select>-->
<!--					</div>-->

					<div class="submit_row form-group">
						<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
				    </div>
				</div>
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
						<?php echo $this->Form->button('Добавить', array('class' => 'btn btn-success')); ?>
				    </div>
	            </div>
	        </div>
	    </div>
	</div>
</section>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
    CKEDITOR.replace( 'inputBody' );
</script>

<!--<link rel="stylesheet" href="/js/plugins/css/multi-select.css">-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>-->
<!--<script src="/js/plugins/js/jquery.multi-select.js"></script>-->
<!--<script>-->
<!--    $('#tags').multiSelect({-->
<!--    	selectableHeader: '<div><b>Все теги</b></div>',-->
<!--    	selectionHeader: '<div><b>Выбранные теги</b></div>',-->
<!--    });-->
<!--</script>-->
