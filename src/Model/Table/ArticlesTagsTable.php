<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class ArticlesTagsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('articles_tags');

		$this->belongsTo('Articles');
		$this->belongsTo('Tags');

		$this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date' => 'new'
                ]
            ]
        ]);
	}
}


 ?>
