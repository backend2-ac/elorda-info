<?php
$cur_user = $this->request->getSession()->read('Auth.User');
$cur_user_id = $cur_user['id'];
$author_id = $cur_user['author_id'];
$cur_user_role = $cur_user['role'];
?>
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
						<a href="/admin/tags" type="button" class="btn btn-tool">
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
						<label for="inputTitle">Название</label>
						<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required')); ?>
					</div>
                    <div class="form-group">
                        <label for="inputAlias">Alias (с латинскими буквами *)</label>
                        <?= $this->Form->text('alias', array('id' => 'inputAlias', 'class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="form-group col_2">
                        <label for="inputLocale">Язык</label>
                        <?= $this->Form->select('locale', ['kk' => 'kk', 'ru' => 'ru'], array('id' => 'inputLocale', 'class' => 'form-control', 'required', 'empty' => 'Выбрать')); ?>
                    </div>

                    <?= $this->Form->hidden('created_by_id', array('value' => $cur_user_id)) ?>

					<div class="submit_row form-group">
						<?php echo $this->Form->button('Добавить', array('class' => 'btn btn-success')); ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php echo $this->Form->end(); ?>
