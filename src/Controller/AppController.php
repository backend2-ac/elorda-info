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
require __DIR__ . '/../../vendor/autoload.php';
use Cake\Controller\Controller;
use Cake\Core\Configure;

use Cake\I18n\FrozenTime;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\ORM\Query;

use Facebook\Facebook;


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
        $user_session = $session->read('Auth.User');
        if ($admin && isset($_COOKIE['remember_me']) && $_COOKIE['remember_me']) {
            $user_id = $_COOKIE['remember_me'];
            if (!$user_session) {
                $user = $this->Admins->findById($user_id)->select(['id', 'author_id', 'username', 'role', 'created', 'modified'])->first();
                if ($user) {
                    $session->write('Auth.User', $user);
                }
            }
        }
        $userName = $session->read('Auth.User.username');
        $login = !empty($userName);

        $userAuth = $session->read('Auth.User');

        $user_role = $session->read('Auth.User.role');
        $has_access_controllers = ['Articles', 'Tags', 'Authors', 'Admin'];
        $has_access_action = 'edit';
        $cur_controller = $this->request->getParam('controller');
        if ($user_role == 'author') {
            if (isset($params['prefix']) && $params['prefix'] == 'Admin' && !in_array($cur_controller, $has_access_controllers)) {
                $this->Flash->error(__('У вас нет доступа к этой странице!'));
                $this->redirect(['controller' => 'Admin', 'action' => 'index']);
            }
            if (isset($params['prefix']) && $params['prefix'] == 'Admin' && $cur_controller == 'Authors' && $params['action'] != $has_access_action) {
                $this->Flash->error(__('У вас нет доступа к этой странице!'));
                $this->redirect(['controller' => 'Admin', 'action' => 'index']);
            }
        }

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
        date_default_timezone_set('Asia/Atyrau');

        $this->set( compact('admin', 'login', 'l', 'lang', 'request', 'userAuth') );

        $cur_date = date('Y-m-d H:i:s');

        /*--------- Comps --------*/

            $langs_ids = [4, 9, 10, 11,19];
            $spec_ids = [2, 3,4];

            $comps_lang = Cache::read('comps_lang_'. $l, 'long');
            if(!$comps_lang) {
                $this->Comps->setLocale($l);
                $all_comps_lang = Cache::read('all_comps_lang_' . $l, 'eternal');
                if (!$all_comps_lang) {
                    $all_comps_lang = $this->Comps->find('all')
                        ->where([
                            'Comps.id IN' => $langs_ids,
                            'Comps.id NOT IN' => $spec_ids,
                            'Comps.page_id' => 0,
                        ])
                        ->toList();
                    Cache::write('all_comps_lang_' . $l, $all_comps_lang, 'eternal');
                }
                $comps_lang = [];
                foreach( $all_comps_lang as $comp_item ){
                    $comps_lang[$comp_item['id']] = $comp_item;
                }
                Cache::write('comps_lang_' . $l, $comps_lang, 'long');
            }

            $total_ids = array_merge($langs_ids, $spec_ids);

            $comps = Cache::read('comps_' . $l, 'long');
            if(!$comps){
                $this->Comps->setLocale($l);
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

                Cache::write('comps_' . $l, $comps, 'long');
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
                'parlament-ru' => 'parlament-ru',
                'senat-ru' => 'senat-ru',
                'zasedaniye' => 'zasedaniye',
                'akorda-ru' => 'akorda-ru',
                'prezident-ru' => 'prezident-ru',
                'pravitelstvo' => 'pravitelstvo',
                'obchestvo' => 'obchestvo',
                'interview-ru' => 'interview-ru',
                'lichnost' => 'lichnost',
                'obrazovaniye' => 'obrazovaniye',
                'naznachenie-ru' => 'naznachenie-ru',
                'sluzhu-strane' => 'sluzhu-strane',
                'show-biznes-ru' => 'show-biznes-ru',

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
                'okiga' => 'okiga',
                'alem' => 'alem',
                'joldau' => 'joldau',
                'sailau-2023' => 'sailau-2023',
                'astana-25' => 'astana-25',
                'sluzhba-komplaens-kz' => 'sluzhba-komplaens-kz',
                'adep-kodeksi' => 'adep-kodeksi',
                'bilim' => 'bilim',
                'elorda-yzdikteri'=> 'elorda-yzdikteri',
                'parlament' => 'parlament',
                'senat' => 'senat',
                'mazhilis' => 'mazhilis',
                'akorda' => 'akorda',
                'prezident' => 'prezident',
                'ukimet' => 'ukimet',
                'kogam' => 'kogam',
                'sukhbat' => 'sukhbat',
                'tulga' => 'tulga',
                'elge-kyzmet' => 'elge-kyzmet'

            ];

            $full_categories = $this->_getFullCategories();

            $url = "http://www.nationalbank.kz/rss/rates_all.xml";
            $rates_data = [];
            $start_date_getting_rates = Cache::read('start_date_getting_rates', 'eternal');
            $current_date = FrozenTime::now();
            if (!$start_date_getting_rates) {
                Cache::write('start_date_getting_rates', $current_date, 'eternal');
            } else {
                $date_for_check = $start_date_getting_rates->addMinutes(240);

                if ($current_date > $date_for_check) {
                    $rates_data = simplexml_load_file($url);
                    $rates_data = json_decode(json_encode($rates_data, 1));
                    Cache::write('currency_rates', $rates_data, 'eternal');
                    Cache::write('start_date_getting_rates', $current_date, 'eternal');
                } else {
                    $rates_data = Cache::read('currency_rates', 'eternal');
                    if (!$rates_data) {
                        $rates_data = simplexml_load_file($url);
                        $rates_data = json_decode(json_encode($rates_data, 1));
                        Cache::write('currency_rates', $rates_data, 'eternal');
                    }
                }
            }
            $this->set(compact('rates_data'));

            /*------ cache cleaning ------*/
//            $interval_minute = 10;
//            $check_start_date = Cache::read('check_start_date', 'eternal');
//            $current_date = FrozenTime::now();
//            if (!$check_start_date) {
//                Cache::write('check_start_date', $current_date, 'eternal');
//            } else {
//                $new_start_date = $check_start_date->addMinutes($interval_minute);
//
//                if ($current_date >= $new_start_date) {
//                    $new_articles = $this->Articles->find()
//                        ->select(['Articles.title', 'Articles.alias', 'Articles.category_id'])
//                        ->where([
//                            'Articles.publish_start_at >=' => $check_start_date,
//                            'Articles.publish_start_at <=' => $new_start_date
//                        ])
//                        ->toList();
//                    if ($new_articles) {
//                        Cache::clearGroup('long');
//                    }
//                    Cache::write('check_start_date', $new_start_date, 'eternal');
//                }
////                $this->sendPostsToFacebook();
//            }
            /*------ Cache cleaning END ------*/

            $this->set( compact(  'categories_slug_parts', 'full_categories') );
        }
//        $this->sendPostsToFacebook();

    }

    protected function _clearArticlesCache($category_id, $locale, $article_alias = null) {
        $locale = $locale == 'kk' ? 'kz' : 'ru';
        $category_alias = $this->_getCategoryAlias($category_id);
        Cache::delete($category_alias . '_' . $locale, 'long');
        Cache::delete($category_alias . '_popular_news', 'long');
        Cache::delete($category_alias . '_last_news', 'long');
        Cache::delete( 'main_articles_' . $locale, 'long');
        Cache::delete('last_news_' . $locale, 'long');
        Cache::delete('popular_news_' . $locale, 'long');
        Cache::delete($category_alias . '_news_page_1', 'long');
        Cache::delete('capital_news_' . $locale, 'long');
        Cache::delete('society_news_' . $locale, 'long');
        Cache::delete('politica_news_' . $locale, 'long');
        Cache::delete('culture_news_' . $locale, 'long');
        Cache::delete('heroes_news_' . $locale, 'long');
        if ($article_alias) {
            Cache::delete($article_alias, 'long');
        }
    }
    protected function prepareDataForSendingToFacebook($new_articles) {
        $fb_data = [];
        foreach ($new_articles as $new_article) {
            $news_link = $_SERVER['HTTP_HOST'] . '/' . $new_article['category']['alias']. '/' . $new_article['alias'];
            $fb_data[] = ['title' => $new_article['title'], 'link' => $news_link];
        }
        return $fb_data;
    }

    protected function sendPostsToFacebook() {
        $app_id = '227135263803105';
        $app_user = '122094842840217749';
        $app_secret = '4bc99def88cd6ede6abcfebc602176a7';
        $page_id = '217495024786444'; //https://www.facebook.com/profile.php?id=61556114499643&sk=about_profile_transparency
        $access_token = 'EAADOlAy3BuEBO9QDvqoSN1nZA8KmfnU4t3EgZCV7ziNVHslrVUwudndjMGtDg5DZCqcPAnnO3fg3RaZCl3Gn3jsYoZA6ZBZAMfRZB8CGoI23U4tAIdRdKAIZCQDeXV7sYUQRZAQIsKIUuCuZCkA4fNZAWjDGs50IorktkMYUcZAh57KlhCdpryVXoOJHM3PqjcmqBaZBLL0NSlpUYd636nNE0FWAcyZCZA2xVTTnR38ZD';
//        $appsecret_proof = hash_hmac('sha256', $access_token, $app_key);
        $fb = new Facebook([
            'app_id' => $app_id, //Замените на ваш id приложения
            'app_secret' => $app_secret, //Ваш секрет приложения
            'default_access_token' => $access_token,
            'default_graph_version' => 'v19.0',
//            'appsecret_proof' => $appsecret_proof,
        ]);
        $fb_data = [
             [
                'title' => 'Астанадан бір түнде 44 мың текше метр қар шығарылды',
                'link' => 'http://elorda/elorda-janalyktary/astanadan-bir-tnde-44-my-tekse-metr-kar-sygaryldy',
            ],
            [
                'title' => 'Елордада жастарға арналған тегін коворкинг орталығы ашылды',
                'link' => 'http://elorda/elorda-janalyktary/elordada-zastarga-arnalgan-tegin-kovorking-ortalygy-asyldy',
            ],
        ];
        foreach ($fb_data as $post) {
            $link = $post['link'];
            $message = $post['title'];
            try {
                $response = $fb->post('/' . $page_id . '/feed', ['message' => $message, 'link' => $link]);
                $graphNode = $response->getGraphNode();
                echo 'Пост успешно опубликован на Facebook! ID поста: ' . $graphNode['id'] . "\n";
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Ошибка при публикации поста на Facebook: ' . $e->getMessage() . "\n";
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Ошибка при использовании SDK Facebook: ' . $e->getMessage() . "\n";
            }
        }
    }

    private function facebookAcces() {
        $fb = new Facebook([
            'app_id' => 'ваш_app_id',
            'app_secret' => 'ваш_app_secret',
            'default_graph_version' => 'v12.0',
        ]);

        $response = $fb->get('/oauth/access_token', [
            'grant_type' => 'fb_exchange_token',
            'client_id' => 'ваш_app_id',
            'client_secret' => 'ваш_app_secret',
            'fb_exchange_token' => 'ваш_временный_токен_доступа',
        ]);

        $longLivedAccessToken = $response->getDecodedBody()['access_token'];
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

    protected function _getAdminCategoriesWithLocale($locale) {
        $categories = Cache::read('admin_categories_' . $locale, 'eternal');
        if( !$categories ) {
            $categories = $this->Categories->find('list', [
                'keyField' => 'id',
                'valueField' => 'title',
            ])
                ->where(['Categories.locale' => $locale])
                ->order(['title'])
                ->toArray();
            Cache::write('admin_categories_' . $locale, $categories, 'eternal');
        }

        return $categories;
    }

        protected function _getAdminTags($locale){
            $tags = Cache::read('admin_tags_' . $locale, 'eternal');
            if( !$tags ){
                $tags = $this->Tags->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'title',
                    ])
                    ->where(['Tags.locale' => $locale])
                    ->orderDesc('item_order')
                    ->toArray();

                 Cache::write('admin_tags_' . $locale, $tags, 'eternal');
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
                    ->where(['anonymous' => 0])
                    ->orderDesc('item_order')
                    ->toArray();

                Cache::write('admin_authors', $authors, 'eternal');
            }
            return $authors;
        }

    /*---------- Admin Funcs END --------*/


    /*---------- Other Funcs --------*/

        protected function _getFullCategories(){
            $full_categories = Cache::read('full_categories', 'eternal');
            if( !$full_categories ){
                $categories = $this->Categories->find('all')
                    ->where(['title IS NOT NULL'])
                    ->orderDesc('item_order')
                    ->toList();

                if( $categories ){
                    foreach( $categories as $item ){
                        $full_categories[$item['id']] = $item;
                    }
                    Cache::write('full_categories', $full_categories, 'eternal');
                }
            }
            return $full_categories;
        }

        protected function _getCategoryAlias($category_id) {
            $category_alias = Cache::read('category_' . $category_id, 'eternal');
            if (!$category_alias) {
                $category_alias = $this->Categories->find()
                    ->select(['alias'])
                    ->where(['id' => $category_id])
                    ->first()
                    ->get('alias');
                Cache::write('category_' . $category_id, $category_alias, 'eternal');
            }
            return $category_alias;
        }

        protected function _getCountAllArticles($locale) {
            $count_all_articles = Cache::read('count_all_articles_' . $locale, 'eternal');
            if (!$count_all_articles) {
                $count_all_articles = $this->Articles->find()
                    ->select(['id'])
                    ->where(['Articles.locale' => $locale])
                    ->count();
                Cache::write('count_all_articles_' . $locale, $count_all_articles, 'eternal');
            }
            return $count_all_articles;
        }

    protected function _getCountLatestNews($locale) {
        $count_all_articles = Cache::read('count_latest_news_' . $locale, 'eternal');
        $cur_date = date('Y-m-d H:i:s');
        if (!$count_all_articles) {
            $count_all_articles = $this->Articles->find()
                ->select(['id'])
                ->where([
                    'Articles.publish_start_at <=' => $cur_date,
                    'Articles.locale' => $locale
                ])
                ->count();
            Cache::write('count_latest_news_' . $locale, $count_all_articles, 'eternal');
        }
        return $count_all_articles;
    }

    /*---------- Other Funcs END --------*/

}
