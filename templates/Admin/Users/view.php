<?php 
	$form = false;
?>

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Просмотр аккаунта</h1>
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
					</ul>
				</div>

					<div class="tab-content" id="custom-tabs-one-tabContent">
						<div class="tab-pane fade show active" id="custom-tabs-one-main" role="tabpanel" aria-labelledby="custom-tabs-main-tab">
							<div class="card-body form_cols">

								<div class="form-group col_2">
									<label for="inputTitle">ФИО</label>
									<div class="form-control"><?= $data['surname'] .' '. $data['name'] ?></div>
								</div>
								<div class="form-group col_4">
									<label>Телефон</label>
									<div class="form-control"><?= $data['phone'] ?></div>
								</div>
								<div class="form-group col_4">
									<label>E-mail</label>
									<div class="form-control"><?= $data['username'] ?></div>
								</div>

								<?php if( $form ): ?>
									<?= $this->Form->create(null, ['class' => 'form-group', 'onsubmit' => 'submitForm();']); ?>
										<?= $this->Form->hidden('user_id', array('value' => $data['id'])) ?>

										<?php if( $data['is_active'] ): ?>
											<div class="form-group">
												<?= $this->Form->hidden('submit_type', array('value' => 'deactivate')) ?>
												<?php echo $this->Form->button('Деактивировать', array('class' => 'btn btn-danger')); ?>
											</div>
											<div class="form-group">
												<label>Причина блокировки:</label>
												<textarea class="form-control" name="message" rows="4"></textarea>
											</div>
											
										<?php else: ?>
											<?php if( $data['role'] == 'company' && $data['confirm_code'] ): ?>
												<div class="form-group">
													<label class="btn btn-success">
														Одобрить регистрацию
														<input type="submit" hidden="" name="submit_type" value="accept_reg">
													</label>
												</div>
												<div class="form-group">
													<label class="btn btn-danger">
														Отклонить регистрацию
														<input type="submit" hidden="" name="submit_type" value="reject_reg">
													</label>
												</div>
												<div class="form-group">
													<label>Причина отказа:</label>
													<textarea class="form-control" name="message" rows="4"></textarea>
												</div>

											<?php else: ?>
												<?php if( $data['ban_message'] ): ?>
													<div class="form-group">
														<label>Причина блокировки:</label>
														<div><?= $data['ban_message'] ?></div>
													</div>
												<?php endif; ?>
												<div class="form-group">
													<?= $this->Form->hidden('submit_type', array('value' => 'activate')) ?>
													<?php echo $this->Form->button('Активировать', array('class' => 'btn btn-success')); ?>
												</div>
											<?php endif; ?>

										<?php endif; ?>

									<?= $this->Form->end(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
