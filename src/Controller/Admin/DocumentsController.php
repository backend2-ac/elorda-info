<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class DocumentsController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Documents');
        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public $img_folder = '';
    public $img_fields = [];

    public $docs_folder = 'docs';
    public $docs_fields = ['doc'];

    public function index(){
        $model = 'Documents';

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = $this->$model->find('translations')
            // ->where([$model.'.page_id' => 0, $model.'.user_id' => 0])
            ->orderDesc('item_order')
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set( compact('data') );

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
                // ->where([$model.'.page_id' => 0, $model.'.user_id' => 0])
                ->orderDesc('item_order')
                ->limit($per_page),
            $pag_settings
        ));
    }

    public function add(){
        $model = 'Documents';
        date_default_timezone_set('Asia/Atyrau');

        if(isset($_GET['lang']) && $_GET['lang'] == 'kz'){
            $this->$model->setLocale('kz');
        }elseif(isset($_GET['lang']) && $_GET['lang'] == 'en'){
            $this->$model->setLocale('en');
        }else{
            $this->$model->setLocale('ru');
        }

        if( $this->request->is('post') ){
            $data = $this->request->getData();

            $entity_res = $this->EntityFiles->saveEntityFiles($data, $model, $this->img_fields, $this->docs_fields);

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
        $model = 'Documents';
        date_default_timezone_set('Asia/Atyrau');

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

            $entity_res = $this->EntityFiles->saveEntityFiles($data1, $model, $this->img_fields, $this->docs_fields);

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
                $this->_docsDelete($old_data, $entity_res['doc_del']);
                $this->_cacheDelete();
                return $this->redirect( $this->referer() );
            }
            $this->Flash->error(__('Ошибка сохранения'));
        }

        $this->set( compact('data') );
    }

    public function delete($item_id = null){
        $model = 'Documents';

        $this->request->allowMethod(['post', 'delete']);

        $data = $this->$model->find('translations')
            ->where([$model.'.id' => $item_id])
            ->first();

        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_docsDelete($data, $this->docs_fields);
            $this->_cacheDelete();
            return $this->redirect( $this->referer() );
        } else{
            $this->Flash->error(__('Ошибка удаления'));
        }
    }

    protected function _docsDelete($data = null, $fields = array()){
        $folder = $this->docs_folder;
        $langs = ['ru', 'kz', 'en'];

        // if( $data['page_id'] == 0 ){
        //     $folder = 'admins';
        // }
        // if( $data['user_id'] != 0 ){
        //     $folder = 'users'.DS.$data['user_id'];
        // }

        if( $data && $fields ){
            foreach( $fields as $item ){
                if( isset($data[$item]) && $data[$item] ){
                    $fileName = WWW_ROOT.'files'.DS.$folder.DS.$data[$item];
                    if( file_exists($fileName) ){
                        unlink($fileName);
                    }
                    clearstatcache();
                }
                if( isset($data['_translations']) && $data['_translations'] ){
                    foreach( $langs as $l_key ){
                        if( isset($data['_translations'][$l_key][$item]) && $data['_translations'][$l_key][$item] ){
                            $fileName = WWW_ROOT.'files'.DS.$folder.DS.$data['_translations'][$l_key][$item];
                            if( file_exists($fileName) ){
                                unlink($fileName);
                            }
                            clearstatcache();
                        }
                    }
                }
            }
        }
    }

    protected function _cacheDelete(){
        // Cache::delete('operators_docs_ru', 'eternal');
        // Cache::delete('operators_docs_kz', 'eternal');
        // Cache::delete('operators_docs_en', 'eternal');
    }
}


?>
