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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

use Cake\Cache\Cache;

use Cake\ORM\Query;



/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */

    public function initialize(): void{
        parent::initialize();

        $this->loadModel('Articles');
        $this->loadModel('Categories');
//        $this->loadModel('Rubrics');
        $this->loadModel('Documents');

        $this->loadModel('Pages');

        $this->loadModel('Branches');
         $this->loadModel('Employees');
        $this->loadComponent('Paginator');
    }

    public function home(): void{
        $cur_lang = Configure::read('Config.lang');
        $cur_date = date('Y-m-d H:i:s');

         $main_articles = Cache::read('main_articles_'.$cur_lang, 'long');
         if( !$main_articles ){
        $main_articles = $this->Articles->find('all')
                ->select(['id', 'title', 'alias', 'category_id', 'img', 'date', 'views', 'short_desc'])
                ->where([
                    'Articles.date <=' => $cur_date
                ])
                ->order(['Articles.date' => 'DESC'])
                ->limit(6)
                ->toList();
         Cache::write('main_articles_'.$cur_lang, $main_articles, 'long');
         }

        $capital_news_category_id = $cur_lang == 'kz' ? 1 : 2;
        $capital_news = Cache::read('capital_news_' . $cur_lang, 'long');
        if (!$capital_news) {
            $capital_news = $this->Articles->find('all')
                ->contain([
                    'Categories' => function(Query $q) {
                        return $q->enableAutoFields();
                    },
                ])
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where(['Categories.id' => $capital_news_category_id, 'Articles.category_id' => $capital_news_category_id, 'Articles.date <=' => $cur_date])
                ->orderDesc('Articles.date')
                ->limit(4)
                ->toList();
            Cache::write('capital_news_' . $cur_lang, $capital_news, 'long');
        }

        $society_news_category_id = $cur_lang == 'kz' ? 16 : 6;
        $society_news = Cache::read('society_news_' . $cur_lang, 'long');
        if (!$society_news) {
            $society_news = $this->Articles->find('all')
                    ->contain([
                        'Categories' => function(Query $q) {
                            return $q->enableAutoFields();
                        },
                    ])
                    ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                    ->where(['Categories.id' => $society_news_category_id, 'Articles.category_id' => $society_news_category_id, 'Articles.date <=' => $cur_date])
                    ->orderDesc('Articles.date')
                    ->limit(7)
                    ->toList();
            Cache::write('society_news_' . $cur_lang, $society_news, 'long');
        }
        $politica_news_category_id = $cur_lang == 'kz' ? 17 : 12;
        $politica_news = Cache::read('politica_news_' . $cur_lang, 'long');
        if (!$politica_news) {
            $politica_news = $this->Articles->find('all')
                ->contain([
                    'Categories' => function(Query $q) {
                        return $q->enableAutoFields();
                    },
                ])
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where(['Categories.id' => $politica_news_category_id, 'Articles.category_id' => $politica_news_category_id, 'Articles.date <=' => $cur_date])
                ->orderDesc('Articles.date')
                ->limit(3)
                ->toList();
            Cache::write('politica_news_' . $cur_lang, $politica_news, 'long');
        }

        $culture_news_category_id = $cur_lang == 'kz' ? 20 : 9;
        $culture_news = Cache::read('culture_news_' . $cur_lang, 'long');
        if (!$culture_news) {
            $culture_news = $this->Articles->find('all')
                ->contain([
                    'Categories' => function(Query $q) {
                        return $q->enableAutoFields();
                    },
                ])
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where(['Categories.id' => $culture_news_category_id, 'Articles.category_id' => $culture_news_category_id, 'Articles.date <=' => $cur_date])
                ->orderDesc('Articles.date')
                ->limit(3)
                ->toList();
            Cache::write('culture_news_' . $cur_lang, $culture_news, 'long');
        }

        $heroes_news_category_id = $cur_lang == 'kz' ? 4 : 3;
        $heroes_news = Cache::read('heroes_news_' . $cur_lang, 'long');
        if (!$heroes_news) {
            $heroes_news = $this->Articles->find('all')
                ->contain([
                    'Categories' => function(Query $q) {
                        return $q->enableAutoFields();
                    },
                ])
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where(['Categories.id' => $heroes_news_category_id, 'Articles.category_id' => $heroes_news_category_id, 'Articles.date <=' => $cur_date])
                ->orderDesc('Articles.date')
                ->limit(3)
                ->toList();
            Cache::write('heroes_news_' . $cur_lang, $heroes_news, 'long');
        }

        $popular_news = Cache::read('popular_news_' . $cur_lang, 'long');
        if (!$popular_news) {
            $popular_news = $this->Articles->find('all')
                    ->contain([
                        'Categories' => function(Query $q) {
                            return $q->enableAutoFields();
                        },

                    ])
                    ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'reading_time'])
                    ->where(['Articles.category_id' => $capital_news_category_id,'Articles.date <=' => $cur_date])
                    ->orderDesc('views')
                    ->limit(6)
                    ->toList();
            Cache::write('popular_news_' . $cur_lang, $popular_news, 'long');
        }

        $last_news = Cache::read('last_news_' . $cur_lang, 'long');
        if (!$last_news) {
            $last_news = $this->Articles->find('all')
                    ->contain([
                        'Categories' => function(Query $q) {
                            return $q->enableAutoFields();
                        },
                    ])
                    ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                    ->where(['Articles.category_id' => $capital_news_category_id, 'Articles.date <=' => $cur_date])
                    ->orderDesc('Articles.date')
                    ->limit(6)
                    ->toList();
            Cache::write('last_news_' . $cur_lang, $last_news, 'long');
        }


        $page = $this->Pages->get(1);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('meta', 'main_articles', 'capital_news', 'politica_news', 'society_news', 'culture_news', 'heroes_news', 'last_news', 'popular_news') );
    }


    public function rules():void{

        $cur_lang = Configure::read('Config.lang');
        $cur_date = date('Y-m-d H:i:s');

        $page_comps = $this->_getPagesComps(4);
        $popular_news = $this->Articles->find('all')
            ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'reading_time'])
            ->where(['Articles.category_id' => 1,'Articles.date <=' => $cur_date])
            ->orderDesc('views')
            ->toList();
        $branches = $this->Branches->find('all')
            ->select(['id',  'title',])
            ->where([$this->Branches->translationField('title').' is not' => null])
            ->toList();
        $employees = $this->Employees->find('all')
            ->where([$this->Employees->translationField('name').' is not' => null])
            ->toList();
        $last_news = $this->Articles->find('all')
            ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
            ->where(['Articles.category_id' => 1, 'Articles.date <=' => $cur_date])
            ->orderDesc('date')
            ->toList();
        $page = $this->Pages->get(4);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('meta', 'page_comps', 'page','popular_news','last_news','branches','employees') );
    }
    public function about(){
        $cur_lang = Configure::read('Config.lang');
        $cur_date = date('Y-m-d H:i:s');

        $page_comps = $this->_getPagesComps(2);
        $popular_news = $this->Articles->find('all')
            ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'reading_time'])
            ->where(['Articles.category_id' => 1,'Articles.date <=' => $cur_date])
            ->orderDesc('views')
            ->toList();
        $branches = $this->Branches->find('all')
            ->select(['id',  'title',])
            ->where([$this->Branches->translationField('title').' is not' => null])
            ->toList();
        $employees = $this->Employees->find('all')
            ->where([$this->Employees->translationField('name').' is not' => null])
            ->toList();
        $last_news = $this->Articles->find('all')
            ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
            ->where(['Articles.category_id' => 1, 'Articles.date <=' => $cur_date])
            ->orderDesc('date')
            ->toList();
        $page = $this->Pages->get(2);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('meta', 'page_comps', 'page','popular_news','last_news','branches','employees') );
    }

    public function cooperation(){

        $cur_lang = Configure::read('Config.lang');

        $docs = $this->Documents->find('all')
            ->where(['Documents.lang' => $cur_lang])
            ->orderDesc('item_order')
            ->toList();

        $page_comps = $this->_getPagesComps(3);

        $page = $this->Pages->get(3);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('meta', 'page_comps', 'page', 'docs') );
    }
     public function contact(){

        $cur_lang = Configure::read('Config.lang');

        $docs = $this->Documents->find('all')
            ->where(['Documents.lang' => $cur_lang])
            ->orderDesc('item_order')
            ->toList();

        $page_comps = $this->_getPagesComps(5);

        $page = $this->Pages->get(5);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('meta', 'page_comps', 'page', 'docs') );
    }

    protected function _getPagesComps($page_id){
        $cur_lang = Configure::read('Config.lang');

        if( $page_id && $page_id > 0 ){
            $page_comps = [];
            $all_page_comps = Cache::read('page_comps_'.$cur_lang, 'long');

            if( isset($all_page_comps[$page_id]) && $all_page_comps[$page_id] ){
                $page_comps = $all_page_comps[$page_id];
            } else{
                $all_comps = $this->Comps->find('all')
                    ->where(['Comps.page_id' => $page_id])
                    ->toList();

                foreach( $all_comps as $item ){
                    $page_comps[$item['id']] = $item;
                }

                $all_page_comps[$page_id] = $page_comps;
                Cache::write('page_comps_'.$cur_lang, $all_page_comps, 'long');
            }

            return $page_comps;
        }
    }

}
