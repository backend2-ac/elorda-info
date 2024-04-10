<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Редактирование</h1>
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

                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-article-images-tab" data-toggle="pill" href="#custom-tabs-one-email" role="tab" aria-controls="custom-tabs-one-email" aria-selected="true">Логин и пароль</a>
                        </li>
                        <div class="card-tools" style="margin-left: auto">
                            <a href="/admin/authors" type="button" class="btn btn-tool">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-main" role="tabpanel" aria-labelledby="custom-tabs-main-tab">
                            <?php echo $this->Form->create($data, ['type' => 'file', 'onsubmit' => 'submitForm()']); ?>
                            <div class="card-body form_cols">
                                <div class="form-group">
                                    <label for="inputItemOrder">Приоритет</label>
                                    <?= $this->Form->text('item_order', array('id' => 'inputItemOrder', 'class' => 'form-control', 'required')); ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ФИО</label>
                                    <?= $this->Form->text('name', array('id' => 'inputName', 'class' => 'form-control', 'required')); ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputAlias">Alias</label>
                                    <?= $this->Form->text('alias', array('id' => 'inputAlias', 'class' => 'form-control', 'required')); ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputBiography">Биография</label>
                                    <?= $this->Form->textarea('biography', array('id' => 'inputBiography', 'class' => 'form-control')); ?>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <?= $this->Form->input('anonymous', array('class' => 'custom-control-input', 'id' => 'anonymous', 'type' => 'checkbox'));  ?>
                                        <label class="custom-control-label" for="anonymous">Скрыть</label>
                                    </div>
                                </div>
                                <?= $this->element('admin/img_input', [
                                    'custom_input_params' => ['title' => 'Картинка', 'field' => 'img', 'path' => '/img/authors/thumbs/', 'file_name' => $data['img']],
                                ]);
                                ?>
                                <div class="submit_row form-group">
                                    <?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                        <div class="tab-pane fade show" id="custom-tabs-one-email" role="tabpanel" aria-labelledby="custom-tabs-email-tab">
                            <div class="card-body">
                                <?php echo $this->Form->create($data, [
                                    'type' => 'file', 'onsubmit' => 'submitForm()',
                                    'class' => 'form_cols'
                                ]); ?>

                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <?= $this->Form->text('email', array('id' => 'inputEmail', 'class' => 'form-control', 'required')); ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputNewPwd">Новый пароль</label>
                                    <?= $this->Form->text('new_pwd', array('id' => 'inputNewPwd', 'type' => 'password', 'class' => 'form-control', 'required')); ?>
                                </div>

                                <div class="form-group submit_row">
                                    <?php echo $this->Form->button('Сохранить', array('class' => 'btn btn-success')); ?>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    CKEDITOR.replace( 'inputBiography' );
</script>
