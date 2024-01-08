<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Employee extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'name' => true,
		'position' => true,
		'mail' => true,
		'item_order' => true,
		'branche_id' => true,
		'created_at' => true,
		'updated_at' => true,
	];


	// public function _setDoc($file){
	// 	return $this->uploadDocumentFunc($file, 'news');
	// }
}

 ?>