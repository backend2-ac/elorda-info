<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;
use Cake\Log\Log;

class ArticlesController extends AppController{

    /**
     * @var \Cake\Datasource\RepositoryInterface|null
     */
    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Articles');
        $this->loadModel('Categories');
        $this->loadModel('Tags');
        $this->loadModel('ArticlesTags');
        $this->loadModel('Authors');

        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public $img_folder = 'articles';
    public $img_fields = ['img'];

    public function index()
    {
        $model = 'Articles';

        $conditions = [];
        // conditions vars
        $title = '';
        $author_id = '';
        $views_sort = '';
        $has_get_param = false;
        if (isset($_GET['lang']) && $_GET['lang']) {
            $locale = $_GET['lang'];
            $conditions[$model.'.locale'] = $locale;
        }

        if (isset($_GET['author_id']) && $_GET['author_id']) {
            $author_id = $_GET['author_id'];
            $conditions[$model.'.author_id'] = $author_id;
            $has_get_param = true;
        }

        if (isset($_GET['category_id']) && $_GET['category_id']) {
            $category_id = $_GET['category_id'];
            $conditions[$model.'.category_id'] = $category_id;
            $has_get_param = true;
        }

        if (isset($_GET['views_sort']) && $_GET['views_sort']) {
            $has_get_param = true;
            $views_sort = $_GET['views_sort'];
            switch ($views_sort) {
                case 100:
                    $conditions[] = [$model.'.views >=' => 0, $model.'.views <=' => 100];
                    break;
                case 500:
                    $conditions[] = [$model.'.views >=' => 100, $model.'.views <=' => 500];
                    break;
                case 1000:
                    $conditions[] = [$model.'.views >=' => 500, $model.'.views <=' => 1000];
                    break;
                case 1001:
                    $conditions[] = [$model.'.views >=' => 1001];
                    break;
            }
        }
//        $timezone = date_default_timezone_get();
//        $this->_setLogMsg('Admin TimeZone: ' . $timezone, 'time');
        $this->set(compact('title', 'author_id', 'views_sort'));

        if (isset($_GET['title']) && $_GET['title']) {
            $has_get_param = true;
            $title = trim($_GET['title']);

            $data = $this->Articles->find('all')->select([
                'id', 'title', 'views', 'author_id', 'category_id', 'locale', 'created_at', 'publish_start_at', 'img', 'img_path'
            ])
                ->where($conditions)
                ->where(['Articles.title' => $title])
                ->toArray();
            if (!$data) {
                $conditions[] = ['MATCH(Articles.title) AGAINST("' . $title . '")'];
                $this->paginate = [
                    'limit' => 20,
                    'order' => [
                        $model.'.publish_start_at' => 'DESC',
                    ],
                    'conditions' => $conditions
                ];

                $data = $this->paginate($this->Articles->find('all')->select([
                    'id', 'title', 'views', 'author_id', 'category_id', 'locale', 'created_at', 'publish_start_at', 'img', 'img_path'
                ]));
            }
        } else {
            $this->paginate = [
                'limit' => 20,
                'order' => [
                    $model.'.publish_start_at' => 'DESC',
                ],
                'conditions' => $conditions
            ];

            $data = $this->paginate($this->Articles->find('all')->select([
                'id', 'title', 'views', 'author_id', 'category_id', 'locale', 'created_at', 'publish_start_at', 'img', 'img_path'
            ]));
        }

        $categories = $this->_getAdminCategoriesWithLocale($locale);
        $authors = $this->_getAdminAuthors();
        $this->set(compact('data', 'categories', 'authors'));
    }

    private function _updateCacheArticleCount($is_add_or_delete, $locale) {
        $cur_date = date('Y-m-d H:i:s');
        $article_count = $this->_getCountAllArticles($locale);
        $latest_articles_count = $this->_getCountLatestNews($locale);
        if ($is_add_or_delete) {
            $article_count++;
            $latest_articles_count++;
        } else {
            $article_count--;
            $latest_articles_count--;
        }
        Cache::write('count_all_articles_' . $locale, $article_count, 'eternal');
        Cache::write('count_latest_news_' . $locale, $latest_articles_count, 'eternal');
    }

    public function add() {
        $model = 'Articles';
        date_default_timezone_set('Asia/Atyrau');
        if (isset($_GET['lang']) && $_GET['lang']) {
            $locale = $_GET['lang'];
        }
        $is_add_or_delete = true;
        if( $this->request->is('post') ){
            $data = $this->request->getData();
            $data['alias'] = Text::slug($data['title']);
            $data['alias'] = mb_strtolower($data['alias']);
            $data['locale'] = $locale;
            $data['title'] = trim($data['title']);
            $created = $this->$model->find()
                ->where(['alias' => $data['alias']])->first();

            if( $created ){
                $data['alias'] = $this->_slug_render($data['alias']);

                $created = $this->$model->find()
                    ->where(['alias' => $data['alias']])->first();

                if( $created ){
                    $this->Flash->error( __('Запись с таким названием уже существует') );
                    Log::write('info', 'Запись с таким названием уже существует ' . ' Data: ' . json_encode($data));
                    return $this->redirect( $this->referer() );
                }
            }

            if ($data['publish_start_at']) {
                $data['publish_start_at'] = date('Y-m-d H:i:s', strtotime($data['publish_start_at']));
            }
            $data_tags = [];
            if( isset($data['articles_tags']) && $data['articles_tags'] ){
                $data_tags = $data['articles_tags'];
                unset($data['articles_tags']);
            }

            $entity_res = $this->EntityFiles->saveEntityFiles($data, $model, $this->img_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    Log::write('info', 'Entity error: ' . $err[array_key_first($err)] . ' Data: ' . json_encode($data));
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            if( $this->$model->save($entity_res['entity']) ){
                $this->Flash->success(__('Данные успешно сохранены'));
//                $this->_cacheDelete();
                $this->_updateCacheArticleCount($is_add_or_delete, $locale);
                $this->_clearCategoryCache($entity_res['entity']->category_id, $locale);
                if( $data_tags ){
                    $articles_tags = [];
                    foreach( $data_tags as $tag_id ){
                        $articles_tags[] = [
                            'article_id' => $entity_res['entity']->id,
                            'tag_id' => $tag_id,
                        ];
                    }

                    if( $articles_tags ){
                        $entities = $this->ArticlesTags->newEntities($articles_tags);
                        if( $this->ArticlesTags->saveMany($entities) ){
                            $this->Flash->success(__('Теги прикреплены'));
                        } else{
                            Log::write('info', 'Ошибка  прикрепления тегов Data: ' . json_encode($data) . ' \r\n Article_tags: ' . json_encode($articles_tags));
                            $this->Flash->error(__('Ошибка прикрепления тегов'));
                        }
                    }
                }

                return $this->redirect( $this->referer() );
            } else{
                Log::write('info', 'Ошибка сохранения данных! Data: ' . json_encode($data));
                $this->Flash->error(__('Ошибка сохранения данных'));
            }
        }

        $categories = $this->_getAdminCategoriesWithLocale($locale);
        $authors = $this->_getAdminAuthors();
        $tags_list = $this->_getAdminTags($locale);
        $this->set( compact('categories',  'authors', 'tags_list') );
    }

    private function _updateArticleCache($new_article) {
        $cache_key = $new_article->alias;
        Cache::write($cache_key, $new_article, 'long');
    }

    private function _deleteArticleCache($article) {
        $cache_key = $article->alias;
        Cache::delete($cache_key, 'long');
    }

    public function edit($item_id = null) {
        if (isset($_GET['lang']) && $_GET['lang']) {
            $locale = $_GET['lang'];
        }        $model = 'Articles';
        date_default_timezone_set('Asia/Atyrau');
//        $cur_user = $this->request->getSession()->read('Auth.User');
//        if ($cur_user['role'] == 'author') {
//            $is_author_article = $this->$model->find()
//                ->where(['Articles.author_id' => $cur_user['author_id'], 'Articles.id' => $item_id])
//                ->toArray();
//            if (!$is_author_article) {
//                $this->Flash->error(__('У вас нет доступа!'));
//                $this->redirect(['controller' => 'Admin', 'action' => 'index']);
//            }
//        }
        $data = $this->$model->get($item_id, [
            'contain' => ['Tags']
        ]);

        $data_tags = [];
        if( $data['tags'] ){
            foreach( $data['tags'] as $item ){
                $data_tags[] = $item['id'];
            }
        }

        $del_tags = [];

        if ($this->request->is(['post', 'put'])) {
            $data1 = $this->request->getData();
            $old_data = clone $data;
            $articles_tags = [];
            if ($data1['publish_start_at']) {
                $data1['publish_start_at'] = date('Y-m-d H:i:s', strtotime($data1['publish_start_at']));
            }
            $data1['title'] = trim($data1['title']);
            if( !isset($data1['on_main']) || !$data1['on_main'] ){
                $data1['on_main'] = 0;
            }

            if( isset($data1['articles_tags']) && $data1['articles_tags'] ){
                foreach( $data1['articles_tags'] as $tag_id ){
                    if( !in_array($tag_id, $data_tags) ){
                        $articles_tags[] = [
                            'article_id' => $item_id,
                            'tag_id' => $tag_id,
                        ];
                    }
                }

                $del_tags = array_diff($data_tags, $data1['articles_tags']);
            } else{
                $del_tags = $data_tags;
            }

            $entity_res = $this->EntityFiles->saveEntityFiles($data1, $model, $this->img_fields);

            if( $entity_res['entity']->getErrors() ){
                $errors = $entity_res['entity']->getErrors();
                foreach( $errors as $index => $err ){
                    Log::write('info', 'Edit Entity error: ' . $err[array_key_first($err)] . ' Data: ' . json_encode($data));
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }
            $new_data = $entity_res['entity']->toArray();
            $this->$model->patchEntity($data, $new_data);
            if ($this->$model->save($data)) {
                $this->Flash->success(__('Изменения сохранены'));
                $this->_imgDelete($old_data, $entity_res['img_del']);
//                $this->_cacheDelete();
                $this->_clearCategoryCache($data->category_id, $locale, $data->alias);
                if ($old_data->category_id != $data->category_id) {
                    $this->_clearCategoryCache($old_data->category_id, $locale);
                }
                if( $articles_tags ){
                    $entities = $this->ArticlesTags->newEntities($articles_tags);
                    if( $this->ArticlesTags->saveMany($entities) ){
                        $this->Flash->success(__('Теги прикреплены'));
                    } else{
                        $this->Flash->error(__('Ошибка прикрепления тегов'));
                    }
                }

                if( $del_tags ){
                    $del_old_tags = $this->ArticlesTags->query()->delete()->where(['tag_id IN' => $del_tags]);
                    if( $del_old_tags->execute() ){
                        $this->Flash->success(__('Старые Теги удалены'));
                    } else{
                        $this->Flash->error(__('Ошибка удаления старых тегов'));
                    }
                }

                return $this->redirect( $this->referer() );
            }
            Log::write('info', 'Edit Ошибка сохранения данных! Data: ' . json_encode($data));
            $this->Flash->error(__('Ошибка сохранения'));
        }

        $this->set( compact('data', 'data_tags') );

        $categories = $this->_getAdminCategoriesWithLocale($locale);
        $authors = $this->_getAdminAuthors();
        $tags_list = $this->_getAdminTags($locale);
        $this->set( compact('categories',  'authors', 'tags_list') );
    }

    public function delete($item_id = null){
        $model = 'Articles';
        $locale = strpos($_SERVER['REQUEST_URI'], 'kz') ? 'kk' : 'ru';
        $is_add_or_delete = false;
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);

        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_imgDelete($data, $this->img_fields);
            $this->_clearCategoryCache($data->category_id, $locale, $data->alias);
            $this->_updateCacheArticleCount($is_add_or_delete, $locale);
//            $this->_cacheDelete();
            return $this->redirect( $this->referer() );
        } else{
            $this->Flash->error(__('Ошибка удаления'));
        }
    }

    protected function _imgDelete($data = null, $fields = array()){
        $folder = $this->img_folder;

        if( $data && $fields ){
            foreach( $fields as $item ){
                if( isset($data[$item]) && $data[$item] ){
                    $fileName = WWW_ROOT.'img'.DS.$folder.DS.$data[$item];
                    $fileNameThumbs = WWW_ROOT.'img'.DS.$folder.DS.'thumbs'.DS.$data[$item];
                    if( file_exists($fileName) ){
                        unlink($fileName);
                    }
                    if( file_exists($fileNameThumbs) ){
                        unlink($fileNameThumbs);
                    }
                    clearstatcache();
                }
            }
        }
    }
    protected function _updateCountAllArticlesCache() {

    }
    protected function _clearCategoryCache($category_id, $locale, $article_alias = null) {
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
    protected function _cacheDelete(){
        Cache::clearGroup('long');
    }
    protected function _slug_render($slug){
        $slug_date = date('YmdHis');
        $slug = $slug . '_' . $slug_date;
        return $slug;
    }

}


 ?>
