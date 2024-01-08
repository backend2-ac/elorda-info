<?php 
	$ru = false;
	if( isset($_GET['lang']) && $_GET['lang'] == 'ru' ){
		$ru = true;
	}
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
						<a href="/admin/articles" type="button" class="btn btn-tool">
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body form_cols">
					<?php if( $ru ): ?>
						<div class="form-group">
							<label for="inputAuthorId">Автор</label>
							<?= $this->Form->select('author_id', $authors, array('id' => 'inputAuthorId', 'class' => 'form-control', 'empty' => 'Нет')); ?>
						</div>
						
						<div class="form-group col_2">
							<label for="inputCategoryId">Категория</label>
							<?= $this->Form->select('category_id', $categories, array('id' => 'inputCategoryId', 'class' => 'form-control', 'required', 'empty' => 'Выбрать')); ?>
						</div>

						<!-- <div class="form-group col_2">
							<label for="inputRubricId">Рубрика</label>
							<?= $this->Form->select('rubric_id', $rubrics, array('id' => 'inputRubricId', 'class' => 'form-control', 'empty' => 'Выбрать')); ?>
						</div> -->
					<?php endif; ?>

					<div class="form-group col_2">
						<label for="inputTitle">Название</label>
						<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required')); ?>
					</div>
					<div class="form-group col_2">
						<label for="inputShortDesc">Краткое описание</label>
						<?= $this->Form->text('short_desc', array('id' => 'inputShortDesc', 'class' => 'form-control')); ?>
					</div>

					<div class="form-group">
						<label for="inputSubTitle">Подзаголовок</label>
						<?= $this->Form->text('sub_title', array('id' => 'inputSubTitle', 'class' => 'form-control')); ?>
					</div>

					<div class="form-group">
						<label for="inputBody">Описание</label>
						<?= $this->Form->textarea('body', array('id' => 'inputBody', 'class' => 'form-control')); ?>
					</div>

					<?php if( $ru ): ?>
						<?= $this->element('admin/img_input', [
							'custom_input_params' => ['title' => 'Картинка', 'field' => 'img', 'path' => '/img/articles/thumbs/', 'file_name' => $data['img']],
							]); 
						?>
					<?php endif; ?>

					<div class="form-group">
						<label for="inputImgText">Подпись под фото</label>
						<?= $this->Form->text('img_text', array('id' => 'inputImgText', 'class' => 'form-control')); ?>
					</div>
					
					<?php if( $ru ): ?>
						<div class="form-group col_4">
							<label>Дата</label>
							<div class="input-group date col-3" id="articles_date" data-target-input="nearest">
								<?= $this->Form->text('date', array('class' => 'form-control datetimepicker-input', 'data-target' => '#articles_date', 'value' => $this->Time->format($data['date'], 'Y-MM-dd HH:mm') )); ?>
								<div class="input-group-append" data-target="#articles_date" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group col_4">
							<label for="views">Просмотры</label>
							<?= $this->Form->text('views', array('id' => 'views', 'class' => 'form-control')); ?>
						</div>
						<div class="form-group col_4">
							<label for="inputReadingTime">Время чтения (мин)</label>
							<?= $this->Form->number('reading_time', array('id' => 'inputReadingTime', 'class' => 'form-control')); ?>
						</div>

						<div class="form-group">
							<div class="custom-control custom-switch">
								<?= $this->Form->input('on_main', array('class' => 'custom-control-input', 'id' => 'on_main', 'type' => 'checkbox'));  ?>
								<label class="custom-control-label" for="on_main">закрепить на Главной</label>
							</div>
						</div>
						<div class="form-group">
							<div class="custom-control custom-switch">
								<?= $this->Form->input('on_sidebar', array('class' => 'custom-control-input', 'id' => 'on_sidebar', 'type' => 'checkbox'));  ?>
								<label class="custom-control-label" for="on_sidebar">Важное</label>
							</div>
						</div>
					<?php endif; ?>



					<div class="form-group">
					    <label for="tags">Теги</label>
					    <select class="form-control" id="tags" name="articles_tags[]" multiple="multiple">
					        <?php foreach( $tags_list as $item_id => $item ): ?>
					            <option value="<?= $item_id ?>" <?= (in_array($item_id, $data_tags)) ? 'selected' : '' ?> ><?= $item ?></option>
					        <?php endforeach ?>
					    </select>
					</div>

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

<link rel="stylesheet" href="/js/plugins/css/multi-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="/js/plugins/js/jquery.multi-select.js"></script>
<script>
    $('#tags').multiSelect({
    	selectableHeader: '<div><b>Все теги</b></div>',
    	selectionHeader: '<div><b>Выбранные теги</b></div>',
    });
</script>