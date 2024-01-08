<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class EmployeesTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('employees');

		$this->addBehavior('Translate', [
			'fields' => [
				'name', 
				'position', 
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
    
        $this->hasOne('Branches', [
            'foreignKey' => 'branche_id',
        ]);
	}
}


 ?>