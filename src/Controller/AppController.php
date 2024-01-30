<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;

use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\ORM\Query;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('String');

        $this->loadComponent("Auth", [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel' => 'Admins'
                ]
            ],
            'loginAction' => [
                'controller' => 'Admin',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Admin',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Admin',
                'action' => 'index'
            ],
        ]);


        $this->loadModel('Articles');
        $this->loadModel('Categories');
        $this->loadModel('Tags');
        $this->loadModel('Authors');

        $this->loadModel('Pages');
        $this->loadModel('Comps');

        $this->loadComponent('Authorization.Authorization');
        // $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);

        $params = $this->request->getAttribute('params');
        $admin = (isset($params['prefix']) && $params['prefix'] == 'Admin') ? 'admin/' : false;

        if( isset($params['controller']) && $params['controller'] == 'User' ){

        } else{
            $this->Authorization->skipAuthorization();
        }

        if(!$admin){
            $this->Auth->allow();
        }

        $session = $this->request->getSession();
        $userName = $session->read('Auth.User.username');
        $login = !empty($userName);

        $userAuth = $session->read('UserAuth');

        if( $login ){
            $_SESSION['KCFINDER'] = array(
                'disabled' => false,
            );
        } else{
            $_SESSION['KCFINDER'] = array(
                'disabled' => true,
            );
        }

        if( $admin){
            $this->viewBuilder()->setLayout('default');
        } else{
            $this->viewBuilder()->setLayout('index');
        }

        if(isset($params['lang']) && $params['lang'] == 'ru'){
            Configure::write('Config.lang', 'ru');
            $session->write('lang',  'ru');
        }elseif(isset($params['lang']) && $params['lang'] == 'en'){
            Configure::write('Config.lang', 'en');
            $session->write('lang',  'en');
        }else{
            Configure::write('Config.lang', 'kz');
        }

        $l = Configure::read('Config.lang');
        $lang = ( isset($params['lang']) && $params['lang'] ) ? $params['lang'] . '/' : '';

        I18n::setLocale($l);

        $request = $params;
        date_default_timezone_set('Asia/Almaty');

        $this->set( compact('admin', 'login', 'l', 'lang', 'request', 'userAuth') );

        $cur_date = date('Y-m-d H:i:s');

        /*--------- Comps --------*/

            $langs_ids = [4, 9, 10, 11,19];
            $spec_ids = [2, 3,4];

            $comps_lang = Cache::read('comps_'.$l, 'long');
            if( !$comps_lang ){
                $this->Comps->setLocale($l);
                $all_comps_lang = $this->Comps->find('all')
                    ->where([
                        'Comps.id IN' => $langs_ids,
                        'Comps.id NOT IN' => $spec_ids,
                        'Comps.page_id' => 0,
                    ])
                    ->toList();

                $comps_lang = [];
                foreach( $all_comps_lang as $comp_item ){
                    $comps_lang[$comp_item['id']] = $comp_item;
                }
                Cache::write('comps_'.$l, $comps_lang, 'long');
            }

            $total_ids = array_merge($langs_ids, $spec_ids);

            $comps = Cache::read('comps', 'long');
            if( !$comps ){
                $this->Comps->setLocale('ru');
                $all_comps = $this->Comps->find('all')
                    ->where([
                        'Comps.id NOT IN' => $total_ids,
                        'Comps.page_id' => 0,
                    ])
                    ->toList();

                $comps = [];
                foreach( $all_comps as $comp_item ){
                    $comps[$comp_item['id']] = $comp_item;
                }
                Cache::write('comps', $comps, 'long');
            }

            $this->set( compact('comps', 'comps_lang') );

        /*--------- Comps END --------*/

        if( !$admin ){

            $categories_slug_parts = [
                'novosti-stolicy-ru' => 'novosti-stolicy-ru',
                'politika-ru' => 'politika-ru',
                'sotsium-ru' => 'sotsium-ru',
                'ekonomika-ru' => 'ekonomika-ru',
                'sport-ru' => 'sport-ru',
                'kultura-ru' => 'kultura-ru',
                'raznoe-ru' => 'raznoe-ru',
                'mnenie-ru' => 'mnenie-ru',
                'naznacheniya-ru' => 'naznacheniya-ru',
                'geroi-stolicy-ru' => 'geroi-stolicy-ru',
                'video-ru' => 'video-ru',
                '30let-nezavisimosti-RK-ru' => '30let-nezavisimosti-RK-ru',

                'tseny-v-astane-ru' => 'tseny-v-astane-ru',
                'poslanie-ru' => 'poslanie-ru',
                'vybory-2023-ru' => 'vybory-2023-ru',
                'proisshestvie-ru' => 'proisshestvie-ru',
                'tema-dnya-ru' => 'tema-dnya-ru',
                'astana-25-1' => 'astana-25-1',
                'sluzhba-komplaens-ru' => 'sluzhba-komplaens-ru',
                'kodeks-etiki' => 'kodeks-etiki',

                'elorda-janalyktary' => 'elorda-janalyktary',
                'sayasat' => 'sayasat',
                'aleumet' => 'aleumet',
                'ekonomika' => 'ekonomika',
                'sport' => 'sport',
                'madeniet' => 'madeniet',
                'ar-turli' => 'ar-turli',
                'kozkaras' => 'kozkaras',
                'tagaiyndau' => 'tagaiyndau',
                'elorda-erzhyrektery' => 'elorda-erzhyrektery',
                'video' => 'video',
                'tauelsizik-30-jyl' => 'tauelsizik-30-jyl',
                'densaulyk' => 'densaulyk',
                'Elordadagy-bagalar' => 'Elordadagy-bagalar',
                'showbiz' => 'showbiz',
                'bilim' => 'bilim',
                'okiga' => 'okiga',
                'alem' => 'alem',
                'joldau' => 'joldau',
                'sailau-2023' => 'sailau-2023',
                'astana-25' => 'astana-25',
                'sluzhba-komplaens-kz' => 'sluzhba-komplaens-kz',
                'adep-kodeksi' => 'adep-kodeksi',


            ];

            $full_categories = $this->_getFullCategories();

            /*------ Ads blocks BEGIN ------*/

//                $header_block = Cache::read('header_block', 'eternal');
//                if( !$header_block ){
//                    $header_block = $this->Blocks->find()
//                        ->where(['Blocks.position' => 'header'])
//                        ->orderDesc('item_order')
//                        ->first();
//                    Cache::write('header_block', $header_block, 'eternal');
//                }
//
//                $main_block = Cache::read('main_block', 'eternal');
//                if( !$main_block ){
//                    $main_block = $this->Blocks->find()
//                        ->where(['Blocks.position' => 'main'])
//                        ->orderDesc('item_order')
//                        ->first();
//                    Cache::write('main_block', $main_block, 'eternal');
//                }
//
//
//                $sidebar_blocks = Cache::read('sidebar_blocks', 'eternal');
//                if( !$sidebar_blocks ){
//                    $sidebar_blocks = $this->Blocks->find('all')
//                        ->where(['Blocks.position' => 'sidebar'])
//                        ->orderDesc('item_order')
//                        ->limit(3)
//                        ->toList();
//                    Cache::write('sidebar_blocks', $sidebar_blocks, 'eternal');
//                }
//
//                $this->set( compact('header_block', 'main_block', 'sidebar_blocks') );

            /*------ Ads blocks END ------*/

            $this->set( compact(  'categories_slug_parts', 'full_categories') );
        }


    }

    /*---------- Admin Funcs  --------*/

        protected function _getAdminCategories(){
            $categories = Cache::read('admin_categories', 'eternal');
            if( !$categories ){
                $categories = $this->Categories->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'title',
                    ])
                    ->order(['locale', 'title'])
                    ->toArray();
                Cache::write('admin_categories', $categories, 'eternal');
            }

            return $categories;
        }

        protected function _getAdminTags(){
            $tags = Cache::read('admin_tags', 'eternal');
            if( !$tags ){
                $tags = $this->Tags->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'title',
                    ])
                    ->orderDesc('item_order')
                    ->limit(10)
                    ->toArray();
                 Cache::write('admin_tags', $tags, 'eternal');
            }
            return $tags;
        }

        protected function _getAdminAuthors(){
            $authors = Cache::read('admin_authors', 'eternal');
            if( !$authors ){
//                $this->Authors->setLocale('ru');
                $authors = $this->Authors->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'name',
                    ])
                    ->orderDesc('item_order')
                    ->toArray();

                Cache::write('admin_authors', $authors, 'eternal');
            }
            return $authors;
        }

    /*---------- Admin Funcs END --------*/


    /*---------- Other Funcs --------*/

        protected function _getFullCategories(){
            $cur_lang = Configure::read('Config.lang');
            $locale = $cur_lang == 'kz' ? 'kk' : 'ru';
            $full_categories = Cache::read('full_categories_'.$cur_lang, 'eternal');
            if( !$full_categories ){
                $categories = $this->Categories->find('all')
                    ->where(['locale' => $locale, 'title IS NOT NULL'])
                    ->orderDesc('item_order')
                    ->toList();

                if( $categories ){
                    foreach( $categories as $item ){
                        $full_categories[$item['id']] = $item;
                    }
                    Cache::write('full_categories_'.$cur_lang, $full_categories, 'eternal');
                }
            }
            return $full_categories;
        }

    /*---------- Other Funcs END --------*/

}
