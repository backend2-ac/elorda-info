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
use Cake\Datasource\Paginator;
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

    public function index($category_alias = null){

        $cat_id = null;
        $cur_date = date('Y-m-d H:i:s');
        $cur_lang = Configure::read('Config.lang');
        $locale = $cur_lang == 'kz' ? 'kk' : 'ru';
        $conditions = [
            'Articles.date <=' => $cur_date
        ];
        $conditions = [
            'OR' => [
                ['Articles.publish_start_at IS NULL', 'Articles.date <' => $cur_date],
                ['Articles.publish_start_at IS NOT NULL', 'Articles.publish_start_at <' => $cur_date],
            ]
        ];
        $cur_cat = null;
        if($category_alias != 'latest-news'){
            $cur_cat = $this->Categories->findByAlias($category_alias)
                ->first();

            if( $cur_cat ){
                $cat_id = $cur_cat['id'];
                $conditions = ['AND' => ['Articles.category_id' => $cat_id]];
            } else {
                throw new NotFoundException(__('Запись не найдена'));
            }
        } else {
            $conditions = ['AND' => ['Articles.locale' => $locale]];
        }


        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 10; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

//        $data = Cache::read($alias . '_news', 'long');
//        if (!$data) {
        $data = $this->Articles->find('all')
            ->where($conditions)
            ->select(['id', 'category_id', 'title', 'alias', 'body', 'date', 'img', 'img_path', 'views'])
            ->order(['Articles.date' => 'DESC'])
            ->limit($per_page)->offset($offset)
            ->toList();
//            Cache::write($alias . '_news', $data, 'long');
//        }

        $popular_news = Cache::read($category_alias . '_popular_news', 'long');
        if (!$popular_news) {
            $popular_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'img_path', 'alias', 'views', 'date'])
                ->where($conditions)
                ->orderDesc('views')
                ->limit(6)
                ->toList();
            Cache::write($category_alias . '_popular_news', $popular_news, 'long');
        }

        $last_news = Cache::read($category_alias . '_last_news', 'long');
        if (!$last_news) {
            $last_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'img_path', 'alias', 'views', 'date'])
                ->where($conditions)
                ->orderDesc('Articles.date')
                ->limit(6)
                ->toList();
            Cache::write($category_alias . '_last_news', $last_news, 'long');
        }

        $this->set('pagination', $this->paginate(
            $this->Articles->find('all')
                ->where($conditions)
                ->select(['id', 'category_id', 'title', 'img', 'img_path', 'date', 'alias', 'body', 'views'])
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
        } else {
            $meta_text = $locale == 'kk' ? 'Барлық жаңалықтар' : 'Все новости';
            $meta['title'] = $meta_text;
            $meta['keys'] = $meta_text;
            $meta['desc'] = $meta_text;
            if( !$meta['title'] ){
                $meta['title'] = $meta_text;

            }
        }

        $this->set( compact('data','meta', 'cur_cat', 'category_alias',  'last_news', 'popular_news') );
    }

    public function view($article_alias){
        $cur_date = date('Y-m-d H:i:s');
        $data = $this->Articles->findByAlias($article_alias)
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
                ->select(['id', 'category_id', 'title', 'img', 'img_path', 'alias', 'views', 'date'])
                ->where($conditions)
                ->orderDesc('views')
                ->limit(6)
                ->toList();
            Cache::write($category_alias . '_popular_news', $popular_news, 'long');
        }

        $last_news = Cache::read($category_alias . '_last_news', 'long');
        if (!$last_news) {
            $last_news = $this->Articles->find('all')
                ->select(['id', 'category_id', 'title', 'img', 'img_path', 'alias', 'views', 'date'])
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
        $meta['desc'] = strip_tags($data['meta_description']);
        $meta['keys'] = $data['meta_keywords'];

        $this->set( compact('data', 'meta', 'other_news', 'category_alias', 'article_alias', 'author_articles','popular_news','last_news') );
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
    public function loadingView2($page_id){

        $this->layout = 'ajax';

        $this->Article->locale = Configure::read('Config.language');
        $limit = 1;
        $page_id = intval(@$page_id);
        $page_id = (empty($page_id)) ? 1 : $page_id;
        $start = ($page_id != 1) ? $page_id * $limit - $limit : 0;
        $datas = $this->Article->find('all', array(
            'conditions' => array(array('Article.id !=' => $_GET['id']), array('Article.category_id' => $_GET['category'])),
            'order' => array('Article.date' => 'DESC'),
            'limit' => $start, $limit,
        ));
        foreach ($datas as $data) {

            if (!$data) {
                throw new NotFoundException("Такой страницы нету");
            }
            $this->Article->query("UPDATE `articles` SET `views` = `views` + 1 WHERE `id`='" . $data['Article']['id'] . "'");

            $title_for_layout = ($data['Article']['meta_title']) ? $data['Article']['meta_title'] : $data['Article']['title'];
            $meta['keywords'] = $data['Article']['keywords'];
            if ($data['Article']['description']) {
                $meta['description'] = $data['Article']['description'];
            } else {
                $meta['description'] = mb_substr(strip_tags($data['Article']['body']), 0, 100) . "...";
            }

            $l = Configure::read('Config.language');

            $comment = $this->Comment->find('all', array(
                'conditions' => array('Comment.material_id' => $data['Article']['id']),
                'order' => array('Comment.created' => 'DESC')
            ));

            $countComment = count($comment);
            $comments_tree = $this->Comment->find('threaded', array(
                'conditions' => array('Comment.material_id' => $data['Article']['id']),
                'order' => array('Comment.created' => 'DESC')
            ));

            $comments = $this->_commentsHtml($comments_tree,$data);

            $question = '';
            $answers = '';
            $tags = '';

            if( $data['Article']['articles_question_id'] != null && $data['Article']['articles_question_id'] != 0 ){
                $question = $this->ArticlesQuestion->findById($data['Article']['articles_question_id']);
                $answers = $this->ArticlesAnswer->find('all', array(
                    'conditions' => array(
                        'ArticlesAnswer.articles_question_id' => $data['Article']['articles_question_id'],
                    )
                ));
            }

            if( $data['Article']['tags'] ){
                $tags = explode(', ', $data['Article']['tags']);
            }


            $lview = 'loadview';
            $title = '$(document).ready(function() {
						document.title = "'.$title_for_layout.'";
					});';

            $this->set(compact('data', 'title_for_layout', 'meta', 'lview', 'title', 'comment', 'countComment', 'comments', 'question', 'answers', 'tags'));
        }
    }

    public function writer($author_alias) {
         $author_artilces = [];
         $author  = $this->Authors->findByAlias($author_alias)
            ->first();
        if (!$author) {
            throw new NotFoundException(__('Запись не найдена'));
        }
        $author_id = $author['id'];
        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 5;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];
        $author_artilces = $this->Articles->find('all')
            ->where([ 'Articles.author_id' => $author_id])
            ->contain([
                'Tags',
            ])
            ->orderDesc('Articles.date')
            ->limit($per_page)
            ->offset($offset)
            ->toList();

        $this->set('pagination', $this->paginate(
            $this->Articles->find()
                ->where([ 'Articles.author_id' => $author_id])
                ->contain([
                    'Tags',
                ])
                ->orderDesc('Articles.date')
                ->limit($per_page), $pag_settings));

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
        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 10;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
            'maxLimit' => 25
        ];

            $tag_articles = $this->Articles->find()
                ->innerJoinWith('ArticlesTags')
                ->where([
                    'ArticlesTags.tag_id' => $tag->id,
                    'Articles.locale' => $tag->locale,
                    'OR' => [
                        ['Articles.publish_start_at <=' => $cur_date],
                        ['Articles.publish_start_at IS NULL', 'Articles.date <=' => $cur_date]
                    ]
                ])
                ->orderDesc('Articles.date')
                ->limit($per_page)
                ->offset($offset)
                ->toArray();

        $this->set('pagination', $this->paginate(
            $this->Articles->find()
                ->innerJoinWith('ArticlesTags')
                ->where([
                    'ArticlesTags.tag_id' => $tag->id,
                    'Articles.locale' => $tag->locale,
                    'OR' => [
                        ['Articles.publish_start_at <=' => $cur_date],
                        ['Articles.publish_start_at IS NULL', 'Articles.date <=' => $cur_date]
                    ]
                ])
                ->orderDesc('Articles.date')
                ->limit($per_page), $pag_settings));

        $this->set(compact('tag_articles','tag'));
    }

    public function search() {
        $cur_lang = Configure::read('Config.lang');
        $locale = $cur_lang == 'kz' ? 'kk' : 'ru';

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 10; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];
        $data = [];
        $search_text = '';
        if (isset($_GET['q']) && $_GET['q']) {
            $search_text = htmlentities($_GET['q']);
            if ($search_text) {

                $data = $this->Articles->find()
                    ->where([
                        'Articles.locale' => $locale,
                        'MATCH(Articles.title) AGAINST("' . $search_text . '")'
                    ])
                    ->select(['id', 'category_id', 'title', 'alias', 'body', 'date', 'img', 'img_path'])
                    ->orderDesc('Articles.date')
                    ->limit($per_page)
                    ->offset($offset);
                $count_query = $this->Articles->find()
                    ->where([
                        'Articles.locale' => $locale,
                        'MATCH(Articles.title) AGAINST("' . $search_text . '")'
                    ])
                    ->count();

                $this->set('pagination', $this->paginate($data, ['total' => $count_query]));
            }
        }
        $this->set( compact('data', 'search_text') );
    }

}
