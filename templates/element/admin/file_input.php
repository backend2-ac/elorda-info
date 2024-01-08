<?php 
	$custom_input = [
		'title' => 'Файл',
		'field' => 'doc',
		'file_name' => '',
		'model' => '',
		'required' => '',
		'accept' => 'application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf',
	];

	if( isset($custom_input_params) && is_array($custom_input_params) && $custom_input_params ){
		$input_params = array_merge($custom_input, $custom_input_params);
	} else{
		$input_params = array_merge($custom_input);
	}
?>

<div class="form-group">
	<label for="reviewDoc_<?= $input_params['model'] .'_'. $input_params['field'] ?>"><?= $input_params['title'] ?></label>
	<div class="input-group">
		<div class="custom-file">
			<?= $this->Form->input($input_params['field'], array('class' => 'custom-file-input', 'id' => 'reviewDoc_'.$input_params['model'].'_'.$input_params['field'], 'type' => 'file', $input_params['required'], 'accept' => $input_params['accept'])); ?>
			<label class="custom-file-label" for="reviewDoc_<?= $input_params['model'] .'_'. $input_params['field'] ?>"><?= ($input_params['file_name']) ? $input_params['file_name'] : '' ?></label>
		</div>
	</div>
</div>