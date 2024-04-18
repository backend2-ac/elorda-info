<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class DocumentsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('documents');
        $this->addBehavior('Translate', [
            'fields' => [
                'title',
                'doc',
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
