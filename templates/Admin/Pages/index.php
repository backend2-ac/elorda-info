<?php
$langs = array('ru', 'kz', 'en');
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Страницы</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Страницы</h3>
      <div class="card-tools">
        <!-- <a href="/admin/pages/add" class="btn btn-success">Добавить новый материал</a> -->
      </div>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 12%">Название</th>
                <th style="width: 12%; text-align: right;">Редактирование</th>
            </tr>
        </thead>
        <tbody>
         	<?php foreach($data as $item): ?>
        		<tr>
        			<td>
        				<?=$item['id']?>
        			</td>
        			<td>
                        <?php foreach( $langs as $index => $key ): ?>
                            <?php if( isset($item['_translations'][$key]) && $item['_translations'][$key]['title'] ): ?>
                                <p> <b><?=$key?>:</b> <?= $item['_translations'][$key]['title'] ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
        			</td>
        			<td class="project-actions text-right">
        				<a class="btn btn-info btn-sm" href="/admin/pages/edit/<?=$item['id']?>?lang=ru">
        					<i class="fas fa-pencil-alt"></i> rus
        				</a>
                <a class="btn btn-info btn-sm" href="/admin/pages/edit/<?=$item['id']?>?lang=kz">
                  <i class="fas fa-pencil-alt"></i> kaz
                </a>

        				<?php # $this->Form->postLink('Удалить', "/admin/pages/delete/{$item['id']}", array('confirm' => 'Удалить Страницу?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
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
		        // 'lang' => $l,
		    ]
		]);
		echo $this->Paginator->numbers([
			'first' => 1, 'last' => 1, 'modulus' => 2,
		]);
	?>
</ul>
