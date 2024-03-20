<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class BranchesController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Branches');

        $this->loadModel('ArticlesTags');

        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public function index(){
        $model = 'Branches';

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        // $data_ids = $this->$model->find('list', [
        //         'valueField' => 'id'
        //     ])
        //     ->select(['id', 'item_order'])
        //     ->orderDesc($model.'.item_order')
        //     ->limit($per_page)->offset($offset)
        //     ->toList();

        $data = $this->$model->find('translations')
            ->orderDesc('item_order')
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
        $model = 'Branches';
        date_default_timezone_set('Asia/Almaty');

        if(isset($_GET['lang']) && $_GET['lang'] == 'kz'){
            $this->$model->setLocale('kz');
        }elseif(isset($_GET['lang']) && $_GET['lang'] == 'en'){
            $this->$model->setLocale('en');
        }else{
            $this->$model->setLocale('ru');
        }

        if( $this->request->is('post') ){
            $data = $this->request->getData();

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
        $model = 'Branches';
        date_default_timezone_set('Asia/Almaty');

        if(isset($_GET['lang']) && $_GET['lang'] == 'kz'){
            $this->$model->setLocale('kz');
        }elseif(isset($_GET['lang']) && $_GET['lang'] == 'en'){
            $this->$model->setLocale('en');
        }else{
            $this->$model->setLocale('ru');
        }

        $data = $this->$model->get($item_id);

        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;

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
        $model = 'Branches';

        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);

        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_cacheDelete();
            return $this->redirect( $this->referer() );
        } else{
            $this->Flash->error(__('Ошибка удаления'));
        }
    }

    protected function _cacheDelete(){
        Cache::delete('admin_branches', 'eternal');
        Cache::delete('branches_ru', 'long');
        Cache::delete('branches_kz', 'long');

    }
}


 ?>
