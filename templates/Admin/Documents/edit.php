<?php
$def_lang = false;
if( isset($_GET['lang']) && $_GET['lang'] == 'kz' ){
    $def_lang = true;
}

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
                        <?php if( $data['page_id'] ): ?>
                            <a href="/admin/pages/edit/<?= $data['page_id'] ?>?lang=kz" type="button" class="btn btn-tool">
                            <?php else: ?>
                            <a href="/admin/documents" type="button" class="btn btn-tool">
                            <?php endif; ?>
                            <i class="fas fa-arrow-left"></i>
                            </a>
                    </div>
                </div>
                <div class="card-body form_cols">
                    <?php if( $def_lang ): ?>
                        <div class="form-group">
                            <label for="inputItemOrder">Приоритет</label>
                            <?= $this->Form->number('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputTitle">Название</label>
                        <?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'required')); ?>
                    </div>

                    <?= $this->element('admin/file_input', [
                        'custom_input_params' => ['title' => 'Файл', 'field' => 'doc', 'file_name' => $data['doc'], 'accept' => $accept_files_types],
                    ]);
                    ?>

                    <div class="submit_row form-group">
                        <?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $this->Form->end(); ?>

