<?php 
  $langs = ['ru', 'kz', 'en']; 
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Авторы</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Авторы</h3>
      <div class="card-tools">
        <a href="/admin/authors/add" class="btn btn-success">Добавить</a>
      </div>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 8%">ФИО</th>
                <th style="width: 5%">Картинка</th>
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
                <?= $item['name'] ?>
              </td>
              <td>
                <img src="/img/authors/thumbs/<?= $item['img'] ?>" alt="" width="120">
              </td>
              <td>
        				<?= $item['item_order'] ?>
        			</td>
        			<td class="project-actions text-right">
        				<a class="btn btn-info btn-sm" href="/admin/authors/edit/<?=$item['id']?>?lang=ru">
                  <i class="fas fa-pencil-alt"></i> rus
                </a>
                <a class="btn btn-info btn-sm" href="/admin/authors/edit/<?=$item['id']?>?lang=kz">
                  <i class="fas fa-pencil-alt"></i> kaz
                </a>
        				<?php echo $this->Form->postLink('Удалить', "/admin/authors/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
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
