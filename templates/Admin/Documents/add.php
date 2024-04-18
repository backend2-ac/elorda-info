<?php
$accept_files_types = '
	application/msword,
	application/vnd.openxmlformats-officedocument.wordprocessingml.document,
	application/pdf,
	application/vnd.ms-excel,
	application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
	';
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
                        <a href="/admin/documents" type="button" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body form_cols">
                    <div class="form-group">
                        <label for="inputItemOrder">Приоритет</label>
                        <?= $this->Form->number('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required', 'value' => 0)); ?>
                    </div>

                    <div class="form-group">
                        <label for="inputTitle">Название</label>
                        <?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control')); ?>
                    </div>

                    <?= $this->element('admin/file_input', [
                        'custom_input_params' => ['title' => 'Файл', 'field' => 'doc', 'accept' => $accept_files_types],
                    ]);
                    ?>

                    <?php # $this->Form->hidden('page_id', array('value' => 0)); ?>

                    <div class="submit_row form-group">
                        <?php echo $this->Form->button('Добавить', array('class' => 'btn btn-success')); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php echo $this->Form->end(); ?>

