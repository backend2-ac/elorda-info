<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class RubricsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('rubrics');

		$this->hasMany('Articles');

		$this->addBehavior('Translate', [
			'fields' => [
				'title',  
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