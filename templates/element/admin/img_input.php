<?php 
	$custom_input = [
		'title' => 'Картинка',
		'field' => 'img',
		'path' => '',
		'file_name' => '',
		'model' => '',
		'required' => '',
		'accept' => 'image/jpeg, image/png, image/jpg, image/gif',

		'cropped' => false,
		'data_width' => '',
		'data_height' => '',
	];

	if( isset($custom_input_params) && is_array($custom_input_params) && $custom_input_params ){
		$input_params = array_merge($custom_input, $custom_input_params);
	} else{
		$input_params = array_merge($custom_input);
	}
?>

<div class="form-group">
	<label for="reviewimg_<?= $input_params['model'] . '_' . $input_params['field'] ?>"><?= $input_params['title'] ?></label>
	<?php if( !empty($input_params['path']) && !empty($input_params['file_name']) ): ?>
		<div class="model_info_img">
			<div class="model_item_container">
				<div class="model_item">
					<img src="<?= $input_params['path'] . $input_params['file_name'] ?>">
				</div>
			</div>
		</div>
	<?php endif ?>
	<div class="input-group">
		<div class="custom-file">
			<?php if( $input_params['cropped'] ): ?>
				<input type="file" class="custom-file-input js-photo-croppie" id="reviewimg_<?= $input_params['model'] .'_'. $input_params['field'] ?>" accept="<?= $input_params['accept'] ?>" data-width="<?= $input_params['data_width'] ?>" data-height="<?= $input_params['data_height'] ?>" <?= $input_params['required'] ?> >
				<?= $this->Form->hidden($input_params['field'], array('class' => 'js-result-base', 'id' => 'img_result_'.$input_params['model'].'_'.$input_params['field'])); ?>
			
			<?php else: ?>
				<?= $this->Form->input($input_params['field'], array('class' => 'custom-file-input', 'id' => 'reviewimg_'.$input_params['model'].'_'.$input_params['field'], 'type' => 'file', 'accept' => $input_params['accept'], $input_params['required'] )); ?>
			<?php endif; ?>
			
			<label class="custom-file-label" for="reviewimg_<?= $input_params['model'] .'_'. $input_params['field'] ?>"></label>
		</div>
	</div>

	<?php if( $input_params['cropped'] ): ?>
		<div class="upload-wrapper">
			<div class="upload-demo-box">
				<div class="upload-demo"></div>
			</div>
			<div class="upload-result-btn">
				<div class="upload-result" data-id="img_result_<?= $input_params['model'] .'_'. $input_params['field'] ?>">Сохранить</div>
			</div>
		</div>
	<?php endif; ?>

</div>