<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validator;

use Cake\Utility\Text;
use Cake\Cache\Cache;

use Cake\ORM\Query;
use Cake\Mailer\Mailer;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\ForbiddenException;

use Cake\Core\Configure;
use Cake\Http\Response;


use Cake\Routing\Router;

class UsersController extends AppController{
	public function initialize(): void{
		parent::initialize();
		$this->loadModel('Pages');

		$this->loadModel('Users');

		$this->loadModel('Articles');
		$this->loadModel('UsersArticles');

		$this->loadComponent('EntityFiles');
		$this->loadComponent('Paginator');
		$this->loadComponent('Authentication.Authentication');
	}

	// public $img_folder = 'users';
 //    public $img_fields = ['img'];

	public $articles_statuses = [
		'sended' => 'Отправлено', // default, system -
		'delivered' => 'Получено', // system
		'on_review' => 'На рецензировании',
		'for_correction' => 'На доработке',
		'accepted' => 'Принята',
		'rejected' => 'Отклонена',
		'pending_payment' => 'Ждет оплаты',
	];

	public $users_articles_statuses = [
		'new' => 'Новая работа', // system
		// 'canceled' => 'Отмена',// статус не показывается никому. при этом статусе Рецензент не может оценивать работу потому что его сменили
		'accepted' => 'Принята',
		'rejected' => 'Отклонена',
		'for_correction' => 'На доработку',
		'fixed' => 'Исправлено', // system
		'file_updated' => 'Файл обновлен', // system
	];

	public $system_statuses = ['sended', 'delivered', 'new', 'fixed', 'file_updated'];

	public function beforeFilter(\Cake\Event\EventInterface $event){
	    parent::beforeFilter($event);
	    // Configure the login action to not require authentication, preventing
	    // the infinite redirect loop issue
	    $this->Authentication->addUnauthenticatedActions(['login', 'registration', 'forgetpwd', 'checkEmail', 'activation', 'checkresponse', 'checkresponsetariff', 'checkresponsebases']);
	}

	public function index(){
		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
	}

	public function login(){
		$this->Authorization->skipAuthorization();

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

	    $this->request->allowMethod(['get', 'post']);
	    $result = $this->Authentication->getResult();

	    $session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');

		if( $userAuth && ($userAuth['role'] == 'author' || $userAuth['role'] == 'reviewer') ){
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

	    if( $this->request->is('post') ){
	    	if( $result->isValid() ){
	    		$user = $result->getData();
	    		if( !$user['is_active'] ){
	    			$this->Authentication->logout();
	    			$this->Flash->error(__('Ваш аккаунт не активирован'));
	    			return $this->redirect( $this->referer() );
	    		} else{
	    			$redirect_url = $session->read('redirect_url');
	    			if( $redirect_url ){
	    				$session->delete('redirect_url');
	    				return $this->redirect($redirect_url);
	    			}
	    			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
	    		}
	    	} elseif( !$result->isValid() ){
	    		$this->Flash->error(__('Неправильный логин или пароль'));
	    	}

	    	return $this->redirect( $this->referer() );
	    }

	    $page = $this->Pages->get(5);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $redirect_url = '';
        if( isset($_GET['redirect']) && $_GET['redirect'] ){
        	$redirect_url = $_GET['redirect'];
        	$session->write('redirect_url', $redirect_url);
        }

	    $this->set( compact('guest_login', 'meta', 'redirect_url') );
	}

	public function logout(){
		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		$this->Authorization->skipAuthorization();
	    $result = $this->Authentication->getResult();

	    // regardless of POST or GET, redirect if user is logged in
	    if ($result->isValid()) {
	        $this->Authentication->logout();
	        $session = $this->request->getSession();
	        return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
	    }
	}

	public function registration(){
		$model = 'Users';
		$site_name = 'iaar-edu-loc';

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');

		if( $userAuth && ($userAuth['role'] == 'author' || $userAuth['role'] == 'reviewer') ){
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

		if( $this->request->is('post') ){
			$data = $this->request->getData();

			if( $data['username'] ){
				$data['username'] = trim($data['username']);
				$created = $this->$model->find()
					->where([$model.'.username' => $data['username']])
					->first();
				if( $created ){
					$this->Flash->error(__('Данный E-mail уже зарегистрирован'));
					return $this->redirect( $this->referer() );
				}
			} else{
				$this->Flash->error(__('Введите ваш E-mail'));
				return $this->redirect( $this->referer() );
			}

			if( mb_strlen($data['password']) < 6 || mb_strlen($data['password_repeat']) < 6 ){
				$this->Flash->error(__('Пароль не должен быть короче 6 символов'));
				return $this->redirect( $this->referer() );
			}
			if( mb_strlen($data['password']) > 16 || mb_strlen($data['password_repeat']) > 16 ){
				$this->Flash->error(__('Пароль не должен быть длиннее 16 символов'));
				return $this->redirect( $this->referer() );
			}

			if( $data['password'] && ($data['password_repeat'] == $data['password']) ){
				$new_passwd = password_hash($data['password'], PASSWORD_BCRYPT);
				$data['password'] = $new_passwd;
			} else{
				$this->Flash->error(__('Введите ваш пароль'));
				return $this->redirect( $this->referer() );
			}

			$data['is_active'] = 0; // верификация через почту
	    	$data['confirm_code'] = md5('confirm code - ' . date('Y-m-d H:i:s') . ' for ' . $data['username']);

			$entity_res = $this->EntityFiles->saveEntityFiles($data, $model);

			if( $this->$model->save($entity_res['entity']) ){

				/*------- For Admin BEGIN ------*/

					// $message = '<p><b>Уведомление о заявки организации</b></p>';
					// $message .= '<p>На сайт iteach-kz.com пришла заявку на регистрацию от организации: <b>'. htmlentities($entity_res['entity']->name) .'</b></p>';
					// $mailer = new Mailer("smtp");
					// $mailer->viewBuilder()->setTemplate('default','default');
					// $mailer
					//     ->setEmailFormat('html')
					//     ->setFrom(['st-kotel.kz@yandex.ru' => $site_name])
					//     ->setTo('jas_98kz@mail.ru') // Admin
					//     ->setSubject('Уведомление о регистрации нового Пользователя')
					//     ->setViewVars(['content' => $message]);
					// $mailer->send();

				/*------- For Admin END ------*/

				$this->Flash->success(__('Вы успешно зарегистрировались'));

				$message = '<p><b>Для активации аккаунта перейдите по ссылке:</b> <a href="http://iaar-edu-loc/activation?user='. $data['username'] . '&code=' . $data['confirm_code'] .'" target="_blank">Активировать аккаунт</a> </p>';

				$mailer = new Mailer("smtp");
				$mailer->viewBuilder()->setTemplate('default','default');
				$mailer
				    ->setEmailFormat('html')
				    ->setFrom(['st-kotel.kz@yandex.ru' => $site_name])
				    ->setTo($data['username'])
				    ->setSubject('Активация аккаунта на сайте '.$site_name)
				    ->setViewVars(['content' => $message]);

				if( $mailer->send() ){
					$this->Flash->success(__('На вашу почту было отправлено письмо для активации аккаунта'));
				} else{
					$this->Flash->error(__('Ошибка отправки кода активации'));
				}

				return $this->redirect( $site_lang . Router::pathUrl('Users::login') );

			} else{
				$this->Flash->error(__('Ошибка регистрации. Попробуйте еще раз'));
			}

			return $this->redirect( $this->referer() );
		}

		$page = $this->Pages->get(6);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

		$this->set( compact('meta') );
	}

	public function activation(){
		$model = 'Users';
		$this->autoRender = false;

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		$username = '';
		$code = '';
		$cur_user = [];

		if( isset($_GET['user']) && $_GET['user'] ){
			$username = htmlentities($_GET['user']);
			$cur_user = $this->$model->find()
				->select(['id', 'username', 'confirm_code', 'role'])
				->where([$model.'.username' => $username])
				->first();

			if( !$cur_user ){
				$this->Flash->error(__('Ошибка активации! Пользователь с данной почтой не найден'));
				return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
			}

		} else{
			$this->Flash->error(__('Ошибка активации! Почта не указана'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
		}

		if( isset($_GET['code']) && $_GET['code'] ){
			$code = $_GET['code'];
		} else{
			$this->Flash->error(__('Ошибка активации! Код активации отсутствует'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
		}

		if( $cur_user['confirm_code'] == $code ){
			$activate = $this->$model->query()->update()->set(['is_active' => 1, 'confirm_code' => null])->where(['id' => $cur_user['id'], 'username' => $username]);
			if( $activate->execute() ){
				$this->Flash->success(__('Ваш аккаунт успешно активирован'));
			} else{
				$this->Flash->error(__('Ошибка активации!'));
			}
			return $this->redirect( $site_lang . Router::pathUrl('Users::login') );

		} else{
			$this->Flash->error(__('Ошибка активации! Неправильный код активации'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
		}

		return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
	}

	public function security(){

	}

	public function pswedit(){
		$this->autoRender = false;
		$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');
		$result = $this->Authentication->getResult();
		$user_id = $userAuth['id'];

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		if( $this->request->is('post') ){
			$data = $this->request->getData();
			$old_pwd = $data['old_password'];

			if( mb_strlen($data['new_password']) < 6 || mb_strlen($data['new_password_repeat']) < 6 || mb_strlen($data['old_password']) < 6 ){
				$this->Flash->error(__('Пароль не должен быть короче 6 символов'));
				return $this->redirect( $this->referer() );
			}
			if( mb_strlen($data['new_password']) > 16 || mb_strlen($data['new_password_repeat']) > 16 || mb_strlen($data['old_password']) > 16 ){
				$this->Flash->error(__('Пароль не должен быть длиннее 16 символов'));
				return $this->redirect( $this->referer() );
			}

			if( (new DefaultPasswordHasher)->check($old_pwd, $userAuth['password']) ){
				if( $data['new_password'] == $data['new_password_repeat'] ){
					$new_pwd = password_hash($data['new_password'], PASSWORD_BCRYPT);
					if( $this->Users->query()->update()->set(['password' => $new_pwd])->where(['id' => $user_id])->execute() ){
						$updated_user = $this->Users->get($user_id);
						$this->request->getSession()->write('UserAuth',  $updated_user);
						$this->Flash->success(__('Пароль успешно обновлен'));
						// return $this->redirect( $this->referer() );
						return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );

					} else{
						$this->Flash->error(__('Ошибка обновления пароля'));
					}

				} else{
					$this->Flash->error(__('Пароли не совпадают'));
				}

			} else{
				$this->Flash->error(__('Неправильный текущий пароль'));
			}

			return $this->redirect( $this->referer() );
		}
	}

	public function forgetpwd($number = null){
		$this->Authorization->skipAuthorization();
		date_default_timezone_set('Asia/Almaty');
		$site_name = 'iaar-edu-loc';
		$site_full_name = 'IAAR Education (loc)';

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		$session = $this->request->getSession();
		$step = $session->read('forgetpwd_step');

		if( $this->request->is('post') ){
			$data = $this->request->getData();

			if( $data['submit_type'] == 'email_code' ){
				if( $step != 1 ){
					$username = htmlentities($data['username']);
					$user = null;
					if( $username ){
						$user = $this->Users->find()->where(['Users.username' => $username])->first();
					}

					if( !$user ){
						$this->Flash->error(__('Пользователя с таким логином не существует'));
						return $this->redirect( $site_lang . Router::pathUrl('Users::login') );

					} else{
						$forgetpwd_rand = rand(100000, 999999);
						$forgetpwd = $this->_checkRand($forgetpwd_rand);

						$update_q = $this->Users->query()->update()->set(['forgetpwd' => $forgetpwd])->where(['username' => $username]);
						if( $update_q->execute() ){
							$message = "<p>Код восстановления пароля: ". $forgetpwd ."</p>";

							$mailer = new Mailer("smtp");
							$mailer->viewBuilder()->setTemplate('default','default');
							$mailer
							    ->setEmailFormat('html')
							    ->setFrom(['st-kotel.kz@yandex.ru' => $site_name])
							    ->setTo($username)
							    ->setSubject('Восстановление пароля на сайте '.$site_full_name)
							    ->setViewVars(['content' => $message]);

							if( $mailer->send() ){
								$this->Flash->success(__('На указанный E-mail отправлено письмо'));
								$session->write('forgetpwd_step',  1);
								$session->write('forgetpwd_username',  $username);
	    						$step = $session->read('forgetpwd_step');

							} else{
								$this->Flash->error(__('Ошибка отправки письма'));
							}
						} else{
							$this->Flash->error(__('Ошибка сброса пароля. Повторите попытку снова'));
						}
					}
				}

			} elseif( $data['submit_type'] == 'code_submit' ){
				if( $step != 2 ){
					$username = $session->read('forgetpwd_username');
					$forgetpwd_code = $data['code'];

					$user = null;
					if( $username ){
						$user = $this->Users->find()->where(['Users.username' => $username])->first();
					}

					if( !$user ){
						$this->Flash->error(__('Пользователя с таким логином не существует'));
						return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
					} else{
						if( $user['forgetpwd'] == $forgetpwd_code ){
							$session->write('forgetpwd_step',  2);
    						$step = $session->read('forgetpwd_step');

						} else{
							$this->Flash->error(__('Ошибка сброса пароля. Неверный код верификации'));
							return $this->redirect( $this->referer() );
						}
					}
				}

			} elseif( $data['submit_type'] == 'pwd_submit' ){
				if( $step == 2 ){
					$username = $session->read('forgetpwd_username');
					$user = null;
					if( $username ){
						$user = $this->Users->find()->where(['Users.username' => $username])->first();
					}

					if( !$user ){
						$this->Flash->error(__('Пользователя с таким логином не существует'));
						return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
					}

					if( mb_strlen($data['new_pwd']) < 6 || mb_strlen($data['repeat_new_pwd']) < 6 ){
						$this->Flash->error(__('Пароль не должен быть короче 6 символов'));
						return $this->redirect( $this->referer() );
					}
					if( mb_strlen($data['new_pwd']) > 16 || mb_strlen($data['repeat_new_pwd']) > 16 ){
						$this->Flash->error(__('Пароль не должен быть длиннее 16 символов'));
						return $this->redirect( $this->referer() );
					}

					if( $data['new_pwd'] == $data['repeat_new_pwd'] ){
						$new_pwd = password_hash($data['new_pwd'], PASSWORD_BCRYPT);
						$user_update = $this->Users->query()->update()->set(['password' => $new_pwd, 'forgetpwd' => null])->where(['id' => $user['id'], 'username' => $user['username']]);
						if( $user_update->execute() ){
							$this->Flash->success(__('Пароль успешно обновлен'));
							$session->delete('forgetpwd_username');
							$session->delete('forgetpwd_step');
							return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
						} else{
							$this->Flash->error(__('Ошибка обновления пароля'));
						}

					} else{
						$this->Flash->error(__('Пароли не совпадают'));
					}
				}

			} else{
				$this->Flash->error(__('Ошибка сброса пароля. Повторите попытку снова'));
				return $this->redirect( $site_lang . Router::pathUrl('Users::login') );
			}

		}

		$this->set( compact('step') );
	}


	public function cabinet(){
		$model = 'Users';
		date_default_timezone_set('Asia/Almaty');
		$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');

		if( $this->request->is(['post', 'put']) ){
			$data1 = $this->request->getData();
			$data = $this->$model->get($data1['id']);
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
                $updated_user = $this->$model->get($data1['id']);
                $this->request->getSession()->write('UserAuth',  $updated_user);
                return $this->redirect( $this->referer() );
            }
            $this->Flash->error(__('Ошибка сохранения'));
		}


		if( $userAuth['role'] == 'author' ){

			/*----- Authors -----*/

				$articlesModel = 'Articles';
				$journals_series = $this->_getJournalsSeries();
	        	$articles_statuses = $this->articles_statuses;

	        	$conditions = [
					$articlesModel.'.user_id' => $userAuth['id'],
				];

				$cur_page = 1;
			    if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
			        $cur_page = $_GET['page'];
			    }
			    $per_page = 4; // 6
			    $offset = ($cur_page * $per_page) - $per_page;
			    $pag_settings = [
			        'limit' => $per_page,
			    ];

			    $articles = $this->$articlesModel->find('all')
			    	->contain([
			    		'UsersArticles' => [
			    			'conditions' => [
			    				'UsersArticles.status !=' => 'canceled'
			    			],
			    		]
			    	])
			    	->where($conditions)
			        ->order($articlesModel.'.created_at DESC')
			        ->limit($per_page)->offset($offset)
			        ->toList();

			    $this->set('pagination', $this->paginate(
			        $this->$articlesModel->find('all')
			        	->where($conditions)
			            ->select(['id', 'title'])
			            ->order($articlesModel.'.created_at DESC')
			            ->limit($per_page),
			        $pag_settings
			    ));

				$this->set( compact('articles', 'journals_series', 'articles_statuses') );
			/*----- Authors END -----*/

		} elseif( $userAuth['role'] == 'reviewer' ){

			/*----- Reviwers -----*/

				$revModel = 'UsersArticles';
				$journals_series = $this->_getJournalsSeries();
        		$users_articles_statuses = $this->users_articles_statuses;
        		$system_statuses = $this->system_statuses;

        		$conditions = [
        			$revModel.'.reviewer_id' => $userAuth['id'],
        		];

    			$cur_page = 1;
    		    if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
    		        $cur_page = $_GET['page'];
    		    }
    		    $per_page = 6; // 6
    		    $offset = ($cur_page * $per_page) - $per_page;
    		    $pag_settings = [
    		        'limit' => $per_page,
    		    ];

    		    $articles = $this->$revModel->find('all')
    		    	->where($conditions)
    		    	->contain('Articles')
    		        ->order($revModel.'.created_at DESC')
    		        ->limit($per_page)->offset($offset)
    		        ->toList();

    		    $this->set('pagination', $this->paginate(
    		        $this->$revModel->find('all')
    		        	->where($conditions)
    		        	->contain('Articles')
    		            ->select(['id', 'reviewer_id', 'created_at'])
    		            ->order($revModel.'.created_at DESC')
    		            ->limit($per_page),
    		        $pag_settings
    		    ));

    			$this->set( compact('articles', 'journals_series', 'users_articles_statuses', 'system_statuses') );

			/*----- Reviwers END -----*/
		}
	}

	public function articleAdd(){
    	$model = 'Articles';
    	date_default_timezone_set('Asia/Almaty');

    	$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		$loc_img_fields = [];
		$loc_docs_fields = ['doc'];

    	$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');

		if( $userAuth['role'] != 'author' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

    	if( $this->request->is('post') ){
            $data = $this->request->getData();
            $data['user_id'] = $userAuth['id'];
            $data['status'] = 'sended';
            $data['user_updated_at'] = date('Y-m-d H:i:s');

            // $entity_res['entity'] = $this->$model->newEntity($data);
            $entity_res = $this->EntityFiles->saveEntityFiles($data, $model, $loc_img_fields, $loc_docs_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            if( $this->$model->save($entity_res['entity']) ){
            	$this->Flash->success(__('Данные успешно сохранены'));

            	/*---- Админу приходит уведомление о новой статье, к которой нужно прикрепить Рецензентов ---*/

            	return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
            	// return $this->redirect( $this->referer() );
            } else{
                $this->Flash->error(__('Ошибка сохранения данных'));
            }
        }

     //    $journals_series = $this->_getJournalsSeries();

    	// $this->set( compact('journals_series') );
    }

    public function articleEdit($item_id = null){
    	$model = 'Articles';
    	date_default_timezone_set('Asia/Almaty');
    	$session = $this->request->getSession();
    	$userAuth = $session->read('UserAuth');

    	$loc_img_fields = [];
		$loc_docs_fields = ['doc'];

    	$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

    	if( $userAuth['role'] != 'author' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $this->referer() );
		}

		$data = $this->$model->get($item_id);
		if( $data['user_id'] != $userAuth['id'] ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $this->referer() );
		}

		if( is_null($item_id) || !(int)$item_id || !$data ){
            throw new NotFoundException(__('Запись не найдена'));
        }

        if( $data['status'] != 'for_correction' ){
        	$this->Flash->error(__('Статью можно редактировать только если она на доработке'));
			return $this->redirect( $this->referer() );
        }

    	if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;

            if( $old_data['status'] == 'for_correction' ){
            	$data1['status'] = 'on_review';
            }

            $entity_res = $this->EntityFiles->saveEntityFiles($data1, $model, $loc_img_fields, $loc_docs_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            $new_data = $entity_res['entity']->toArray();
            $this->$model->patchEntity($data, $new_data);

            if( $data->isDirty('title') || $data->isDirty('doc') || $data->isDirty('journals_series_id') ){
            	$data['user_updated_at'] = date('Y-m-d H:i:s');
            }

            if ($this->$model->save($data)) {
                $this->Flash->success(__('Работа отправлена на повторное рецензирование'));
                $this->_articlesDocsDelete($old_data, $entity_res['doc_del']);

                if( $old_data['status'] == 'for_correction' ){
                	$fixed_update = $this->UsersArticles->query()->update()
	                	->set([
	                		'status' => 'fixed'
	                	])
	                	->where([
	                		'article_id' => $item_id,
	                		'status IN' => ['for_correction', 'rejected']
	                	])
	                	->execute();

                	$file_updated = $this->UsersArticles->query()->update()
                		->set(['status' => 'file_updated'])
                		->where([
                			'article_id' => $item_id,
                			'status' => 'accepted'
                		])
                		->execute();
                }

                return $this->redirect( $this->referer() );
                // return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
                // return $this->redirect( $site_lang . Router::pathUrl('Users::articles') );
            }
            $this->Flash->error(__('Ошибка сохранения'));
        }

     //    $journals_series = $this->_getJournalsSeries();

    	// $this->set( compact('data', 'journals_series') );
    }

    public function articleView($item_id = null){
    	$model = 'Articles';
    	date_default_timezone_set('Asia/Almaty');
    	$session = $this->request->getSession();
    	$userAuth = $session->read('UserAuth');

    	$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

    	if( $userAuth['role'] != 'author' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

		$data = $this->$model->get($item_id);
		if( $data['user_id'] != $userAuth['id'] ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

		if( is_null($item_id) || !(int)$item_id || !$data ){
            throw new NotFoundException(__('Запись не найдена'));
        }

        $journals_series = $this->_getJournalsSeries();
        $users_articles = $this->UsersArticles->find('all')
        	->where([
        		'UsersArticles.article_id' => $item_id,
        		'UsersArticles.status !=' => 'canceled'
        	])
        	->toList();

        $articles_statuses = $this->articles_statuses;

    	$this->set( compact('data', 'journals_series', 'users_articles', 'articles_statuses') );
    }

    public function articles(){
    	$model = 'Articles';
    	$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');
		date_default_timezone_set('Asia/Almaty');

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		if( $userAuth['role'] != 'author' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

		$journals_series = $this->_getJournalsSeries();
        $articles_statuses = $this->articles_statuses;

		$conditions = [
			$model.'.user_id' => $userAuth['id'],
		];

		$s_title = '';
        $j_series_id = '';
        $a_status_id = '';

        if( isset($_GET['s_title']) && $_GET['s_title'] ){
            $str = htmlentities(trim($_GET['s_title']));
            if( mb_strlen($str) > 0 ){
                $conditions[] = [$model.'.title LIKE' => '%'.$str.'%'];
                $s_title = $str;
            }
        }
        if( isset($_GET['j_series_id']) && $_GET['j_series_id'] ){
            if( array_key_exists($_GET['j_series_id'], $journals_series) ){
                $conditions[] = [$model.'.journals_series_id' => $_GET['j_series_id']];
                $j_series_id = $_GET['j_series_id'];
            }
        }
        if( isset($_GET['a_status_id']) && $_GET['a_status_id'] ){
            if( array_key_exists($_GET['a_status_id'], $articles_statuses) ){
                $conditions[] = [$model.'.status' => $_GET['a_status_id']];
                $a_status_id = $_GET['a_status_id'];
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
            ->order($model.'.created_at DESC')
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            	->where($conditions)
                ->select(['id', 'title'])
                ->order($model.'.created_at DESC')
                ->limit($per_page),
            $pag_settings
        ));

    	$this->set( compact('data', 'journals_series', 'articles_statuses') );

    	// search vars
    	$this->set( compact('s_title', 'j_series_id', 'a_status_id') );
    }


    public function usersArticles(){
    	$model = 'UsersArticles';
    	$session = $this->request->getSession();
		$userAuth = $session->read('UserAuth');
		date_default_timezone_set('Asia/Almaty');

		$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

		if( $userAuth['role'] != 'reviewer' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );
		}

		$journals_series = $this->_getJournalsSeries();
        $users_articles_statuses = $this->users_articles_statuses;

		$conditions = [
			$model.'.reviewer_id' => $userAuth['id'],
		];

		$s_title = '';
        $j_series_id = '';
        $u_a_status_id = '';

        if( isset($_GET['s_title']) && $_GET['s_title'] ){
            $str = htmlentities(trim($_GET['s_title']));
            if( mb_strlen($str) > 0 ){
                $conditions[] = ['Articles.title LIKE' => '%'.$str.'%'];
                $s_title = $str;
            }
        }
        if( isset($_GET['j_series_id']) && $_GET['j_series_id'] ){
            if( array_key_exists($_GET['j_series_id'], $journals_series) ){
                $conditions[] = ['Articles.journals_series_id' => $_GET['j_series_id']];
                $j_series_id = $_GET['j_series_id'];
            }
        }
        if( isset($_GET['u_a_status_id']) && $_GET['u_a_status_id'] ){
            if( array_key_exists($_GET['u_a_status_id'], $users_articles_statuses) ){
                $conditions[] = [$model.'.status' => $_GET['u_a_status_id']];
                $u_a_status_id = $_GET['u_a_status_id'];
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
        	->contain('Articles')
            ->order($model.'.created_at DESC')
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            	->where($conditions)
            	->contain('Articles')
                ->select(['id', 'reviewer_id', 'created_at'])
                ->order($model.'.created_at DESC')
                ->limit($per_page),
            $pag_settings
        ));

    	$this->set( compact('data', 'journals_series', 'users_articles_statuses') );

    	// search vars
    	$this->set( compact('s_title', 'j_series_id', 'u_a_status_id') );
    }

    public function usersArticleEdit($item_id = null){
    	$model = 'UsersArticles';
    	date_default_timezone_set('Asia/Almaty');
    	$session = $this->request->getSession();
    	$userAuth = $session->read('UserAuth');

    	$site_lang = Configure::read('Config.lang');
		if( !$site_lang || $site_lang == 'ru' ){
			$site_lang = '';
		}

    	if( $userAuth['role'] != 'reviewer' ){
			$this->Flash->error(__('У вас нет доступа к этой странице'));
			return $this->redirect( $this->referer() );
		}

		$data = $this->$model->get($item_id, [
    		'contain' => ['Articles']
    	]);

    	if( is_null($item_id) || !(int)$item_id || !$data ){
            throw new NotFoundException(__('Запись не найдена'));
        }

		if( $data['reviewer_id'] != $userAuth['id'] ){
			$this->Flash->error(__('Вы не являетесь рецензентом данной статьи'));
			return $this->redirect( $this->referer() );
		}

        if( $data['status'] != 'new' && $data['status'] != 'for_correction' && $data['status'] != 'fixed' ){
        	$this->Flash->error(__('Статью можно редактировать только если она новая или на доработке'));
			return $this->redirect( $this->referer() );
        }

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
                return $this->redirect( $this->referer() );
            }
            $this->Flash->error(__('Ошибка сохранения'));
        }

        $journals_series = $this->_getJournalsSeries();
        $users_articles_statuses = $this->users_articles_statuses;
        $system_statuses = $this->system_statuses;

    	$this->set( compact('data', 'journals_series', 'users_articles_statuses', 'system_statuses') );
    }



    /*------- not used -------*/

	    public function sendCode(){
	    	$site_lang = Configure::read('Config.lang');
			if( !$site_lang || $site_lang == 'ru' ){
				$site_lang = '';
			}

	    	$session = $this->request->getSession();
			$userAuth = $session->read('UserAuth');
			date_default_timezone_set('Asia/Almaty');

			$step = $session->read('login_change_steps');

	    	if( $this->request->is('post') ){
	    		$data = $this->request->getData();

	    		if( $data['submit_type'] == 'login_change' ){
	    			if( $step != 1 ){
		    			$confirm_code = 'confirm code - ' . date('Y-m-d H:i:s') . ' for ' . $userAuth['id'];
		    			$code = md5($confirm_code);

		    			$this->Users->query()->update()->set(['confirm_code' => $code])->where(['id' => $userAuth['id']])->execute();
		    			$userAuth['confirm_code'] = $code;
		    			$session->write('UserAuth',  $userAuth);

		    			$message = '<p><b>Ваш код верификации:</b> ' . $code .' </p>';

		    			$mailer = new Mailer("smtp");
		    			$mailer->viewBuilder()->setTemplate('default','default');
		    			$mailer
		    			    ->setEmailFormat('html')
		    			    ->setFrom(['st-kotel.kz@yandex.ru' => 'cv.113.kz'])
		    			    ->setTo($userAuth['username'])
		    			    ->setSubject('Смена логина на сайте cv.113.kz')
		    			    ->setViewVars(['content' => $message]);

		    			if( $mailer->send() ){
		    				$this->Flash->success(__('На вашу почту <b>'. $userAuth['username'] .'</b> был отправлен код верификации'));
		    				$session->write('login_change_steps',  1);
		    				$step = $session->read('login_change_steps');

		    			} else{
		    				$this->Flash->error(__('Ошибка отправки кода! Обновите страницу и попробуйте снова'));
		            		// return $this->redirect( ['controller' => 'Users', 'action' => 'security'] );
		            		return $this->redirect( $site_lang . Router::pathUrl('Users::security') );
		    			}
	    			}

	    		} elseif( $data['submit_type'] == 'confirm_code' ){
	    			if( $step != 2 ){

	    				if( $userAuth['confirm_code'] ){
	    					$user_code = $userAuth['confirm_code'];
	    				} else{
	    					$cur_user = $this->Users->get($userAuth['id']);
	    					if( $cur_user ){
	    						$user_code = $cur_user['confirm_code'];
	    					}
	    				}

	    				if( !isset($user_code) || !$user_code ){
	    					$this->Flash->error(__('Ошибка! Код верификации не найден'));
	    					return $this->redirect( $this->referer() );
	    				}

	    				if( isset($data['code']) && $data['code'] == $user_code ){
	    					$session->write('login_change_steps',  2);
		    				$step = $session->read('login_change_steps');

	    				} else{
	    					$this->Flash->error(__('Ошибка! Неправильный код верификации'));
			            	return $this->redirect( $this->referer() );
	    				}
	    			}

	    		} elseif( $data['submit_type'] == 'change_email' ){
	    			if( $step != 3 ){
	    				if( isset($data['email']) && $data['email'] ){
	    					$new_email = htmlspecialchars($data['email']);
	    					$has_email = $this->Users->find()
	    						->where([
	    							'OR' => [
	    								['Users.username' => $new_email],
	    								['Users.new_email' => $new_email],
	    							]
	    						])
	    						->first();

	    					if( $has_email ){
	    						$this->Flash->error(__('Данная почта уже занята'));
				            	return $this->redirect( $this->referer() );
	    					}

	    					$verify_code = 'verify code - ' . date('Y-m-d H:i:s') . ' for ' . $userAuth['id'];
		    				$code = md5($verify_code);

	    					$this->Users->query()->update()->set(['new_email' => $new_email, 'verify_code' => $code])->where(['id' => $userAuth['id']])->execute();
	    					$userAuth['new_email'] = $new_email;
	    					$userAuth['verify_code'] = $code;
	    					$session->write('UserAuth',  $userAuth);

							$message = '<p><b>Ваш код верификации для новой почты:</b> ' . $code .' </p>';

							$mailer = new Mailer("smtp");
							$mailer->viewBuilder()->setTemplate('default','default');
							$mailer
							    ->setEmailFormat('html')
							    ->setFrom(['st-kotel.kz@yandex.ru' => 'cv.113.kz'])
							    ->setTo($new_email)
							    ->setSubject('Подтверждение новой почты на сайте cv.113.kz')
							    ->setViewVars(['content' => $message]);

							if( $mailer->send() ){
								$this->Flash->success(__('На вашу почту <b>'. $new_email .'</b> был отправлен код верификации'));
								$session->write('login_change_steps',  3);
								$step = $session->read('login_change_steps');

							} else{
								$this->Flash->error(__('Ошибка отправки кода! Обновите страницу и попробуйте снова'));
				        		// return $this->redirect( ['controller' => 'Users', 'action' => 'security'] );
				        		return $this->redirect( $site_lang . Router::pathUrl('Users::security') );
							}
	    				}
	    			}

	    		} elseif( $data['submit_type'] == 'verify_email' ){
	    			if( $step == 3 ){

	    				if( $userAuth['verify_code'] ){
	    					$user_code = $userAuth['verify_code'];
	    				} else{
	    					$cur_user = $this->Users->get($userAuth['id']);
	    					if( $cur_user ){
	    						$user_code = $cur_user['verify_code'];
	    					}
	    				}

	    				if( !isset($user_code) || !$user_code ){
	    					$this->Flash->error(__('Ошибка! Код верификации не найден'));
	    					return $this->redirect( $this->referer() );
	    				}

	    				if( isset($data['code']) && $data['code'] == $user_code ){
	    					if( $userAuth['new_email'] ){
	    						$new_email = $userAuth['new_email'];
	    					} else{
	    						$cur_user = $this->Users->get($userAuth['id']);
	    						if( $cur_user ){
	    							$new_email = $cur_user['new_email'];
	    						}
	    					}

	    					if( $new_email ){

	    						$update_email = $this->Users->query()->update()->set([
	    							'username' => $new_email,
	    							'confirm_code' => null,
	    							'verify_code' => null,
	    							'new_email' => null,
	    						])->where(['id' => $userAuth['id']]);

	    						if( $update_email->execute() ){
					    			$userAuth['username'] = $new_email;
					    			$userAuth['confirm_code'] = null;
					    			$userAuth['verify_code'] = null;
					    			$userAuth['new_email'] = null;

					    			$session->write('UserAuth',  $userAuth);
					    			$step = null;
					    			$session->write('login_change_steps',  null);

					    			$job_alerts = $this->JobAlerts->query()->update()->set(['user_email' => $new_email])->where(['user_id' => $userAuth['id']]);
					    			if( $job_alerts->execute() ){
					    				$this->Flash->success(__('Почта для получения оповещений о вакансиях изменена на <b>'. $new_email .'</b>'));
					    			} else{
					    				$this->Flash->error(__('Ошибка смены почты для получения оповещений о вакансиях'));
					    			}

					    			$this->Flash->success(__('Вы успешно сменили почту на <b>'. $new_email .'</b>'));
					    			// return $this->redirect( ['controller' => 'Users', 'action' => 'cabinet'] );
					    			return $this->redirect( $site_lang . Router::pathUrl('Users::cabinet') );

	    						} else{
	    							$this->Flash->error(__('Ошибка смены почты. Попробуйте снова'));
				            		// return $this->redirect( ['controller' => 'Users', 'action' => 'security'] );
				            		return $this->redirect( $site_lang . Router::pathUrl('Users::security') );
	    						}

	    					} else{
	    						$this->Flash->error(__('Ошибка! Новый логин не найден'));
				            	// return $this->redirect( ['controller' => 'Users', 'action' => 'security'] );
				            	return $this->redirect( $site_lang . Router::pathUrl('Users::security') );
	    					}

	    				} else{
	    					$this->Flash->error(__('Ошибка! Неправильный код'));
			            	return $this->redirect( $this->referer() );
	    				}
	    			}

	    		} else{
	    			$this->Flash->error(__('Ошибка! Обновите страницу и попробуйте снова'));
	            	// return $this->redirect( ['controller' => 'Users', 'action' => 'security'] );
	            	return $this->redirect( $site_lang . Router::pathUrl('Users::security') );
	    		}
	    	}

	    	$this->set( compact('step') );
	    }

    /*------- not used END -------*/



    /*---------- AJAX Begin (not used) --------------*/

	    /*------------ For Company Users ----------*/

	    public function saveComment(){
	    	$model = 'UsersRequests';
	    	$this->autoRender = false;
	    	$session = $this->request->getSession();
	    	$userAuth = $session->read('UserAuth');
	    	$response = $this->response;
	    	$result = [
	        	'status' => 'failed',
	        	'status_text' => __('Ошибка')
	        ];
	        date_default_timezone_set('Asia/Almaty');

	        if( !$userAuth ){
	        	$result['status_text'] = __('Вы не авторизованы!');
	        	return $response->withStringBody(json_encode($result));
			}

			if( $userAuth['role'] != 'company' ){
				$result['status_text'] = __('У вас нет доступа к этой странице');
	        	return $response->withStringBody(json_encode($result));
			}

			if( $this->request->is('post') ){
				$data = $this->request->getData();
				if( isset($data) && isset($data['r_id']) && $data['r_id'] ){
					$r_id = $data['r_id'];
				} else{
					$r_id = '';
				}
				$r_id = intval($r_id);

				if( $r_id && $r_id > 0 ){
					if( isset($data['message']) ){
						$update = $this->$model->query()->update()->set(['comment' => htmlentities($data['message'])])->where(['id' => $r_id]);

						if( $update->execute() ){
							$result['status'] = 'success';
							$result['status_text'] = __('Комментарий успешно сохранен');
						} else{
							$result['status_text'] = __('Ошибка сохранения');
						}

					} else{
						$result['status_text'] = __('Ошибка сохранения! Текст комментария не найден');
					}

					return $response->withStringBody(json_encode($result));

				} else{
					$result['status_text'] = __('Отклик не найден! Обновите страницу и попробуйте снова');
					return $response->withStringBody(json_encode($result));
				}
			}

			return $response->withStringBody(json_encode($result));
	    }

	    /*------------ For All Users ----------*/

	    public function checkEmail(){
	    	$this->autoRender = false;
	    	$response = $this->response;
	    	$result = [
	        	'status' => 'failed',
	        	'status_text' => __('Ошибка')
	        ];
	        date_default_timezone_set('Asia/Almaty');

	        if( $this->request->is('post') ){
	        	$data = $this->request->getData();
	        	if( isset($data['email']) && $data['email'] ){
	        		$email = htmlentities($data['email']);
	        		$created_user = $this->Users->find()
	        			->where(['Users.username' => $data['email']])
	        			->first();
	        		if($created_user){
	        			$result['status_text'] = __('Почта '. $email .' уже зарегистрирована');

	        		} else{
	        			$result['status'] = 'success';
	        			$result['status_text'] = __('Почта '. $email .' свободна');
	        		}
	        	}
	        }

	        return $response->withStringBody(json_encode($result));
	    }

    /*---------- AJAX END --------------*/

    protected function _articlesDocsDelete($data = null, $fields = array()){
        $folder = 'articles';
        if( $data && $fields ){
            foreach( $fields as $item ){
                if( isset($data[$item]) && $data[$item] ){
                    $fileName = WWW_ROOT.'files'.DS.$folder.DS.$data[$item];
                    if( file_exists($fileName) ){
                        unlink($fileName);
                    }
                    clearstatcache();
                }
            }
        }
    }

    protected function _checkRand( $rand = null ){
		if( $rand ){
			$has_rand = $this->Users->find()->where(['Users.forgetpwd' => $rand])->first();
			if( $has_rand ){
				return $this->_checkRand();
			} else{
				return $rand;
			}
		} else{
			$new_rand = rand(100000, 999999);
			return $this->_checkRand($new_rand);
		}
	}

}

?>
