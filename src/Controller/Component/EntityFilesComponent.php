<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class EntityFilesComponent extends Component{

	public function saveEntityFiles($data = array(), $model = '', $img_fields = array(), $doc_fields = array()){

		$controller = $this->getController();

        try {
            if( $data && $model ){

                $file_names = [];
                $image_objects = [];
                $entity_res = [
                    'entity' => [],
                    'img_del' => [],
                    'doc_del' => [],
                ];

                if( $img_fields ){
                    foreach( $img_fields as $item ){
                        if( isset($data[$item]) && $data[$item] ){
                            if( is_string($data[$item]) && mb_substr($data[$item], 0, 4) == 'data' && mb_strlen($data[$item]) > 255 ){
                                $image_objects[$item] = $data[$item];
                                $file_names[$item] = $data[$item];
                            } elseif( is_object($data[$item]) ){
                                $image_objects[$item] = $data[$item];
                                $file_names[$item] = $image_objects[$item]->getClientFilename();
                            }
                            unset($data[$item]);
                        }
                    }
                }
                if( $doc_fields ){
                    foreach( $doc_fields as $item ){
                        if( isset($data[$item]) && $data[$item] ){
                            $image_objects[$item] = $data[$item];
                            $file_names[$item] = $image_objects[$item]->getClientFilename();
                            unset($data[$item]);
                        }
                    }
                }

                $entity_res['entity'] = $controller->$model->newEntity($data);

                if( $img_fields ){
                    foreach( $img_fields as $item ){
                        if( isset($file_names[$item]) && $file_names[$item] ){
                            $entity_res['entity']->$item = $image_objects[$item];
                            if( $entity_res['entity']->get($item) == false ){
                                $entity_res['entity']->setError($item, [__('Ошибка валидации изображения')]);
                            } else{
                                $entity_res['img_del'][] = $item;
                            }
                        }
                    }
                }
                if( $doc_fields ){
                    foreach( $doc_fields as $item ){
                        if( isset($file_names[$item]) && $file_names[$item] ){
                            $entity_res['entity']->$item = $image_objects[$item];
                            if( $entity_res['entity']->get($item) == false ){
                                $entity_res['entity']->setError($item, [__('Ошибка валидации файла')]);
                            } else{
                                $entity_res['doc_del'][] = $item;
                            }
                        }
                    }
                }

            } else{
                $entity_res = [
                    'entity' => [],
                    'img_del' => [],
                    'doc_del' => [],
                ];
            }

            return $entity_res;
        } catch (\Exception $e) {
            $this->_setLogMsg('Error in saveEntityFiles: ' . $e->getMessage() . ' Model: ' . $model . ' Data: ' . json_encode($data) .  ' Fileinfo: ' . json_encode($_FILES), 'entity_files');
            return false;
        }
	}

    public function _setLogMsg($msg, $postfix) {
        date_default_timezone_set('Asia/Atyrau');
        $cur_date = date('m-Y');
        $cur_time = date('H:i:s');
        $postfix = '_'.$postfix.'_';
        $debug_file = WWW_ROOT .'test_logs'. DS. $cur_date. $postfix.'logs.txt';

        $log_msg = date('d-m-Y') . ' ' . $cur_time . ' - ' . $msg . "\n";
        file_put_contents($debug_file, $log_msg, FILE_APPEND | LOCK_EX);
    }
}

 ?>
