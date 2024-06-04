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
						<a href="/admin/employees" type="button" class="btn btn-tool">
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body form_cols">
					<?php if( $ru ): ?>
						<div class="form-group">
							<label for="inputItemOrder">Приоритет</label>
							<?= $this->Form->text('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required')); ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="inputName">ФИО</label>
						<?= $this->Form->text('name', array('id' => 'inputName', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group col_2">
						<label for="inputPosition">Должность</label>
						<?= $this->Form->text('position', array('id' => 'inputPosition', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group col_2">
						<label for="inputMail">Почта</label>
						<?= $this->Form->text('mail', array('id' => 'inputMail', 'class' => 'form-control')); ?>
					</div>


					<?php if( $ru ): ?>
						<div class="form-group col_2">
						<label for="inputCategoryId">Филилал</label>
						<?= $this->Form->select('branche_id', $branches, array('id' => 'inputCategoryId', 'class' => 'form-control', 'required', 'empty' => 'Выбрать')); ?>
					</div>
					<?php endif; ?>

					<div class="submit_row form-group">
						<?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->Form->end(); ?>

