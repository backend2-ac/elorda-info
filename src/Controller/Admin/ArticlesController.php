<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Validation\Validator;
use Cake\I18n\I18n;

use Cake\Cache\Cache;
use Cake\Utility\Text;

class ArticlesController extends AppController{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Articles');

        $this->loadModel('Tags');
        $this->loadModel('ArticlesTags');
        $this->loadModel('Authors');

        $this->loadComponent('Paginator');
        $this->loadComponent('EntityFiles');
    }

    public $img_folder = 'articles';
    public $img_fields = ['img'];

    public function index(){
        $model = 'Articles';

        $conditions = [];
        // conditions vars
        $title = '';
        $author_id = '';
        $views_sort = '';
        $cur_user = $this->request->getSession()->read('Auth.User');
        if ($cur_user['role'] == 'author') {
            $author_id = $cur_user['author_id'];
            $conditions[] = [$model.'.author_id' => $author_id];
        }
        if( isset($_GET['title']) && $_GET['title'] ){
            $title = trim($_GET['title']);
            $conditions[] = [$model . '.title LIKE' => '%'. $title .'%'];
        }
        if( isset($_GET['author_id']) && $_GET['author_id'] ){
            $author_id = $_GET['author_id'];
            $conditions[] = [$model.'.author_id' => $author_id];
        }
        if (isset($_GET['category_id']) && $_GET['category_id']) {;
            $category_id = $_GET['category_id'];
            $conditions[] = [$model.'.category_id' => $category_id];
        }
        if( isset($_GET['views_sort']) && $_GET['views_sort'] ){
            if( $_GET['views_sort'] == 100 ){
                $views_sort = 100;
                $conditions[] = [
                    $model.'.views >=' => 0,
                    $model.'.views <=' => 100
                ];
            } elseif( $_GET['views_sort'] == 500 ){
                $views_sort = 500;
                $conditions[] = [
                    $model.'.views >=' => 100,
                    $model.'.views <=' => 500
                ];
            } elseif( $_GET['views_sort'] == 1000 ){
                $views_sort = 1000;
                $conditions[] = [
                    $model.'.views >=' => 500,
                    $model.'.views <=' => 1000
                ];
            } elseif( $_GET['views_sort'] == 1001 ){
                $views_sort = 1001;
                $conditions[] = [$model.'.views >=' => 1001];
            }
        }

        $this->set( compact('title', 'author_id', 'views_sort') );

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 20;
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data_ids = $this->$model->find('list', [
                'valueField' => 'id'
            ])
            ->where($conditions)
            ->select(['id', 'date', 'author_id', 'views'])
            ->orderDesc($model.'.date')
            ->limit($per_page)->offset($offset)
            ->toList();

        $data = [];
        if( $data_ids ){
            $data = $this->$model->find('all')
                ->where([$model.'.id IN' => $data_ids])
                ->orderDesc('date')
                // ->limit($per_page)->offset($offset)
                ->toList();
        }


        $this->set( compact('data') );

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
            ->where($conditions)
            ->order([$model.'.date' => 'DESC'])
            ->limit($per_page),
            $pag_settings
        ));

        $categories = $this->_getAdminCategories();
        $authors = $this->_getAdminAuthors();
        $this->set( compact('categories',  'authors') );
    }

    public function add(){
        $model = 'Articles';
        date_default_timezone_set('Asia/Almaty');
        $locale = 'kk';
        if (isset($_GET['lang']) && $_GET['lang']) {
            $locale = $_GET['lang'] == 'kz' ? 'kk' : 'ru';
        }
        if( $this->request->is('post') ){
            $data = $this->request->getData();
            $data['alias'] = Text::slug($data['title']);
            $data['alias'] = mb_strtolower($data['alias']);
            $data['locale'] = $locale;
            $created = $this->$model->find()
                ->where(['alias' => $data['alias']])->first();

            if( $created ){
                $data['alias'] = $this->_slug_render($data['alias']);

                $created = $this->$model->find()
                    ->where(['alias' => $data['alias']])->first();

                if( $created ){
                    $this->Flash->error( __('Запись с таким названием уже существует') );
                    return $this->redirect( $this->referer() );
                }
            }

            if( !$data['date'] ){
                $data['date'] = date('Y-m-d H:i:s');
            } else{
                $data['date'] = date('Y-m-d H:i:s', strtotime($data['date']));
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
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            if( $this->$model->save($entity_res['entity']) ){
                $this->Flash->success(__('Данные успешно сохранены'));
                $this->_cacheDelete();

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
                            $this->Flash->error(__('Ошибка прикрепления тегов'));
                        }
                    }
                }

                return $this->redirect( $this->referer() );
            } else{
                $this->Flash->error(__('Ошибка сохранения данных'));
            }
        }

        $categories = $this->_getAdminCategoriesWithLocale($locale);
        $authors = $this->_getAdminAuthors();
        $tags_list = $this->_getAdminTags($locale);
        $this->set( compact('categories',  'authors', 'tags_list') );
    }

    public function edit($item_id = null){
        $model = 'Articles';
        date_default_timezone_set('Asia/Almaty');
        $locale = 'kk';
        if (isset($_GET['lang']) && $_GET['lang']) {
            $locale = $_GET['lang'] == 'kz' ? 'kk' : 'ru';
        }
        $cur_user = $this->request->getSession()->read('Auth.User');
        if ($cur_user['role'] == 'author') {
            $is_author_article = $this->$model->find()
                ->where(['Articles.author_id' => $cur_user['author_id'], 'Articles.id' => $item_id])
                ->toArray();
            if (!$is_author_article) {
                $this->Flash->error(__('У вас нет доступа!'));
                $this->redirect(['controller' => 'Admin', 'action' => 'index']);
            }
        }
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
            $data1['locale'] = $locale;
            if( isset($data1['date']) && $data1['date'] ){
                $data1['date'] = date('Y-m-d H:i:s', strtotime($data1['date']));
            }

            if( !isset($data1['on_main']) || !$data1['on_main'] ){
                $data1['on_main'] = 0;
            }
            if( !isset($data1['on_sidebar']) || !$data1['on_sidebar'] ){
                $data1['on_sidebar'] = 0;
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
                    $this->Flash->error( $err[array_key_first($err)] );
                }
                return $this->redirect( $this->referer() );
            }

            $new_data = $entity_res['entity']->toArray();
            $this->$model->patchEntity($data, $new_data);

            if ($this->$model->save($data)) {
                $this->Flash->success(__('Изменения сохранены'));
                $this->_imgDelete($old_data, $entity_res['img_del']);
                $this->_cacheDelete();

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

        $this->request->allowMethod(['post', 'delete']);
        $data = $this->$model->get($item_id);

        if ($this->$model->delete($data)) {
            $this->Flash->success(__('Элемент успешно удален'));
            $this->_imgDelete($data, $this->img_fields);
            $this->_cacheDelete();
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

    protected function _cacheDelete(){
        Cache::clearGroup('long', 'default');
//        Cache::delete('main_articles_ru', 'long');
//        Cache::delete('main_articles_kz', 'long');
//        Cache::delete('main_articles_en', 'long');
//
//        Cache::delete('capital_news_ru', 'long');
//        Cache::delete('capital_news_kz', 'long');
//        Cache::delete('capital_news_en', 'long');
//
//        Cache::delete('society_news_ru', 'long');
//        Cache::delete('society_news_kz', 'long');
//        Cache::delete('society_news_en', 'long');
//
//        Cache::delete('politica_news_ru', 'long');
//        Cache::delete('politica_news_kz', 'long');
//        Cache::delete('politica_news_en', 'long');
//
//        Cache::delete('culture_news_ru', 'long');
//        Cache::delete('culture_news_kz', 'long');
//        Cache::delete('culture_news_en', 'long');
//
//        Cache::delete('heroes_news_ru', 'long');
//        Cache::delete('heroes_news_kz', 'long');
//        Cache::delete('heroes_news_en', 'long');
//
//        Cache::delete('popular_news_ru', 'long');
//        Cache::delete('popular_news_kz', 'long');
//        Cache::delete('popular_news_en', 'long');
//
//        Cache::delete('last_news_ru', 'long');
//        Cache::delete('last_news_kz', 'long');
//        Cache::delete('last_news_en', 'long');
//
//        Cache::delete('most_popular_ru', 'long');
//        Cache::delete('most_popular_kz', 'long');
//        Cache::delete('most_popular_en', 'long');
//
//        Cache::delete('last_reviews_ru', 'long');
//        Cache::delete('last_reviews_kz', 'long');
//        Cache::delete('last_reviews_en', 'long');

    }

    protected function _slug_render($slug){
        $slug_date = date('YmdHis');
        $slug = $slug . '_' . $slug_date;
        return $slug;
    }

}


 ?>
