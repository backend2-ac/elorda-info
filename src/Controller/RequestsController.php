<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\Utility\Text;

// use Cake\Mailer\Mailer;

class RequestsController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Requests');
        $this->loadComponent('Paginator');
    }

    public function send(){
        $model = 'Requests';
        date_default_timezone_set('Asia/Almaty');

        if( $this->request->is('post') ){
            $data = $this->request->getData();
            $data['date'] = date('Y-m-d H:i:s');

            $entity = $this->$model->newEntity($data);

            if( $entity->getErrors() ){
                $errors = $entity->getErrors();
                foreach( $errors as $index => $err ){
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            // $message = '<p><b>Имя:</b> ' . $data['name'] . '</p><p><b>Телефон: </b>' . $data['phone'] .' </p>';

            // $mailer = new Mailer("smtp");
            // $mailer->viewBuilder()->setTemplate('default','default');
            // $mailer
            //     ->setEmailFormat('html')
            //     ->setFrom(['st-kotel.kz@yandex.ru' => 'test.kz'])
            //     ->setTo('test@mail.ru')
            //     ->setSubject('Заявка с сайта test.kz')
            //     ->setViewVars(['content' => $message]);
                // ->send();

            if( $this->$model->save($entity) ){
                $this->Flash->success(__('Ваша заявка принята'));
                return $this->redirect( $this->referer() );
            } else{
                $this->Flash->error(__('Ошибка отправки'));
            }

        }
    }
}


 ?>
