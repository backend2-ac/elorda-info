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

use Cake\I18n\FrozenTime;



/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class ArticlesController extends AppController
{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Articles');

        $this->loadModel('Categories');
        $this->loadModel('Tags');
        $this->loadModel('Authors');

        $this->loadModel('Pages');
        $this->loadComponent('Paginator');
    }

    public function index($alias = null){

        $cat_id = null;
        $cur_date = date('Y-m-d H:i:s');

        if( $alias ){
            $cur_cat = $this->Categories->findByAlias($alias)
                ->first();

            if( $cur_cat ){
                $cat_id = $cur_cat['id'];
            } else {
                throw new NotFoundException(__('Запись не найдена'));
            }
        }
        $conditions = [
            'Articles.date <=' => $cur_date
        ];
        $conditions = [
            'OR' => [
                ['Articles.publish_start_at IS NULL', 'Articles.date <' => $cur_date],
                ['Articles.publish_start_at IS NOT NULL', 'Articles.publish_start_at <' => $cur_date],
            ]
        ];
        if( $cat_id ){
            $conditions = ['AND' => ['Articles.category_id' => $cat_id]];
        }

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 6; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = Cache::read($alias . '_news', 'long');
        if (!$data) {
            $data = $this->Articles->find('all')
                ->where($conditions)
                ->select(['id', 'category_id', 'title', 'alias', 'short_desc', 'date', 'img', 'views', 'reading_time'])
                ->order(['Articles.date' => 'DESC'])
                ->limit($per_page)->offset($offset)
                ->toList();
            Cache::write($alias . '_news', $data, 'long');
        }

        $popular_news = Cache::read($alias . '_popular_news', 'long');
        if (!$popular_news) {
            $popular_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'reading_time'])
                ->where($conditions)
                ->orderDesc('views')
                ->limit(6)
                ->toList();
            Cache::write($alias . '_popular_news', $popular_news, 'long');
        }

        $last_news = Cache::read($alias . '_last_news', 'long');
        if (!$last_news) {
            $last_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where($conditions)
                ->orderDesc('Articles.date')
                ->limit(6)
                ->toList();
            Cache::write($alias . '_last_news', $last_news, 'long');
        }

        $this->set('pagination', $this->paginate(
            $this->Articles->find('all')
                ->where($conditions)
                ->select(['id', 'category_id', 'title', 'date', 'created_at'])
                ->order(['Articles.date' => 'DESC'])
                ->limit($per_page),
            $pag_settings
        ));

//        debug($cur_cat);
//        die();
        $meta = [];
        if( $cur_cat ){
            $meta['title'] = $cur_cat['meta_title'];
            $meta['keys'] = $cur_cat['meta_keywords'];
            $meta['desc'] = $cur_cat['meta_description'];
            if( !$meta['title'] ){
                $meta['title'] = $cur_cat['title'];

            }
        }

        $this->set( compact('data', 'meta', 'cur_cat', 'last_news', 'popular_news') );
    }

    public function view($alias){
        $cur_date = date('Y-m-d H:i:s');
        $data = $this->Articles->findByAlias($alias)
            ->contain([
                'Categories',
                'Tags',
                'Authors'
            ])
            ->first();

        $article_id = $data['id'];
        if (empty($data) || empty($data['id']) || !$this->Articles->exists(['id' => $data['id']])) {
            throw new NotFoundException(__('Запись не найдена'));
        }

        $this->Articles->query()->update()->set(['views' => ($data['views'] + 1)])->where(['id' => $article_id])->execute();

         $other_news = $this->Articles->find()
                ->where([
                    'Articles.id !=' => $article_id,
                    'Articles.category_id =' =>$data['category_id'],
                ])
                ->orderDesc('Articles.date')
                ->limit(4)
                ->toList();

        $conditions = [
            'Articles.date <=' => $cur_date,
            'Articles.category_id' => $data['category_id']
        ];
        $category_alias = $data['category']['alias'];
        $popular_news = Cache::read($category_alias . '_popular_news', 'long');
        if (!$popular_news) {
            $popular_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'reading_time'])
                ->where($conditions)
                ->orderDesc('views')
                ->limit(6)
                ->toList();
            Cache::write($category_alias . '_popular_news', $popular_news, 'long');
        }

        $last_news = Cache::read($category_alias . '_last_news', 'long');
        if (!$last_news) {
            $last_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'alias', 'views', 'date', 'short_desc'])
                ->where($conditions)
                ->orderDesc('Articles.date')
                ->limit(6)
                ->toList();
            Cache::write($category_alias . '_last_news', $last_news, 'long');
        }

        $author_articles = [];
        if( $data['author_id'] ){
            $author_articles = $this->Articles->find('all')
                ->where(['Articles.id !=' => $article_id, 'Articles.author_id' => $data['author_id']])
                ->orderDesc('Articles.date')
                ->limit(6)
                ->toList();
        }

//        debug($data);
//         die();
        $meta['title'] = $data['meta_title'];
        if( !$meta['title'] ){
            $meta['title'] = $data['title'];
        }
        $meta['desc'] = $data['meta_description'];
        $meta['keys'] = $data['meta_keywords'];

        $this->set( compact('data', 'meta', 'other_news', 'author_articles','popular_news','last_news') );
    }

    public function loadingview($article_id){
        $model = 'Articles';
        $cat_id = null;
         $cur_date = date('Y-m-d H:i:s');
        $data = $this->$model->findById($article_id)
            ->contain([
                'Categories',
                'Tags',
                'Authors'
            ])
            ->where([$model.'.category_id' => $_GET['category']])
            ->first();


        if( is_null($article_id) || !(int)$article_id || !$this->$model->get($article_id) ){
            throw new NotFoundException(__('Запись не найдена'));
        }

        $this->$model->query()->update()->set(['views' => ($data['views'] + 1)])->where(['id' => $article_id])->execute();


    $this->set(compact('data'));
    $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function writer($author_alias) {
         $author_artilces = [];
         $author  = $this->Authors->findByAlias($author_alias)
            ->first();
        if (!$author) {
            throw new NotFoundException(__('Запись не найдена'));
        }
        $author_id = $author['id'];
        $author_artilces = Cache::read($author_alias . '_news', 'long');
        if (!$author_artilces) {
            $author_artilces = $this->Articles->find('all')
                ->where([ 'Articles.author_id' => $author_id])
                ->contain([
                    'Tags',
                ])
                ->orderDesc('Articles.date')
                ->toList();
            Cache::write($author_alias . '_news', $author_artilces, 'long');
        }
//        if( is_null($author_artilces) || !$author_artilces ){
//            throw new NotFoundException(__('Запись не найдена'));
//        }
           $this->set(compact('author_artilces','author'));
    }

    public function tag($tag_alias) {
        $cur_date = date('Y-m-d H:i:s');
        $this->loadModel('ArticlesTags');
        $tag  = $this->Tags->findByAlias($tag_alias)
            ->first();
        if (!$tag) {
            throw new NotFoundException(__('Запись не найдена'));
        }

        $tag_articles = Cache::read('tag_articles_' . $tag_alias, 'long');

        if (!$tag_articles) {
            $tag_articles = $this->Articles->find()
                ->innerJoinWith('ArticlesTags')
                ->where([
                    'ArticlesTags.tag_id' => $tag->id,
                    'Articles.locale' => $tag->locale,
                    'Articles.published_at <=' => $cur_date
                ])
                ->orderDesc('Articles.date')
                ->limit(25)
                ->toList();

            Cache::write('tag_articles_' . $tag_alias, $tag_articles, 'long');
        }

        $this->set(compact('tag_articles','tag'));
    }

    public function search() {
        $cur_lang = Configure::read('Config.lang');
        $locale = $cur_lang == 'kz' ? 'kk' : 'ru';
        $tags_ids = [32, 239, 77,  122, 436];
        if ($cur_lang == 'ru') {
            $tags_ids = [2673, 2874, 2916, 3706, 5952];
        }
        $tags = $this->Tags->find()
            ->where(['Tags.id IN' => $tags_ids])
            ->orderDesc('Tags.item_order')
            ->toList();

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 9; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];
        $data = [];
        $search_text = '';
        $conditions = [];
        $selected_tag_ids = [];
        if (isset($_GET['q']) && $_GET['q']) {
            $search_text = htmlentities($_GET['q']);
            if( isset($_GET['tags']) && $_GET['tags'] ){
                foreach( $_GET['tags'] as $tag ){
                       $selected_tag_ids[] = $tag;
                    }
                $conditions['AND'][] = ['Tags.id IN' => $selected_tag_ids];
            }
            if ($search_text) {
                $conditions['AND'][] = ['Articles.title LIKE' => '%'. $search_text .'%'];
                $data = $this->Articles->find('all')
                ->leftJoinWith('Tags')
                ->group(['Articles.id'])
                ->where($conditions)
                ->andWhere(['Articles.locale' => $locale])
                ->select(['id', 'category_id', 'title', 'alias', 'short_desc', 'date', 'img', 'views'])
                ->orderDesc('Articles.date')
                ->limit($per_page)->offset($offset)
                ->toList();

                $this->set('pagination', $this->paginate(
                    $this->Articles->find('all')
                        ->leftJoinWith('Tags')
                        ->where($conditions)
                        ->andWhere(['Articles.locale' => $locale])
                        ->group(['Articles.id'])
                        ->select(['id', 'category_id', 'title', 'date'])
                        ->order('Articles.date')
                        ->limit($per_page),
                    $pag_settings
                ));
            }
        }
//        debug($data);
//        die();
        $this->set( compact('data', 'search_text', 'tags','tags_ids', 'selected_tag_ids') );
    }
//    public function search(){
//
//        $cur_date = date('Y-m-d H:i:s');
//        $tag = 'Tags';
//
//        $tag_ids = $this->$tag->find('list', [
//                'valueField' => 'id'
//            ])
//            ->select(['id', 'item_order'])
//            ->orderDesc($tag.'.item_order')
//            ->toList();
//
//        $tags = $this->$tag->find()
//            ->where([$tag.'.id IN' => $tag_ids])
//            ->orderDesc('item_order')
//            ->toList();
//        $str = '';
//        $chkd_sort = 'date_desc';
//        $chkd_types = [];
//        $chkd_date = '';
//
//        $is_search = true; // get results
//
//        $search_mode = 'full'; // full, tag
//
//        $sorting = ['Articles.date' => 'DESC'];
//        $allow_search_types = ['author', 'tag', 'text'];
//        $allow_sorting = ['date_desc', 'date_asc', 'title_asc', 'title_desc'];
//
//        $conditions = [
//            'Articles.date <=' => $cur_date
//        ];
//
//        if( isset($_GET['tag_id']) && $_GET['tag_id'] ){
//            $search_mode = 'tag';
//            $tag_id = intval($_GET['tag_id']);
//
//            $cur_tag = $this->Tags->findById($tag_id)->first();
//            $this->set( compact('cur_tag') );
//
//            if( $tag_id && $cur_tag ){
//                $conditions[] = ['Tags.id' => $tag_id];
//            }
//
//        } else{
//            if( isset($_GET['q_str']) && $_GET['q_str'] ){
//                $str = htmlentities($_GET['q_str']);
//                if( $str ){
//                    if( isset($_GET['search_type']) && $_GET['search_type'] ){
//                        foreach( $_GET['search_type'] as $s_type ){
//                            if( in_array($s_type, $allow_search_types) ){
//                                if( $s_type == 'text' ){
//                                    $chkd_types[] = 'text';
//                                    $conditions['OR'][] = [
//                                        'OR' => [
//                                            ['Articles.title LIKE' => '%'. $str .'%'],
//                                            ['Articles.sub_title LIKE' => '%'. $str .'%'],
//                                            ['Articles.short_desc LIKE' => '%'. $str .'%'],
//                                            ['Articles.img_text LIKE' => '%'. $str .'%'],
//                                            ['Articles.body LIKE' => '%'. $str .'%'],
//                                        ]
//                                    ];
//
//                                } elseif( $s_type == 'author' ){
//                                    $chkd_types[] = 'author';
//                                    $conditions['OR'][] = ['Authors.name LIKE' => '%'. $str .'%'];
//
//                                } elseif( $s_type == 'tag' ){
//                                    $chkd_types[] = 'tag';
//                                    // $conditions[] = ['Tags.id' => 43];
//                                    $tags_ids = $this->Tags->find('list', [
//                                            'keyField' => 'id',
//                                            'valueField' => 'id',
//                                        ])
//                                        ->where(['Tags.title LIKE' => '%'.$str.'%'])
//                                        ->toList();
//
//                                    if( $tags_ids ){
//                                        $conditions['OR'][] = ['Tags.id IN' => $tags_ids];
//                                    } else{
//                                        $is_search = false;
//                                    }
//                                }
//                            }
//                        }
//
//                    } else{
//
//                        $conditions[] = ['Articles.title LIKE' => '%'. $str .'%'];
//
//                    }
//                }
//            }
//
//            if( isset($_GET['date']) && $_GET['date'] ){
//                $chkd_date = date('Y-m-d', strtotime($_GET['date']));
//                $conditions[] = [
//                    'Articles.date >=' => $chkd_date . ' 00:00:00',
//                    'Articles.date <=' => $chkd_date . ' 23:59:59',
//                ];
//            }
//        }
//         if( isset($_GET['tags']) && $_GET['tags'] ){
//                foreach( $_GET['tags'] as $tag ){
//                       $tags_ids[] = $tag;
//
//                    }
//                         $conditions['OR'][] = ['Tags.id IN' => $tags_ids];
//            }
//
//
//        if( isset($_GET['sorting']) && in_array($_GET['sorting'], $allow_sorting) ){
//            if( $_GET['sorting'] == 'date_asc' ){
//                $sorting = ['Articles.date' => 'ASC'];
//                $chkd_sort = 'date_asc';
//            } elseif( $_GET['sorting'] == 'title_asc' ){
//                $sorting = ['Articles.title' => 'ASC'];
//                $chkd_sort = 'title_asc';
//            } elseif( $_GET['sorting'] == 'title_desc' ){
//                $sorting = ['Articles.title' => 'DESC'];
//                $chkd_sort = 'title_desc';
//            }
//        }
//
//        $cur_page = 1;
//        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
//            $cur_page = $_GET['page'];
//        }
//        $per_page = 9; // 9
//        $offset = ($cur_page * $per_page) - $per_page;
//        $pag_settings = [
//            'limit' => $per_page,
//        ];
//
//        if( $is_search ){
//            $data = $this->Articles->find('all')
//                ->contain([
//                    'Authors' => function(Query $q){
//                        return $q->enableAutoFields();
//                    },
//                ])
//                ->leftJoinWith('Tags')
//                ->group(['Articles.id'])
//                ->where($conditions)
//                ->select(['id', 'category_id', 'title', 'alias', 'short_desc', 'date', 'img', 'views'])
//                ->order($sorting)
//                ->limit($per_page)->offset($offset)
//                ->toList();
//
//            $this->set('pagination', $this->paginate(
//                $this->Articles->find('all')
//                    ->contain([
//                        'Authors' => function(Query $q){
//                            return $q->enableAutoFields();
//                        },
//                    ])
//                    ->leftJoinWith('Tags')
//                    ->where($conditions)
//                    ->group(['Articles.id'])
//                    ->select(['id', 'category_id', 'title', 'date'])
//                    ->order($sorting)
//                    ->limit($per_page),
//                $pag_settings
//            ));
//
//        } else{
//            $data = [];
//        }
//
//        $this->set( compact('data', 'str', 'chkd_sort', 'chkd_types', 'chkd_date', 'search_mode','tags','tags_ids') );
//    }
}
