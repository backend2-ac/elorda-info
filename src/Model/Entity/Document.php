<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Document extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'lang' => true,
		'doc' => true,
		'item_order' => true,
		'created_at' => true,
		'updated_at' => true,
	];

	public function _setDoc($file){
		return $this->uploadDocumentFunc($file, 'docs');
	}
}

 ?>