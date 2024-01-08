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
class CommercesController extends AppController
{

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Commerces');

        $this->loadModel('Photos');
        $this->loadModel('Apartments');
        $this->loadModel('AboutCards');

        $this->loadModel('Pages');
        $this->loadComponent('Paginator');
    }

    public function index(){
        $model = 'Commerces';
        $cities = $this->_getCityList();

        $chkd_city_id = 0;

        $conditions = [$this->$model->translationField('title'). ' is not' => null];

        if( isset($_GET['city_id']) && $_GET['city_id'] && array_key_exists($_GET['city_id'], $cities) ){
            $conditions[] = [$model.'.city_id' => $_GET['city_id']];
            $chkd_city_id = $_GET['city_id'];

        } elseif( $cities ){
            $conditions[] = [$model.'.city_id' => array_key_first($cities)];
            $chkd_city_id = array_key_first($cities);
        }

        $cur_page = 1;
        if( isset($_GET['page']) && is_int(intval($_GET['page'])) ){
            $cur_page = $_GET['page'];
        }
        $per_page = 1; // 12
        $offset = ($cur_page * $per_page) - $per_page;
        $pag_settings = [
            'limit' => $per_page,
        ];

        $data = $this->$model->find('all')
            ->where($conditions)
            ->order([$model.'.date' => 'DESC'])
            ->limit($per_page)->offset($offset)
            ->toList();

        $this->set('pagination', $this->paginate(
            $this->$model->find('all')
                ->where($conditions)
                ->order([$model.'.date' => 'DESC'])
                ->limit($per_page), 
            $pag_settings
        ));


        $buildings_classes = $this->_getBuildingsClasses();

        $page = $this->Pages->get(3);
        if( $page ){
            $meta['title'] = $page['meta_title'];
            if( !$meta['title'] ){
                $meta['title'] = $page['title'];
            }
            $meta['desc'] = $page['meta_description'];
            $meta['keys'] = $page['meta_keywords'];
        }

        $this->set( compact('data', 'page', 'meta', 'cities', 'buildings_classes', 'chkd_city_id') );
    }

    public function view($alias){
        $model = 'Commerces';

        $data = $this->$model->findByAlias($alias)
            ->where([$this->$model->translationField('title') . ' is not' => null])
            ->first();

        $item_id = $data['id'];

        if( is_null($item_id) || !(int)$item_id || !$data ){
            throw new NotFoundException(__('Запись не найдена'));
        }

        $photos = $this->Photos->find('all')
            ->where(['Photos.commerce_id' => $item_id])
            ->orderDesc('item_order')
            ->toList();

        $apartments = $this->Apartments->find('all')
            ->where(['Apartments.commerce_id' => $item_id])
            ->order(['Apartments.item_order' => 'DESC'])
            ->toList();

        $about_cards = $this->AboutCards->find('all')
            ->where([
                $this->AboutCards->translationField('title'). ' is not' => null,
                'AboutCards.commerce_id' => $item_id
            ])
            ->orderDesc('AboutCards.item_order')
            ->toList();


        $buildings_classes = $this->_getBuildingsClasses();

        $meta['title'] = $data['meta_title'];
        if( !$meta['title'] ){
            $meta['title'] = $data['title'];
        }
        $meta['desc'] = $data['meta_description'];
        $meta['keys'] = $data['meta_keywords'];

        $this->set( compact('data', 'meta', 'photos', 'buildings_classes', 'apartments', 'about_cards') );
    }
}
