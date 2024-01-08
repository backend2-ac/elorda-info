<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Author extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'name' => true,
		'img' => true,
		'position' => true,
		'education' => true,
		'item_order' => true,

		'created_at' => true,
		'updated_at' => true,
	];

	public function _setImg($file){
		return $this->uploadImageFunc($file, 'authors', 500, 500, 250, 250);
	}

	// public function _setDoc($file){
	// 	return $this->uploadDocumentFunc($file, 'news');
	// }
}

 ?>