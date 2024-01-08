<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class AuthorsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('authors');

		$this->addBehavior('Translate', [
			'fields' => [
				'name', 
				'position', 
				'education', 
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