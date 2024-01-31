<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class AuthorsController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Authors');

        $this->loadModel('Articles');
        $this->loadModel('Admins');
        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public $img_folder = 'authors';
    public $img_fields = ['img'];
    public function index(){
        $model = 'Authors';

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = $this->$model->find('all')
            ->orderDesc('item_order')
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set( compact('data') );

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            ->order([$model.'.item_order' => 'DESC'])
            ->limit($per_page),
            $pag_settings
        ));
    }

    public function add() {
        $authors_model = 'Authors';
        $admins_model = 'Admins';
        date_default_timezone_set('Asia/Almaty');
        $cur_date = date('Y-m-d H:i:s');
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Проверка, существует ли уже alias в Authors
            $created_alias_authors = $this->$authors_model->find()
                ->where(['alias' => $data['alias']])
                ->first();
            if ($created_alias_authors) {
                $this->Flash->error(__('Запись с таким alias уже существует'));
                return $this->redirect($this->referer());
            }

            // Проверка, существует ли уже email в Authors
            $created_email_authors = $this->$authors_model->find()
                ->where(['email' => $data['email']])
                ->first();
            if ($created_email_authors) {
                $this->Flash->error(__('Запись с таким email уже существует'));
                return $this->redirect($this->referer());
            }

            // Проверка, существует ли уже email в Admins
            $createdEmailAdmins = $this->$admins_model->find()
                ->where(['email' => $data['email']])
                ->first();
            if ($createdEmailAdmins) {
                $this->Flash->error(__('Запись с таким email уже существует в Admins'));
                return $this->redirect($this->referer());
            }

            if( mb_strlen($data['password']) < 6){
                $this->Flash->error(__('Пароль не должен быть короче 6 символов'));
                return $this->redirect( $this->referer() );
            }
            if( mb_strlen($data['password'])){
                $this->Flash->error(__('Пароль не должен быть длиннее 16 символов'));
                return $this->redirect( $this->referer() );
            }

            // Хеширование пароля
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            // Сохранение данных в Authors
            $entity_res_authors = $this->EntityFiles->saveEntityFiles($data, $authors_model, $this->img_fields);

            if ($entity_res_authors['entity']->getErrors()) {
                $errors = $entity_res_authors['entity']->getErrors();
                foreach ($errors as $index => $err) {
                    $this->Flash->error($err[array_key_first($err)]);
                }
                return $this->redirect($this->referer());
            }

            if ($this->$authors_model->save($entity_res_authors['entity'])) {
                $this->Flash->success(__('Данные успешно сохранены в Authors'));
            } else {
                $this->Flash->error(__('Ошибка сохранения данных в Authors'));
                return $this->redirect($this->referer());
            }

            // Сохранение данных в Admins (только email и password)
            $data_admins = [
                'author_id' => $data['id'],
                'username' => $data['email'],
                'password' => $data['password'],
                'role' => 'author',
                'created' => $cur_date
            ];

            $entity_res_admins = $this->EntityFiles->saveEntityFiles($data_admins, $admins_model, $this->img_fields);

            if ($entity_res_admins['entity']->getErrors()) {
                $errors = $entity_res_admins['entity']->getErrors();
                foreach ($errors as $index => $err) {
                    $this->Flash->error($err[array_key_first($err)]);
                }
                return $this->redirect($this->referer());
            }

            if ($this->$admins_model->save($entity_res_admins['entity'])) {
                $this->Flash->success(__('Данные успешно сохранены в Admins'));
                $this->_cacheDelete();
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('Ошибка сохранения данных в Admins'));
            }
        }
    }

    public function edit($item_id = null) {
        $authors_model = 'Authors';
        $admins_model = 'Admins';
        date_default_timezone_set('Asia/Almaty');
        $cur_user = $this->request->getSession()->read('Auth.User');
        if ($cur_user['role'] == 'author' && $cur_user['author_id'] != $item_id) {
            $this->Flash->error(__('У вас нет доступа!'));
            $this->redirect(['controller' => 'Admin', 'action' => 'index']);
        }
        $data = $this->$authors_model->get($item_id);
        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;
            if (isset($data1['email']) && isset($data1['new_pwd'])) {
                // Проверка, существует ли уже email в Authors
                $created_email_authors = $this->$authors_model->find()
                    ->where(['email' => $data1['email'], $authors_model . '.id !=' => $item_id])
                    ->first();
                if ($created_email_authors) {
                    $this->Flash->error(__('Запись с таким email уже существует'));
                    return $this->redirect($this->referer());
                }

                if( mb_strlen($data1['new_pwd']) < 6){
                    $this->Flash->error(__('Пароль не должен быть короче 6 символов'));
                    return $this->redirect( $this->referer() );
                }
                if( mb_strlen($data1['new_pwd']) > 16){
                    $this->Flash->error(__('Пароль не должен быть длиннее 16 символов'));
                    return $this->redirect( $this->referer() );
                }
                $data1['new_pwd'] = password_hash($data1['new_pwd'], PASSWORD_BCRYPT);

                // Проверка, существует ли запись в Admins по полю author_id
                $created_author_in_admins = $this->$admins_model->find()
                    ->where(['author_id' => $item_id])
                    ->first();
                $cur_date = date('Y-m-d H:i:s');
                if ($created_author_in_admins) {
                    // Если запись существует, обновляем только username и password
                    $data_admins = [
                        'username' => $data1['email'],
                        'password' => $data1['new_pwd'],
                        'modified' => $cur_date,
                    ];
                    $conditions = [
                        'author_id' => $item_id,
                    ];

                    if ($this->$admins_model->updateAll($data_admins, $conditions)) {
                        $this->Flash->success(__('Данные успешно обновлены в Admins'));
                        $this->_cacheDelete();
                    } else {
                        $this->Flash->error(__('Ошибка обновления данных в Admins'));
                        return $this->redirect($this->referer());
                    }
                } else {
                    // Если запись не существует, добавляем новую запись в Admins
                    $data_admins = [
                        'author_id' => $item_id,
                        'username' => $data1['email'],
                        'password' => $data1['new_pwd'],
                        'role' => 'author',
                        'created' => $cur_date,
                    ];

                    $admin_entity = $this->$admins_model->newEmptyEntity();

                    $admin_entity = $this->$admins_model->patchEntity($admin_entity, $data_admins);

                    if ($this->$admins_model->save($admin_entity)) {
                        $this->Flash->success(__('Новая запись успешно добавлена в Admins'));
                        $this->_cacheDelete();
                    } else {
                        $this->Flash->error(__('Ошибка добавления новой записи в Admins'));
                        return $this->redirect($this->referer());
                    }
                }

                $existing_entity = $this->$authors_model->get($item_id);

                $existing_entity = $this->$authors_model->patchEntity($existing_entity, $data1);
                if ($this->$authors_model->save($existing_entity)) {
                    $this->Flash->success(__('Данные успешно обновлены в Authors'));
                    $this->request->getSession()->write('Auth.User.username', $data1['email']);
                    $this->_cacheDelete();
                } else {
                    $this->Flash->error(__('Ошибка обновления данных в Authors'));
                }
            } else {
                // Проверка, существует ли уже alias в Authors
                if (isset($data1['alias'])) {
                    $created_alias_authors = $this->$authors_model->find()
                        ->where(['alias' => $data1['alias'], $authors_model . '.id !=' => $item_id])
                        ->first();
                    if ($created_alias_authors) {
                        $this->Flash->error(__('Запись с таким alias уже существует'));
                        return $this->redirect($this->referer());
                    }
                }
                // Продолжаем обработку обновления данных в Authors
                $entity_res_authors = $this->EntityFiles->saveEntityFiles($data1, $authors_model, $this->img_fields);

                if ($entity_res_authors['entity']->getErrors()) {
                    $errors = $entity_res_authors['entity']->getErrors();
                    foreach ($errors as $index => $err) {
                        $this->Flash->error($err[array_key_first($err)]);
                    }
                    return $this->redirect($this->referer());
                }

                $new_data = $entity_res_authors['entity']->toArray();
                $this->$authors_model->patchEntity($data, $new_data);

                if ($this->$authors_model->save($data)) {
                    $this->Flash->success(__('Изменения сохранены'));
                    $this->_cacheDelete();
                    return $this->redirect($this->referer());
                }

                $this->Flash->error(__('Ошибка сохранения'));
            }

        }

        $this->set(compact('data'));
    }

    public function delete($item_id = null){
        $authors_model = 'Authors';
        $admins_model = 'Admins';
        $cur_user = $this->request->getSession()->read('Auth.User');
        if ($cur_user['role'] == 'author' && $cur_user['author_id'] != $item_id) {
            $this->Flash->error(__('У вас нет доступа!'));
            $this->redirect(['controller' => 'Admin', 'action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$authors_model->get($item_id);

        // Проверка наличия связанных данных в Articles
        $has_article = $this->Articles->find()
            ->where(['Articles.author_id' => $item_id])
            ->first();

        if ($has_article) {
            $this->Flash->error(__('Ошибка! Нельзя удалить Автора, который прикреплен к Статье'));
            return $this->redirect($this->referer());
        }

        // Поиск записи в Admins по полю author_id
        $admin_record = $this->$admins_model->find()
            ->where(['author_id' => $item_id])
            ->first();

        if ($admin_record) {
            // Если запись существует, удаляем ее
            if ($this->$admins_model->delete($admin_record)) {
                $this->Flash->success(__('Запись в Admins успешно удалена'));
                $this->_cacheDelete();
            } else {
                $this->Flash->error(__('Ошибка удаления записи в Admins'));
                return $this->redirect($this->referer());
            }
        }

        // Продолжаем с удалением записи в Authors
        if ($this->$authors_model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_imgDelete($data, $this->img_fields);
            $this->_cacheDelete();
        } else {
            $this->Flash->error(__('Ошибка удаления'));
        }

        return $this->redirect(['action' => 'index']);
    }

    protected function _imgDelete($data = null, $fields = array()){
        $folder = $this->img_folder;

        if( $data && $fields ){
            foreach( $fields as $item ){
                if( isset($data[$item]) && $data[$item] ){
                    $fileName = WWW_ROOT.'img'.DS.$folder.DS.$data[$item];
                    $fileNameThumbs = WWW_ROOT.'img'.DS.$folder.DS.'thumbs'.DS.$data[$item];
                    if( file_exists($fileName) ){
                        unlink($fileName);
                    }
                    if( file_exists($fileNameThumbs) ){
                        unlink($fileNameThumbs);
                    }
                    clearstatcache();
                }
            }
        }
    }

    protected function _cacheDelete(){
        Cache::delete('admin_authors', 'eternal');

    }
}

 ?>
