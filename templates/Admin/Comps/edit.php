
<?php
	$editor_id = [36];
	$docs_ids = [2, 3];
	$embed_id = 1;
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
						<?php if( $data['page_id'] > 0 ): ?>
							<a href="/admin/pages/edit/<?= $data['page_id'] ?>?lang=kz" type="button" class="btn btn-tool">
						<?php else: ?>
							<a href="/admin/comps" type="button" class="btn btn-tool">
						<?php endif; ?>
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body">

					<div class="form-group">
						<label for="inputTitle">Название</label>
						<?php if( isset($_GET['lang']) && $_GET['lang'] == 'ru' ): ?>
							<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required' => 'required')); ?>
						<?php else: ?>
							<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled')); ?>
						<?php endif; ?>
					</div>

					<?php if( $data['id'] == $embed_id ): ?>
						<div class="warning_block">
							<p><b>ВНИМАНИЕ!</b></p>
							<p>Будьте осторожны при добавлении кодов на сайт! Просмотрите код на наличие <b>лишних пробелов</b> и <b>незакртых скобок,</b> чтобы не было ошибок!</p>
							<p>Если после добавления кодов сайт перестал работать, то удалите добавленный код. Если все снова работает, значит в вашем коде ошибка</p>
						</div>
					<?php endif; ?>

					<?php if( !$data['img'] ): ?>
						<?php if( in_array($data['id'], $editor_id) ): ?>
							<div class="form-group">
								<label for="editor">Описание</label>
								<?= $this->Form->textarea('body', array('class' => 'form-control', 'id' => 'editor')); ?>
							</div>
						<?php else: ?>
							<div class="form-group">
								<label for="inputBody">Описание</label>
								<?= $this->Form->textarea('body', array('class' => 'form-control', 'id' => 'inputBody')); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>


					<?php if( isset($_GET['lang']) && $_GET['lang'] == 'ru' && $data['img'] ): ?>
						<div class="form-group">
							<label for="reviewimg">Картинка  </label>
							<?php if(!empty($data['img'])): ?>
								<div class="model_info_img">
									<div class="model_item_container">
										<div class="model_item">
											<img src="/img/comps/thumbs/<?=$data['img']?>">
										</div>
									</div>
								</div>
							<?php endif ?>
							<div class="input-group">
								<div class="custom-file">
									<?= $this->Form->input('img', array('class' => 'custom-file-input', 'id' => 'reviewimg', 'type' => 'file', 'accept' => 'image/jpeg, image/png, image/jpg, image/gif')); ?>
									<label class="custom-file-label" for="reviewimg"></label>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<?php if( in_array($data['id'], $docs_ids) ): ?>
						<div class="form-group">
							<label for="reviewDoc">Файл</label>
							<div class="input-group">
								<div class="custom-file">
									<?= $this->Form->input('doc', array('class' => 'custom-file-input', 'id' => 'reviewDoc', 'type' => 'file', 'accept' => 'text/xml, text/plain, application/xml')); ?>
									<label class="custom-file-label" for="reviewDoc"><?= ($data['doc']) ? $data['doc'] : '' ?></label>
								</div>
							</div>
						</div>
					<?php endif; ?>

					<div class="submit_row">
						<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->Form->end(); ?>


<?php if( in_array($data['id'], $editor_id) ): ?>
	<script type="text/javascript">
	    CKEDITOR.replace( 'editor' );
	</script>
<?php endif; ?>


<style type="text/css">
	.warning_block p:last-child{
		margin-bottom: 0;
	}
	.warning_block{
		color: #fff;
		padding: 15px;
		border-radius: 5px;
		margin-bottom: 30px;
		background-color: rgba(255, 0, 0, 0.7);
	}
</style>
