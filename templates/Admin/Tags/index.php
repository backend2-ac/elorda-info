
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Теги</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>

<section class="content">
    <form class="form_cols" action="/admin/tags?test=test" method="GET" onsubmit="submitForm();">

        <div class="form-group col_2">
            <label for="inputTitle">Название тега</label>
            <?= $this->Form->text('tag_title', array('id' => 'inputTagTitle', 'class' => 'form-control', 'value' => $tag_title)); ?>
        </div>

        <div class="form-group col_2">
            <label for="inputaLocale">Язык</label>
            <?= $this->Form->select('locale', ['kk' => 'қаз', 'ru' => 'рус'], array('id' => 'inputLocale', 'class' => 'form-control', 'empty' => 'Выбрать')); ?>
        </div>

        <div class="submit_row form-group">
            <?php echo $this->Form->button('Поиск', array('class' => 'btn btn-success')); ?>
            <a href="/admin/tags?test=test" class="btn btn-danger">Сбросить</a>
        </div>

    </form>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Теги</h3>
      <div class="card-tools">
        <a href="/admin/tags/add" class="btn btn-success">Добавить новый материал</a>
      </div>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 8%">Название</th>
                <th style="width: 8%">Alias</th>
                <th style="width: 8%">Язык</th>
                <th style="width: 5%">Приоритет</th>
                <th style="width: 5%; text-align: right;">Редактирование</th>
            </tr>
        </thead>
        <tbody>
         	<?php foreach($data as $item): ?>
                <tr>
                    <td>
                        <?=$item['id']?>
                    </td>
                    <td>
                        <?= $item['title'] ?>
                    </td>
                    <td>
                        <?= $item['alias'] ?>
                    </td>
                    <td>
                        <?= $item['locale'] ?>
                    </td>
                    <td>
                        <?= $item['item_order'] ?>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="/admin/tags/edit/<?=$item['id']?>">
                            <i class="fas fa-pencil-alt"></i> редактировать
                        </a>
                        <?php echo $this->Form->postLink('Удалить', "/admin/tags/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
                    </td>
                </tr>
        	<?php endforeach ?>
        </tbody>
      </table>

    <?php else: ?>
      <div class="emty_data">
        К сожалению в данном разделе еще не добавлена информация...
      </div>
    <?php endif ?>
    </div>
  </div>

</section>

<ul class="pagination">
  <?php
    $this->Paginator->options([
        'url' => [
            'lang' => $l,
        ]
    ]);
    echo $this->Paginator->numbers([
      'first' => 1, 'last' => 1, 'modulus' => 2,
    ]);
  ?>
</ul>
