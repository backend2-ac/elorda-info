<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class CategoriesTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('categories');

		$this->hasMany('Articles');

		$this->addBehavior('Translate', [
			'fields' => [
				'title', 
				'meta_title', 
				'meta_keywords', 
				'meta_description', 
			],
			'allowEmptyTranslations' => false
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