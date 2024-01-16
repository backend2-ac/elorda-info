<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ArticlesTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('articles');

		$this->belongsTo('Categories');
		$this->belongsTo('Authors');

		$this->belongsToMany('Tags', [
            'through' => 'ArticlesTags',
        ]);

		$this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);
	}
}


 ?>
