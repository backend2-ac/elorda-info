<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\Utility\Text;

use Cake\Mailer\Mailer;

use Cake\Cache\Cache;

class RequestsController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Requests');
        $this->loadComponent('EntityFiles');
        $this->loadComponent('Paginator');
    }

    public function send(){
        $model = 'Requests';
        date_default_timezone_set('Asia/Almaty');

//        $requests_email = $this->_getRequestEmail();
        $requests_email = 'mmanmurynov@mail.ru';
        $site_name = $_SERVER['HTTP_HOST'];

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

            if( $requests_email ){
                $message = '<p><b>Новая заявка с сайта '. $site_name .'</b></p>';
                $message .= '<p><b>Email:</b> '. $data['email'] .'</p>';

                $mailer = new Mailer("smtp");
                $mailer->viewBuilder()->setTemplate('default','default');
                $mailer
                    ->setEmailFormat('html')
                    ->setFrom(['st-kotel.kz@yandex.ru' => $site_name])
                    ->setTo($requests_email)
                    ->setSubject('Заявка с сайта ' . $site_name)
                    ->setViewVars(['content' => $message]);
            }


            if( $this->$model->save($entity_res['entity']) ){
                $this->Flash->success(__('Ваша заявка принята'));
                if( $requests_email ){
                    $mailer->send();
                }
                return $this->redirect( $this->referer() );
            } else{
                $this->Flash->error(__('Ошибка отправки'));
            }
        }
    }
}

?>
