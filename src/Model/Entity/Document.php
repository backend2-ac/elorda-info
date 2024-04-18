<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Document extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
        'page_id' => true,
		'lang' => true,
		'doc' => true,
        'title' => true,
		'item_order' => true,
		'created_at' => true,
		'updated_at' => true,
	];

	public function _setDoc($file){
		return $this->uploadDocumentFunc($file, 'docs');
	}
}

 ?>
