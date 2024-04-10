<?php

namespace App\Controller;

use Cake\Cache\Cache;
use Cake\I18n\FrozenTime;

class CacheUpdatesController extends AppController {

    public function initialize(): void{
        parent::initialize();
        $this->loadModel('Articles');
        $this->updateCache();
    }

    public function updateCache(){
        $check_start_date = Cache::read('check_start_date', 'eternal');
        $current_date = FrozenTime::now();
        if (!$check_start_date) {
            Cache::write('check_start_date', $current_date, 'eternal');
        } else {

            if ($current_date >= $check_start_date) {
                $new_articles = $this->Articles->find()
                    ->select(['Articles.title', 'Articles.alias', 'Articles.category_id'])
                    ->where([
                        'Articles.publish_start_at >=' => $check_start_date,
                        'Articles.publish_start_at <=' => $current_date
                    ])
                    ->toList();
                if ($new_articles) {
                    Cache::clearGroup('long');
                }
                Cache::write('check_start_date', $current_date, 'eternal');
            }
        }

    }
}

?>
