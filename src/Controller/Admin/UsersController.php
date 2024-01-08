<?php

namespace App\Controller\Admin;

use App\Controller\AppController; 
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Mailer\Mailer;

class UsersController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Users');
        $this->loadComponent('Paginator');
    }

    public function index(){
        $model = 'Users';

        $conditions = [];
        $type = '';
        $email = '';
        $name = '';
        $sel_status = '';

        if( isset($_GET['type']) ){
            if( $_GET['type'] == 'author' ){
                $conditions = [$model.'.role' => 'author'];
                $type = 'author';
            } elseif( $_GET['type'] == 'reviewer' ){
                $conditions = [$model.'.role' => 'reviewer'];
                $type = 'reviewer';
            }
        }

        if( isset($_GET['name']) && $_GET['name'] ){
            $name = htmlentities($_GET['name']);
            $name_items = explode(' ', $name);
            foreach( $name_items as $item ){
                $conditions[] = [
                    'OR' => [
                        [$model.'.name LIKE' => '%'. $item .'%'],
                        [$model.'.surname LIKE' => '%'. $item .'%'],
                    ]
                ];
            }
        }

        if( isset($_GET['email']) && $_GET['email'] ){
            $email = trim(htmlentities($_GET['email']));
            $conditions[] = [$model.'.username LIKE' => '%'.$email.'%'];
        }

        if( isset($_GET['is_active']) && $_GET['is_active'] ){
            if( $_GET['is_active'] == 'active' ){
                $conditions[] = [$model.'.is_active' => 1];
                $sel_status = 'active';
            } elseif( $_GET['is_active'] == 'inactive' ){
                $conditions[] = [$model.'.is_active' => 0];
                $sel_status = 'inactive';
            }
        }


        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20; // 20
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = $this->$model->find('all') 
            ->where($conditions)
            ->order([$model.'.created_at' => 'DESC'])
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set( compact('data') );

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            ->where($conditions)
            ->order([$model.'.created_at' => 'DESC'])
            ->limit($per_page), 
            $pag_settings
        ));

        $this->set( compact('sel_status', 'type', 'email', 'name') );
    }

    public function view($item_id){
        $model = 'Users';

        $data = $this->$model->get($item_id);

        if( !$data ){
            $this->Flash->error(__('Пользователь не найден'));
            return $this->redirect( $this->referer() );
        }

        // if( $this->request->is('post') ){
        //     $send_data = $this->request->getData();

        //     $msg = '';
        //     if( isset($send_data['message']) && $send_data['message'] ){
        //         $msg = htmlentities($send_data['message']);
        //     }

        //     $mailer = new Mailer("smtp");
        //     $mailer->viewBuilder()->setTemplate('default','default');
        //     $mailer
        //         ->setEmailFormat('html')
        //         ->setTo($data['username'])
        //         ->setFrom(['st-kotel.kz@yandex.ru' => 'cv.113.kz']);


        //     if( isset($send_data['user_id']) && $send_data['user_id'] == $item_id && $send_data['user_id'] == $data['id'] ){
        //         if( isset($send_data['submit_type']) && $send_data['submit_type'] ){
        //             if( $send_data['submit_type'] == 'deactivate' ){
        //                 if( $data['is_active'] ){
        //                     $activate = $this->$model->query()->update()->set(['is_active' => 0, 'ban_message' => $msg])->where(['id' => $send_data['user_id']]);
        //                     if( $activate->execute() ){
        //                         $this->Flash->success(__('Аккаунт успешно деактивирован'));

        //                         $message = '<p>Ваш аккаунт деактивирован Администратором сайта</p>';
        //                         if( $msg ){
        //                             $message .= '<p><b>Причина блокировки:</b> <br>'. $msg .'</p>';
        //                         }

        //                         if( $data['role'] == 'company' ){
        //                             $banned_vakancies = $this->Vakancies->query()->update()->set(['status' => 'banned'])->where(['user_id' => $send_data['user_id']]);
        //                             if( $banned_vakancies->execute() ){
        //                                 $this->Flash->success(__('Все вакансии данной Организации сняты с публикации и перенесены в Черновики'));
        //                                 $message .= '<p><em>Все ваши вакансии сняты с публикации и перенесены в Черновики</em></p>';

        //                             } else{
        //                                 $this->Flash->error(__('Не удалось снять с публикации вакансии данной Организации'));
        //                             }
        //                         }

        //                         if( $data['role'] == 'worker' ){
        //                             $has_job_alerts = $this->JobAlerts->find()
        //                                 ->select(['id', 'user_id'])
        //                                 ->where(['JobAlerts.user_id' => $data['id']])
        //                                 ->first();

        //                             if( $has_job_alerts ){
        //                                 $stop_alerts = $this->JobAlerts->query()->update()->set(['period' => 'stop'])->where(['user_id' => $data['id']]);
        //                                 if( $stop_alerts->execute() ){
        //                                     $this->Flash->success(__('Оповещения о вакансиях для данного Пользователя приостановлены'));
        //                                     $message .= '<p><em>Все ваши Оповещения о вакансиях приостановлены</em></p>';
        //                                 } else{
        //                                     $this->Flash->error(__('Ошибка остановки оповещений о вакансиях для Пользователя'));
        //                                 }
        //                             }
        //                         }

        //                         $mailer
        //                             ->setSubject('Деактивация аккаунта на сайте cv.113.kz')
        //                             ->setViewVars(['content' => $message]);

        //                         if( $mailer->send() ){
        //                             $this->Flash->success(__('Уведомление Пользователю успешно отправлено'));
        //                         } else{
        //                             $this->Flash->error(__('Ошибка отправки уведомление Пользователю'));
        //                         }

        //                     } else{
        //                         $this->Flash->error(__('Ошибка деактивации аккаунта'));
        //                     }

        //                     return $this->redirect( $this->referer() );

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Нельзя деактивировать не активный аккаунт'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } elseif( $send_data['submit_type'] == 'activate' ){
        //                 if( !$data['is_active'] ){
        //                     $activate = $this->$model->query()->update()->set(['is_active' => 1, 'ban_message' => null])->where(['id' => $send_data['user_id']]);
        //                     if( $activate->execute() ){
        //                         $this->Flash->success(__('Аккаунт успешно активирован'));

        //                         $message = '<p>Ваш аккаунт активирован Администратором сайта</p>';
        //                         $mailer
        //                             ->setSubject('Активация аккаунта на сайте cv.113.kz')
        //                             ->setViewVars(['content' => $message]);

        //                         if( $mailer->send() ){
        //                             $this->Flash->success(__('Уведомление Пользователю успешно отправлено'));
        //                         } else{
        //                             $this->Flash->error(__('Ошибка отправки уведомление Пользователю'));
        //                         }

        //                     } else{
        //                         $this->Flash->error(__('Ошибка активации аккаунта'));
        //                     }

        //                     return $this->redirect( $this->referer() );

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Нельзя активировать активный аккаунт'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } elseif( $send_data['submit_type'] == 'accept_reg' ){
        //                 if( $data['role'] == 'company' && !$data['is_active'] ){
        //                     if( $data['confirm_code'] ){

        //                         // $message = '<p><b>Для активации аккаунта перейдите по ссылке:</b> <a href="http://cv.113.kz/activation?user='. $data['username'] . '&code=' . $data['confirm_code'] .'">Активировать аккаунт</a> </p>';

        //                         $message = '<p style="font-size: 24px;">Спасибо, что вы с нами! </p><br>';
        //                         $message .= '<p>Здравствуйте! </p>';
        //                         $message .= '<p>Ваша заявка на регистрацию как организации <b>одобрена.</b> </p>';
        //                         $message .= '<p><b>Нажмите кнопку ниже, чтобы подтвердить свою учетную запись</b> </p>';
        //                         $message .= '<br><br><br><br><br><br>';

        //                         $message .= '<p>Искренне желаем Вам продуктивного дня!</p>';
        //                         $message .= '<p>С уважением,</p>';
        //                         $message .= '<p>команда iteach-kz@gmail.com</p>';
        //                         $message .= '<p>_________________</p>';
        //                         $message .= '<p>Появились вопросы? Позвоните нам +7 (707) 77 500 77 или пишите</p>';
        //                         $message .= '<p>whats up: +7 (707) 77 500 77</p>';

        //                         $message .= '<p><a style="display: inline-block; color: #FFFFFF; padding: 16px 119px; background: #1785E5; border-radius: 10px; font-weight: bold; text-decoration: none;" href="http://cv.113.kz/activation?user='. $data['username'] . '&code=' . $data['confirm_code'] .'">Активировать аккаунт</a></p>';

        //                         $mailer
        //                             ->setSubject('Одобрение регистрации на сайте cv.113.kz')
        //                             ->setViewVars(['content' => $message]);

        //                         if( $mailer->send() ){
        //                             $this->Flash->success(__('Уведомление Пользователю успешно отправлено'));
        //                         } else{
        //                             $this->Flash->error(__('Ошибка отправки уведомление Пользователю'));
        //                         }

        //                         return $this->redirect( $this->referer() );

        //                     } else{
        //                         $this->Flash->error(__('Ошибка! Отсутствует код активации'));
        //                         return $this->redirect( $this->referer() );
        //                     }

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Запрос на одобрение не опознан'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } elseif( $send_data['submit_type'] == 'reject_reg' ){
        //                 if( $data['role'] == 'company' && !$data['is_active'] ){
        //                     $reject = $this->$model->query()->update()->set(['ban_message' => $msg, 'confirm_code' => null])->where(['id' => $send_data['user_id']]);

        //                     if( $reject->execute() ){
        //                         $this->Flash->success(__('В регистрации успешно отказано'));

        //                         $message = '<p>Ваш аккаунт не прошел модерацию при регистрации на сайте cv.113.kz </p>';
        //                         if( $msg ){
        //                             $message .= '<p><b>Причина отказа:</b> <br>'. $msg .'</p>';
        //                         }

        //                         $mailer
        //                             ->setSubject('Отказ в регистрации на сайте cv.113.kz')
        //                             ->setViewVars(['content' => $message]);

        //                         if( $mailer->send() ){
        //                             $this->Flash->success(__('Уведомление Пользователю успешно отправлено'));
        //                         } else{
        //                             $this->Flash->error(__('Ошибка отправки уведомление Пользователю'));
        //                         }

        //                     } else{
        //                         $this->Flash->error(__('Ошибка в отказе регистрации'));
        //                     }

        //                     return $this->redirect( $this->referer() );

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Запрос на отказ не опознан'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } elseif( $send_data['submit_type'] == 'hidden_from_bases' ){
        //                 if( $data['role'] == 'worker' ){
        //                     $hide_q = $this->Users->query()->update()->set(['in_base' => 0])->where(['id' => $item_id]);
        //                     if( $hide_q->execute() ){
        //                         $this->Flash->success(__('Пользователь успешно скрыт из Базы Соискателей'));
        //                     } else{
        //                         $this->Flash->error(__('Ошибка сокрытия Пользователя из Базы Соискателей'));
        //                     }

        //                     return $this->redirect( $this->referer() );

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Запрос на скрытие не опознан'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } elseif( $send_data['submit_type'] == 'show_in_bases' ){
        //                 if( $data['role'] == 'worker' ){
        //                     $hide_q = $this->Users->query()->update()->set(['in_base' => 1])->where(['id' => $item_id]);
        //                     if( $hide_q->execute() ){
        //                         $this->Flash->success(__('Пользователь успешно отображен в Базе Соискателей'));
        //                     } else{
        //                         $this->Flash->error(__('Ошибка отображения Пользователя в Базе Соискателей'));
        //                     }

        //                     return $this->redirect( $this->referer() );

        //                 } else{
        //                     $this->Flash->error(__('Ошибка! Запрос на скрытие не опознан'));
        //                     return $this->redirect( $this->referer() );
        //                 }

        //             } else{
        //                 $this->Flash->error(__('Ошибка! Запрос не опознан'));
        //                 return $this->redirect( $this->referer() );
        //             }

        //         } else{
        //             $this->Flash->error(__('Ошибка! Неправильный запрос'));
        //             return $this->redirect( $this->referer() );
        //         }

        //     } else{
        //         $this->Flash->error(__('Ошибка! Неправильный ID Пользователя'));
        //         return $this->redirect( $this->referer() );
        //     }

        //     return $this->redirect( $this->referer() );
        // }

        $this->set( compact('data') );
    }
}


 ?>