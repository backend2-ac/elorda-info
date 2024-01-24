<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Добавление</h1>
			</div>
		</div>
	</div>
</section>

<?php echo $this->Form->create(null, ['type' => 'file', 'onsubmit' => 'submitForm()']); ?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Данные</h3>
					<div class="card-tools">
						<a href="/admin/authors" type="button" class="btn btn-tool">
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body form_cols">
					<div class="form-group">
						<label for="inputItemOrder">Приоритет</label>
						<?= $this->Form->text('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required', 'value' => 0)); ?>
					</div>
					<div class="form-group">
						<label for="inputName">ФИО</label>
						<?= $this->Form->text('name', array('id' => 'inputName', 'class' => 'form-control', 'required')); ?>
					</div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <?= $this->Form->text('email', array('id' => 'inputEmail', 'class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputPwd">Password</label>
                        <?= $this->Form->text('password', array('id' => 'inputPwd', 'type' => 'password', 'class' => 'form-control')); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputAlias">Alias</label>
                        <?= $this->Form->text('alias', array('id' => 'inputAlias', 'class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputBiography">Биография</label>
                        <?= $this->Form->textarea('biography', array('id' => 'inputBiography', 'class' => 'form-control')); ?>
                    </div>
                    <?= $this->element('admin/img_input', [
                        'custom_input_params' => ['title' => 'Картинка', 'field' => 'img'],
                    ]);
                    ?>
					<div class="submit_row form-group">
						<?php echo $this->Form->button('Добавить', array('class' => 'btn btn-success')); ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo $this->Form->end(); ?>
<script type="text/javascript">
    CKEDITOR.replace( 'inputBiography' );
</script>
