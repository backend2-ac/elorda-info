<?php 

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class RequestsTable extends Table{

	public function initialize(array $config): void{
		$this->setTable('requests');

		$this->belongsTo('Services');
	}

	// public function validationDefault(Validator $validator): Validator{

	// 	$validator
	// 	->allowEmptyString('message');

	// 	return $validator;
	// }
}


 ?>