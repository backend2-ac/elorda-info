<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Заявки</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Заявки</h3>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 5%">ФИО</th>
                <th style="width: 3%">Телефон</th>
                <th style="width: 3%">Email</th>
                <th style="width: 3%">Услуга</th>
                <th style="width: 3%">Дата / Время</th>
                <th style="width: 3%; text-align: right;">Редактирование</th>
            </tr>
        </thead>
        <tbody>
         	<?php foreach($data as $item): ?>
        		<tr>
        			<td>
        				<?= $item['id'] ?>
        			</td>
              <td>
                <?= $item['name'] ?>
              </td>
              <td>
                <?= $item['phone'] ?>
              </td>
              <td>
                <?= $item['email'] ?>
              </td>
              <td>
                <?= ($item['service']) ? $item['service']['title'] : '-' ?>
              </td>
        			<td>
        				<?= $this->Time->format($item['date'], 'dd.MM.Y HH:mm') ?>
        			</td>
        			<td class="project-actions text-right">
        				<?php echo $this->Form->postLink('Удалить', "/admin/requests/delete/{$item['id']}", array('confirm' => 'Подтвердите удаление', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
        			</td>
        		</tr>
        	<?php endforeach ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="emty_data">
        Список заявок пуст
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