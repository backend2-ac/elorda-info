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
class BlogsController extends AppController
{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Blogs');
        $this->loadModel('Pages');
        $this->loadComponent('Paginator');
    }

    public function index(){
        $model = 'Blogs';

        $conditions = [$this->$model->translationField('title'). ' is not' => null];

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 9; // 9
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $blogs = $this->$model->find('all')
            ->where($conditions)
            ->select(['id', 'title', 'alias', 'short_desc', 'date', 'img'])
            ->order([$model.'.date' => 'DESC'])
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
                ->where($conditions)
                ->select(['id', 'title', 'date'])
                ->order([$model.'.date' => 'DESC'])
                ->limit($per_page), 
            $pag_settings
        ));


        $data = $this->Pages->get(16);
        if( $data ){
            $meta['title'] = $data['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $data['title'];
            }
            $meta['desc'] = $data['meta_description'];
            $meta['keys'] = $data['meta_keywords'];
        }

        $this->set( compact('blogs', 'meta', 'data') );
    }

    public function view($alias){
        $model = 'Blogs';

        $data = $this->$model->findByAlias($alias)
            ->where([$this->$model->translationField('title') . ' is not' => null])
            ->first();

        $item_id = $data['id'];

        if( is_null($item_id) || !(int)$item_id || !$this->$model->get($item_id) ){
            throw new NotFoundException(__('Запись не найдена'));
        }

        $other_news = $this->$model->find('all')
            ->where([$model.'.id !=' => $item_id, $this->$model->translationField('title') . ' is not' => null])
            ->orderDesc($model.'.date')
            ->limit(3)
            ->toList();

        $meta['title'] = $data['meta_title'];
        if( !$meta['title'] ){
            $meta['title'] = $data['title'];
        }
        $meta['desc'] = $data['meta_description'];
        $meta['keys'] = $data['meta_keywords'];

        $this->set( compact('data', 'meta', 'other_news') );
    }
}
