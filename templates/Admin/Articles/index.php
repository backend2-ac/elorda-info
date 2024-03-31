<?php

use Cake\I18n\FrozenTime;

$cur_user_role = $this->request->getSession()->read('Auth.User.role');

$is_kz_articles = strpos($_SERVER['REQUEST_URI'], 'kz');
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Статьи</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div>
</section>

<section class="content">

    <form class="form_cols" action="/admin/articles-<?= $is_kz_articles ? 'kz' : 'ru' ?>?test=test" method="GET" onsubmit="submitForm();">

      <div class="form-group col_2">
        <label for="inputTitle">Название</label>
        <?= $this->Form->text('title', array('id' => 'inputTitle', 'class' => 'form-control', 'value' => $title)); ?>
      </div>

        <?php if ($cur_user_role == 'admin'): ?>
          <div class="form-group col_2">
            <label for="inputAuthorId">Автор</label>
            <?= $this->Form->select('author_id', $authors, array('id' => 'inputAuthorId', 'class' => 'form-control', 'value' => $author_id, 'empty' => 'Все')); ?>
          </div>
        <?php endif; ?>
        <div class="form-group col_2">
            <label for="inputCategoryId">Категория</label>
            <?= $this->Form->select('category_id', $categories, array('id' => 'inputCategoryId', 'class' => 'form-control', 'empty' => 'Выбрать')); ?>
        </div>

      <div class="form-group col_4">
        <label for="inputViewsSort">Просмотры</label>
        <select id="inputViewsSort" class="form-control" name="views_sort">
          <option value="">Все</option>
          <option value="100" <?= ($views_sort == 100) ? 'selected' : '' ?> >0 - 100</option>
          <option value="500" <?= ($views_sort == 500) ? 'selected' : '' ?> >100 - 500</option>
          <option value="1000" <?= ($views_sort == 1000) ? 'selected' : '' ?> >500 - 1 000</option>
          <option value="1001" <?= ($views_sort == 1001) ? 'selected' : '' ?> >1 000 и больше</option>
        </select>
      </div>

      <div class="submit_row form-group">
        <?php echo $this->Form->button('Поиск', array('class' => 'btn btn-success')); ?>
        <a href="/admin/articles-<?= $is_kz_articles ? 'kz' : 'ru' ?>?test=test" class="btn btn-danger">Сбросить</a>
      </div>

    </form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Статьи</h3>
      <div class="card-tools">
          <?php if ($is_kz_articles): ?>
                <a href="/admin/articles-kz/add" class="btn btn-success">Добавить новый материал (Қаз.)</a>
          <?php else: ?>
                <a href="/admin/articles-ru/add" class="btn btn-success">Добавить новый материал (Рус.)</a>
          <?php endif; ?>
      </div>
    </div>
    <div class="card-body p-0">
    <?php if(!empty($data)): ?>
      <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">ID</th>
                <th style="width: 8%">Название</th>
                <th style="width: 5%">Категория</th>
                <th style="width: 5%">Картинка</th>
                <th style="width: 5%">Дата создания</th>
                <th style="width: 5%">Дата старт публикации</th>
                <th style="width: 5%">Статус</th>
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
                    <p><?= $item['title'] ?></p>
                <p><b>Просмотров:</b> <?= number_format($item['views'], 0, '', ' ') ?></p>
              </td>
              <td>
                <?= $categories[$item['category_id']] ?>
              </td>
                <td>

                    <img src="<?= file_exists('/var/www/vhosts/elorda.info/httpdocs/webroot/img/articles/' . $item['img']) ? '/img/articles/thumbs/' . $item['img'] : '/img/articles' . $item['img_path'] ?>" alt="" width="150">
                </td>
              <td>
        				<?= $this->Time->format($item['created_at'], 'dd.MM.yyyy HH:mm') ?>
        			</td>
                    <td>
                        <?= $item['publish_start_at'] ? $this->Time->format($item['publish_start_at'], 'dd.MM.yyyy HH:mm') : '' ?>
                    </td>
                    <td>
                        <?= FrozenTime::now() > $item['publish_start_at'] ? 'Опубликован' : 'Не опубликован' ?>
                    </td>
        			<td class="project-actions text-right">
                    <?php if ($is_kz_articles): ?>
                        <a class="btn btn-info btn-sm" href="/admin/articles-kz/edit/<?=$item['id']?>">
                          <i class="fas fa-pencil-alt"></i> Редактировать
                        </a>
                        <?php echo $this->Form->postLink('Удалить', "/admin/articles-kz/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
        			<?php else: ?>
                        <a class="btn btn-info btn-sm" href="/admin/articles-ru/edit/<?=$item['id']?>">
                            <i class="fas fa-pencil-alt"></i> Редактировать
                        </a>
                        <?php echo $this->Form->postLink('Удалить', "/admin/articles-ru/delete/{$item['id']}", array('confirm' => 'Удалить Материал?', 'value'=>'465', 'class' => 'btn btn-danger btn-sm')) ?>
                    <?php endif; ?>
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
