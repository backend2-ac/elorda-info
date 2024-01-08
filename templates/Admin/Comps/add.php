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
						<a href="/admin/comps" type="button" class="btn btn-tool">
							<i class="fas fa-arrow-left"></i>
						</a>
					</div>
				</div>
				<div class="card-body">
					
					<div class="form-group">
						<label for="inputPageId">ID Page</label>
						<?= $this->Form->number('page_id', array('id' => 'inputPageId', 'class' => 'form-control', 'required' => 'required', 'value' => 0)); ?>
					</div>

					<div class="form-group">
						<label for="inputTitle">Название</label>
						<?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required' => 'required')); ?>
					</div>
					<div class="form-group">
						<label for="editor">Описание</label>
						<?= $this->Form->textarea('body', array('class' => 'form-control', 'id' => 'editor')); ?>
					</div>
					<div class="form-group">
						<label for="reviewimg">Картинка  </label>
						<div class="input-group">
							<div class="custom-file">
								<?= $this->Form->input('img', array('class' => 'custom-file-input', 'id' => 'reviewimg', 'type' => 'file', 'accept' => 'image/jpeg, image/png, image/jpg, image/gif')); ?>
								<label class="custom-file-label" for="reviewimg"></label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="reviewimg_Doc">robots.txt / sitemap.xml</label>
						<div class="input-group">
							<div class="custom-file">
								<?= $this->Form->input('doc', array('class' => 'custom-file-input', 'id' => 'reviewimg_Doc', 'type' => 'file', 'accept' => 'text/xml, text/plain, application/xml')); ?>
								<label class="custom-file-label" for="reviewimg_Doc"></label>
							</div>
						</div>
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