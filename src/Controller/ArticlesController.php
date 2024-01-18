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
        if( $cat_id ){
            $conditions[] = ['Articles.category_id' => $cat_id];
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


        $meta = [];
        if( $cur_cat ){
            $meta['title'] = $cur_cat['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $cur_cat['title'];
                $meta['keys'] = $cur_cat['meta_keywords'];
                $meta['desc'] = $cur_cat['meta_description'];
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
                ->limit(3)
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

    public function redactor($id) {
         $model = 'Articles';
         $modelA = 'Authors';
         $data = [];
         $autor  = $this->$modelA->findById($id)
            ->first();

        if($id ){
            $data = $this->$model->find('all')
            ->where([ $model.'.author_id' => $id])
            ->contain([
                'Tags',
            ])
            ->orderDesc($model.'.date')
            ->toList();
        }
        if( is_null($data) || !(int)$data ){
            throw new NotFoundException(__('Запись не найдена'));
        }
           $this->set(compact('data','autor'));
    }

    public function search(){
        $model = 'Articles';
        $cur_date = date('Y-m-d H:i:s');
        $tag = 'Tags';

        $tag_ids = $this->$tag->find('list', [
                'valueField' => 'id'
            ])
            ->select(['id', 'item_order'])
            ->orderDesc($tag.'.item_order')
            ->toList();

        $tags = $this->$tag->find('translations')
            ->where([$tag.'.id IN' => $tag_ids])
            ->orderDesc('item_order')
            ->toList();
        $str = '';
        $chkd_sort = 'date_desc';
        $chkd_types = [];
        $chkd_date = '';

        $is_search = true; // get results

        $search_mode = 'full'; // full, tag

        $sorting = [$model.'.date' => 'DESC'];
        $allow_search_types = ['author', 'tag', 'text'];
        $allow_sorting = ['date_desc', 'date_asc', 'title_asc', 'title_desc'];

        $conditions = [
            $this->$model->translationField('title'). ' is not' => null,
            $model.'.date <=' => $cur_date
        ];

        if( isset($_GET['tag_id']) && $_GET['tag_id'] ){
            $search_mode = 'tag';
            $tag_id = intval($_GET['tag_id']);

            $cur_tag = $this->Tags->findById($tag_id)->first();
            $this->set( compact('cur_tag') );

            if( $tag_id && $cur_tag ){
                $conditions[] = ['Tags.id' => $tag_id];
            }

        } else{
            if( isset($_GET['q_str']) && $_GET['q_str'] ){
                $str = htmlentities($_GET['q_str']);
                if( $str ){
                    if( isset($_GET['search_type']) && $_GET['search_type'] ){
                        foreach( $_GET['search_type'] as $s_type ){
                            if( in_array($s_type, $allow_search_types) ){
                                if( $s_type == 'text' ){
                                    $chkd_types[] = 'text';
                                    $conditions['OR'][] = [
                                        'OR' => [
                                            [$this->$model->translationField('title'). ' LIKE' => '%'. $str .'%'],
                                            [$this->$model->translationField('sub_title'). ' LIKE' => '%'. $str .'%'],
                                            [$this->$model->translationField('short_desc'). ' LIKE' => '%'. $str .'%'],
                                            [$this->$model->translationField('img_text'). ' LIKE' => '%'. $str .'%'],
                                            [$this->$model->translationField('body'). ' LIKE' => '%'. $str .'%'],
                                        ]
                                    ];

                                } elseif( $s_type == 'author' ){
                                    $chkd_types[] = 'author';
                                    $conditions['OR'][] = [$this->Authors->translationField('name'). ' LIKE' => '%'. $str .'%'];

                                } elseif( $s_type == 'tag' ){
                                    $chkd_types[] = 'tag';
                                    // $conditions[] = ['Tags.id' => 43];
                                    $tags_ids = $this->Tags->find('list', [
                                            'keyField' => 'id',
                                            'valueField' => 'id',
                                        ])
                                        ->where([$this->Tags->translationField('title').' LIKE' => '%'.$str.'%'])
                                        ->toList();

                                    if( $tags_ids ){
                                        $conditions['OR'][] = ['Tags.id IN' => $tags_ids];
                                    } else{
                                        $is_search = false;
                                    }
                                }
                            }
                        }

                    } else{

                        $conditions[] = [$this->$model->translationField('title'). ' LIKE' => '%'. $str .'%'];

                    }
                }
            }

            if( isset($_GET['date']) && $_GET['date'] ){
                $chkd_date = date('Y-m-d', strtotime($_GET['date']));
                $conditions[] = [
                    $model.'.date >=' => $chkd_date . ' 00:00:00',
                    $model.'.date <=' => $chkd_date . ' 23:59:59',
                ];
            }
        }
         if( isset($_GET['tags']) && $_GET['tags'] ){
                foreach( $_GET['tags'] as $tag ){
                       $tags_ids[] = $tag;

                    }
                         $conditions['OR'][] = ['Tags.id IN' => $tags_ids];
            }


        if( isset($_GET['sorting']) && in_array($_GET['sorting'], $allow_sorting) ){
            if( $_GET['sorting'] == 'date_asc' ){
                $sorting = [$model.'.date' => 'ASC'];
                $chkd_sort = 'date_asc';
            } elseif( $_GET['sorting'] == 'title_asc' ){
                $sorting = [$this->$model->translationField('title') => 'ASC'];
                $chkd_sort = 'title_asc';
            } elseif( $_GET['sorting'] == 'title_desc' ){
                $sorting = [$this->$model->translationField('title') => 'DESC'];
                $chkd_sort = 'title_desc';
            }
        }

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 9; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        if( $is_search ){
            $data = $this->$model->find('all')
                ->contain([
                    'Authors' => function(Query $q){
                        return $q->enableAutoFields();
                    },
                ])
                ->leftJoinWith('Tags')
                ->group([$model.'.id'])
                ->where($conditions)
                ->select(['id', 'category_id', 'title', 'alias', 'short_desc', 'date', 'img', 'views'])
                ->order($sorting)
                ->limit($per_page)->offset($offset)
                ->toList();

            $this->set('pagination', $this->paginate(
                $this->$model->find('all')
                    ->contain([
                        'Authors' => function(Query $q){
                            return $q->enableAutoFields();
                        },
                    ])
                    ->leftJoinWith('Tags')
                    ->where($conditions)
                    ->group([$model.'.id'])
                    ->select(['id', 'category_id', 'title', 'date'])
                    ->order($sorting)
                    ->limit($per_page),
                $pag_settings
            ));

        } else{
            $data = [];
        }

        $this->set( compact('data', 'str', 'chkd_sort', 'chkd_types', 'chkd_date', 'search_mode','tags','tags_ids') );
    }
}
