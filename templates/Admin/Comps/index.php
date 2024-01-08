<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Элементы</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>

<?php 
  $langs = array('ru', 'kz', 'en');
  $langs_ids = [4, 9, 10, 11];
  $spec_ids = [1, 2, 3];
?>


<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Элементы</h3>		
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped comps-table">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 10%">Название</th>
                <th style="width: 20%">Картинка / Текст</th>
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
        				<b><?=$item['title']?></b>
        			</td>
        			<td>
                <?php if( !in_array($item['id'], $spec_ids) ): ?>

                  <?php if( $item['img'] ): ?>
          					<img src="/img/comps/thumbs/<?= $item['img'] ?>" width="150" alt="">
          				<?php else: ?>
  	        				<?php foreach( $langs as $index => $key ): ?>
                      <?php if( isset($item['_translations'][$key]) && $item['_translations'][$key]['body'] ): ?>
                        <p> <b><?=$key?>:</b> <?= (mb_strlen($item['_translations'][$key]['body']) > 150) ? mb_substr($item['_translations'][$key]['body'], 0, 150) . '...' : $item['_translations'][$key]['body'] ?></p>
                      <?php endif; ?>
                    <?php endforeach; ?>
          				<?php endif; ?>
                
                <?php endif; ?>
        			</td>
        			<td class="project-actions text-right">
                <?php if( in_array($item['id'], $langs_ids) ): ?>
          				<a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=ru">
          					<i class="fas fa-pencil-alt"></i> rus
          				</a>
                  <a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=kz">
                    <i class="fas fa-pencil-alt"></i> kaz
                  </a>
                <?php else: ?>
                  <a class="btn btn-info btn-sm" href="/admin/comps/edit/<?=$item['id']?>?lang=ru">
                    <i class="fas fa-pencil-alt"></i> Редактировать
                  </a>
                <?php endif; ?>
        				<?php # echo $this->Form->postLink('Удалить', "/admin/comps/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
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