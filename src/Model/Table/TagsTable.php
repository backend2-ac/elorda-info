<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class TagsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('tags');

		$this->belongsToMany('Articles', [
            'through' => 'ArticlesTags',
        ]);
        $this->hasMany('ArticlesTags', [
            'foreignKey' => 'tag_id',
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
