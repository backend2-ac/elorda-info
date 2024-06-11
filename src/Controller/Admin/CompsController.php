<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\I18n\I18n;
use Cake\Cache\Cache;

class CompsController extends AppController{

	public function initialize(): void{
		parent::initialize();
		$this->loadModel('Comps');
		$this->loadComponent('Paginator');
	}

	public function index(){
		$model = 'Comps';

		$cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

		$data = $this->Comps->find('translations')
			->where([
				$model.'.page_id' => 0
			])
			->order(['Comps.id' => 'DESC'])
			->limit($per_page)->offset($offset)
			->toList();

		$this->set( compact('data') );

		$this->set('pagination', $this->paginate(
            $this->$model->find('all')
            ->where([
            	$model.'.page_id' => 0,
            ])
            ->order(['Comps.id' => 'DESC'])
            ->limit($per_page),
            $pag_settings
        ));
	}

	public function add(){
		$model = 'Comps';

		if(isset($_GET['lang']) && $_GET['lang'] == 'kz'){
            $this->$model->setLocale('kz');
        }elseif(isset($_GET['lang']) && $_GET['lang'] == 'en'){
            $this->$model->setLocale('en');
        }else{
            $this->$model->setLocale('ru');
        }

		if( $this->request->is('post') ){
			$data = $this->request->getData();

			if( isset($data['img']) && $data['img'] ){
				$imageObject = $data['img'];
				$fileName = $imageObject->getClientFilename();
				unset($data['img']);
			}
			if( isset($data['doc']) && $data['doc'] ){
                $docObject = $data['doc'];
                $docName = $docObject->getClientFilename();
                unset($data['doc']);
            }

			$entity = $this->$model->newEntity($data);

			if( isset($fileName) && $fileName ){
				$entity->img = $imageObject;
				if( $entity->get('img') == false ){
					$entity->setError('img', [__('Ошибка валидации изображения')]);
				}
			}
			if( isset($docName) && $docName ){
                $entity->doc = $docObject;
                if( $entity->get('doc') == false ){
                    $entity->setError('doc', [__('Ошибка валидации документа')]);
                }
            }

			if( $entity->getErrors() ){
				$errors = $entity->getErrors();
				foreach( $errors as $index => $err ){
					$this->Flash->error( $err[array_key_first($err)] );
				}
				return $this->redirect( $this->referer() );
			}

			if( $this->$model->save($entity) ){
				$this->Flash->success(__('Данные успешно сохранены'));
				$this->_cacheDelete();
				return $this->redirect( $this->referer() );
			} else{
				$this->Flash->error(__('Ошибка сохранения данных'));
			}
		}
	}

	public function edit($item_id = null){
		$model = 'Comps';

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

	    	if( isset($data1['img']) && $data1['img'] ){
				$imageObject = $data1['img'];
				$fileName = $imageObject->getClientFilename();
				unset($data1['img']);
			}
			if( isset($data1['doc']) && $data1['doc'] ){
                $docObject = $data1['doc'];
                $docName = $docObject->getClientFilename();
                unset($data1['doc']);
            }

			$entity = $this->$model->newEntity($data1);

			if( isset($fileName) && $fileName ){
				$entity->img = $imageObject;
				if( $entity->get('img') == false ){
					$entity->setError('img', [__('Ошибка валидации изображения')]);
				}
			}
			if( isset($docName) && $docName ){
                $entity->doc = $docObject;
                if( $entity->get('doc') == false ){
                    $entity->setError('doc', [__('Ошибка валидации документа')]);
                }
            }

			if( $entity->getErrors() ){
				$errors = $entity->getErrors();
				foreach( $errors as $index => $err ){
					$this->Flash->error( $err[array_key_first($err)] );
				}
				return $this->redirect( $this->referer() );
			}

			$new_data = $entity->toArray();
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
		$model = 'Comps';

		$this->request->allowMethod(['post', 'delete']);
	    $data = $this->$model->get($item_id);

	    if ($this->$model->delete($data)) {
	        $this->Flash->success(__('Элемент был удален'));
	        $this->_cacheDelete();
	        return $this->redirect( $this->referer() );
	    } else{
	    	$this->Flash->error(__('Ошибка удаления'));
	    }
	}

	protected function _cacheDelete(){
        Cache::delete('comps_ru', 'long');
		Cache::delete('comps_kz', 'long');
		Cache::delete('comps_lang_kz', 'long');
        Cache::delete('comps_lang_ru', 'long');
		Cache::delete('page_comps_ru', 'long');
		Cache::delete('page_comps_kz', 'long');

        Cache::delete('all_comps_page_id_2', 'eternal');
        Cache::delete('all_comps_page_id_3', 'eternal');
		Cache::delete('all_comps_page_id_4', 'eternal');
        Cache::delete('all_comps_page_id_5', 'eternal');
        Cache::delete('all_comps_page_id_6', 'eternal');
        cache::delete('all_coms_kz', 'eternal');
        cache::delete('all_coms_ru', 'eternal');
        cache::delete('all_comps_lang_kz', 'eternal');
        cache::delete('all_comps_lang_ru', 'eternal');

    }
}

 ?>
