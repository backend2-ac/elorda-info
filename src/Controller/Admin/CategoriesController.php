<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class CategoriesController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Categories');
        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public function index(){
        $model = 'Categories';

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = $this->$model->find()
            ->order(['locale', 'title'])
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
        $model = 'Categories';
        date_default_timezone_set('Asia/Atyrau');

        if( $this->request->is('post') ){
            $data = $this->request->getData();
            $locale = 'kk';
            if (isset($_GET['lang']) && $_GET['lang']) {
                $locale = $_GET['lang'] == 'ru' ? 'ru' : 'kk';
            }
            if (!$data['alias']) {
                $data['alias'] = Text::slug($data['title']);
                $data['alias'] = mb_strtolower($data['alias']);
            }
            $data['locale'] = $locale;
            $created = $this->$model->find()
                ->where(['alias' => $data['alias']])->first();

            if( $created ){
                $data['alias'] = $this->_slug_render($data['alias']);

                $created = $this->$model->find()
                    ->where(['alias' => $data['alias']])->first();

                if( $created ){
                    $this->Flash->error( __('Запись с таким названием уже существует') );
                    return $this->redirect( $this->referer() );
                }
            }

            $entity_res = $this->EntityFiles->saveEntityFiles($data, $model);

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
        $model = 'Categories';
        date_default_timezone_set('Asia/Atyrau');

        $data = $this->$model->get($item_id);

        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;
            if (!isset($data1['is_show'])) {
                $data1['is_show'] = 0; // если не установлен, то считаем его 0
            }
            $entity_res = $this->EntityFiles->saveEntityFiles($data1, $model);

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
        $model = 'Categories';

        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);
        $has_articles = $this->Articles->find()
            ->select('id')
            ->where(['Articles.category_id' => $item_id])
        ->first();
        if ($has_articles) {
            $this->Flash->error(__('Ошибка! Нельзя удалить категорию, к которой принадлежит новость!'));
            return $this->redirect($this->referer());
        }
        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_cacheDelete();
            return $this->redirect( $this->referer() );
        } else{
            $this->Flash->error(__('Ошибка удаления'));
        }
    }

    protected function _cacheDelete(){
        Cache::delete('admin_categories', 'eternal');
        Cache::delete('admin_categories_kk', 'eternal');
        Cache::delete('admin_categories_ru', 'eternal');

        Cache::delete('full_categories', 'eternal');

    }

    protected function _slug_render($slug){
        $slug_date = date('YmdHis');
        $slug = $slug . '_' . $slug_date;
        return $slug;
    }

}


 ?>
