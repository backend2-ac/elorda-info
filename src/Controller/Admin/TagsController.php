<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class TagsController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Tags');

        $this->loadModel('ArticlesTags');

        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public function index(){
        $model = 'Tags';
        $tag_title = '';
        $conditions = [];
        if (isset($_GET['tag_title']) && $_GET['tag_title']) {
            $tag_title = $_GET['tag_title'];
            $conditions[] = [$model . '.title LIKE' => '%'. $tag_title .'%'];
        }

        if (isset($_GET['locale']) && $_GET['locale']) {
            $locale = $_GET['locale'];
            $conditions[] = [$model . '.locale' => $locale];
        }

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data_ids = $this->$model->find('list', [
                'valueField' => 'id'
            ])
            ->select(['id', 'item_order'])
            ->where($conditions)
            ->order(['locale', 'title'])
            ->orderDesc($model.'.item_order')
            ->limit($per_page)->offset($offset)
            ->toList();

        $data = $this->$model->find()
            ->where([$model.'.id IN' => $data_ids])
            ->order(['locale', 'title'])
            ->orderDesc('item_order')
            ->toList();

        $this->set( compact('data', 'tag_title') );

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            ->order(['locale', 'title'])
            ->order([$model.'.item_order' => 'DESC'])
            ->limit($per_page),
            $pag_settings
        ));
    }

    public function add(){
        $model = 'Tags';
        date_default_timezone_set('Asia/Atyrau');


        if( $this->request->is('post') ){
            $data = $this->request->getData();

            $created_title = $this->$model->find()
                ->where(['title' => $data['title']])->first();
            if( $created_title ){
                $this->Flash->error( __('Запись с таким названием уже существует') );
                return $this->redirect( $this->referer() );
            }

            $created_alias = $this->$model->find()
                ->where(['alias' => $data['alias']])->first();
            if($created_alias){
                $this->Flash->error( __('Запись с таким alias уже существует') );
                return $this->redirect( $this->referer() );
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
        $model = 'Tags';
        date_default_timezone_set('Asia/Atyrau');

        $data = $this->$model->get($item_id);

        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;

            $created_title = $this->$model->find()
                ->where(['title' => $data1['title']])->first();
            if( $created_title ){
                $this->Flash->error( __('Запись с таким названием уже существует') );
                return $this->redirect( $this->referer() );
            }

            $created_alias = $this->$model->find()
                ->where(['alias' => $data1['alias']])->first();
            if($created_alias){
                $this->Flash->error( __('Запись с таким alias уже существует') );
                return $this->redirect( $this->referer() );
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
        $model = 'Tags';

        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);

        $has_article = $this->ArticlesTags->find()
            ->where(['ArticlesTags.tag_id' => $item_id])
            ->first();

        if( $has_article ){
            $this->Flash->error(__('Ошибка! Нельзя удалить Тег который прикреплен к Статье'));
            return $this->redirect( $this->referer() );
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
        Cache::delete('admin_tags_kk', 'eternal');
        Cache::delete('admin_tags_kz', 'eternal');
        Cache::delete('admin_tags_ru', 'eternal');

    }
}


 ?>
