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

    public function add(){
        $model = 'Authors';
        date_default_timezone_set('Asia/Almaty');

        if( $this->request->is('post') ){
            $data = $this->request->getData();

            $created_alias = $this->$model->find()
                ->where(['alias' => $data['alias']])->first();
            if( $created_alias ){
                $this->Flash->error( __('Запись с таким alias уже существует') );
                return $this->redirect( $this->referer() );
            }

            $created_email = $this->$model->find()
                ->where(['email' => $data['email']])->first();
            if( $created_email ){
                $this->Flash->error( __('Запись с таким email уже существует') );
                return $this->redirect( $this->referer() );
            }
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $entity_res = $this->EntityFiles->saveEntityFiles($data, $model, $this->img_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            if( $this->$model->save($entity_res['entity']) ){
                $this->Flash->success(__('Данные успешно сохранены'));
                $this->_cacheDelete();
                return $this->redirect( $this->referer() );
            } else{
                $this->Flash->error(__('Ошибка сохранения данных'));
            }
        }
    }

    public function edit($item_id = null){
        $model = 'Authors';
        date_default_timezone_set('Asia/Almaty');

        $data = $this->$model->get($item_id);

        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;
            $created_alias = $this->$model->find()
                ->where(['alias' => $data1['alias'], $model . '.id !=' => $item_id])->first();
            if( $created_alias ){
                $this->Flash->error( __('Запись с таким alias уже существует') );
                return $this->redirect( $this->referer() );
            }

            $created_email = $this->$model->find()
                ->where(['email' => $data1['email'], $model . '.id !=' => $item_id])->first();
            if( $created_email ){
                $this->Flash->error( __('Запись с таким email уже существует') );
                return $this->redirect( $this->referer() );
            }
            $data1['password'] = password_hash($data1['password'], PASSWORD_BCRYPT);
            $entity_res = $this->EntityFiles->saveEntityFiles($data1, $model, $this->img_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            $new_data = $entity_res['entity']->toArray();
            $this->$model->patchEntity($data, $new_data);

            if ($this->$model->save($data)) {
                $this->Flash->success(__('Изменения сохранены'));
                $this->_cacheDelete();
                return $this->redirect( $this->referer() );
            }
            $this->Flash->error(__('Ошибка сохранения'));
        }

        $this->set( compact('data') );
    }

    public function delete($item_id = null){
        $model = 'Authors';

        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);

        $has_article = $this->Articles->find()
            ->where(['Articles.author_id' => $item_id])
            ->first();

        if( $has_article ){
            $this->Flash->error(__('Ошибка! Нельзя удалить Автора который прикреплен к Статье'));
            return $this->redirect( $this->referer() );
        }

        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_imgDelete($data, $this->img_fields);
            $this->_cacheDelete();
            return $this->redirect( $this->referer() );
        } else{
            $this->Flash->error(__('Ошибка удаления'));
        }
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

        // Cache::delete('main_articles_ru', 'long');
        // Cache::delete('main_articles_kz', 'long');
        // Cache::delete('main_articles_en', 'long');
    }
}

 ?>
