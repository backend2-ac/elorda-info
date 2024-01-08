<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Block extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'img' => true,
		'link' => true,
		'position' => true,
		'item_order' => true,

		'created_at' => true,
		'updated_at' => true,
	];

	public function _setImg($file){
		return $this->uploadImageFunc($file, 'blocks', 2000, 2000, 300, 300);
	}

	// public function _setDoc($file){
	// 	return $this->uploadDocumentFunc($file, 'news');
	// }
}

 ?>