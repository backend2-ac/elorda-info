<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
// use App\Model\Entity\ImageUploadTrait;
// use App\Model\Entity\DocumentUploadTrait;

class Tag extends Entity{

	// use ImageUploadTrait;
	// use DocumentUploadTrait;

	protected $_accessible = [
		'title' => true,
        'alias' => true,
		'item_order' => true,
        'created_by_id' => true,
        'updated_by_id' => true,
        'locale' => true,
		'created_at' => true,
		'updated_at' => true,
	];
}

 ?>
