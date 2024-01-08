<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Category extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'title' => true,
		'alias' => true,
		'item_order' => true,

		'meta_title' => true,
		'meta_keywords' => true,
		'meta_description' => true,

		'created_at' => true,
		'updated_at' => true,
	];

	// public function _setImg($file){
	// 	return $this->uploadImageFunc($file, 'news', 2000, 2000, 500, 500);
	// }

	// public function _setDoc($file){
	// 	return $this->uploadDocumentFunc($file, 'news');
	// }
}

 ?>