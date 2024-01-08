<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class PagesTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('pages');

		$this->addBehavior('Translate', [
			'fields' => [
				'title', 
				'meta_title', 
				'meta_description', 
				'meta_keywords',
			],
			'allowEmptyTranslations' => false
		]);
	}
}

 ?>