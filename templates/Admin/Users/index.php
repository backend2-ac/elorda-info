<?php 
  $title = 'ФИО';
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <?php if( $type == 'author' ): ?>
          <h1>Авторы</h1>
        <?php elseif( $type == 'reviewer' ): ?>
          <h1>Рецензенты</h1>
        <?php else: ?>
          <h1>Пользователи</h1>
        <?php endif; ?>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>


<section class="content">

  <form class="form_cols" action="/admin/users?type=<?= $type ?>" method="GET" onsubmit="submitForm();">
    
    <div class="form-group col_2">
      <label for="inputName"><?= $title ?></label>
      <?= $this->Form->text('name', array('id' => 'inputName', 'class' => 'form-control', 'value' => $name)); ?>
    </div>

    <div class="form-group col_2">
      <label for="inputEmail">E-mail</label>
      <?= $this->Form->email('email', array('id' => 'inputEmail', 'class' => 'form-control', 'value' => $email)); ?>
    </div>

    <div class="form-group col_4">
      <label for="inputIsActive">Статус</label>
      <select id="inputIsActive" class="form-control" name="is_active">
        <option value="" >Все</option>
        <option value="active" <?= ($sel_status == 'active') ? 'selected' : '' ?> >Активен</option>
        <option value="inactive" <?= ($sel_status == 'inactive') ? 'selected' : '' ?> >Не Активен</option>
      </select>
    </div>

    <input type="hidden" name="type" value="<?= $type ?>">

    <div class="submit_row form-group">
      <?php echo $this->Form->button('Поиск', array('class' => 'btn btn-success')); ?>
      <a href="/admin/users?type=<?= $type ?>" class="btn btn-danger">Сбросить</a>
    </div>

  </form>

  <br>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Пользователи</h3>
      <div class="card-tools"></div>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 8%"><?= $title ?></th>
                <th style="width: 5%">Контакты</th>
                <th style="width: 5%">Роль</th>
                <th style="width: 5%">Статус</th>
                <th style="width: 5%">Дата регистрации</th>
                <th style="width: 8%; text-align: right;">Действия</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($data as $item): ?>
            <tr>
              <td>
                <?=$item['id']?>
              </td>
              <td>
                <?= $item['surname'] . ' '. $item['name'] ?>
              </td>
              <td>
                <a href="mailto:<?= $item['username'] ?>"><?= $item['username'] ?></a>
                <?php if( $item['phone'] ): ?>
                  <br>
                  <a href="tel:+<?= preg_replace('/[^0-9]/', '', $item['phone']) ?>"><?= $item['phone'] ?></a>
                <?php endif; ?>
              </td>
              <td>
                <?php if( $item['role'] == 'reviewer' ): ?>
                  Рецензент
                <?php elseif( $item['role'] == 'author' ): ?>
                  Автор
                <?php else: ?>
                  Пользователь
                <?php endif; ?>
              </td>
              <td>
                <?php if( $item['is_active'] ): ?>
                  <span class="status_elem good">Активирован</span>
                <?php else: ?>
                  <span class="status_elem error">Не активирован</span>
                <?php endif; ?>
              </td>
              <td>
                <?= $this->Time->format($item['created_at'], 'dd.MM.yyyy HH:mm') ?>
              </td>
              <td class="project-actions text-right">
                <a class="btn btn-info btn-sm" href="/admin/users/view/<?=$item['id']?>">
                  <i class="fas fa-eye"></i> Просмотр
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

    <?php else: ?>
      <div class="emty_data">
        К сожалению зарегистрированных Пользователей не найдено...
      </div> 
    <?php endif ?>
    </div>
  </div>

</section>

<ul class="pagination">
  <?php 

    $paginator_query = $this->request->getQuery();
    unset($paginator_query['page']);

    $this->Paginator->options([
        'url' => [
            'lang' => $l,
            '?' => $paginator_query,
        ]
    ]);
    echo $this->Paginator->numbers([
      'first' => 1, 'last' => 1, 'modulus' => 2, 
    ]); 
  ?>
</ul>


<style type="text/css">
  .status_elem{
    padding: 4px 12px;
    color: #fff;
    font-size: 14px;
    border-radius: 5px;
    background-color: #b6b6b6;
  }
  .good{
    background-color: #00b600;
  }
  .error{
    background-color: #e10000;
  }
</style>

