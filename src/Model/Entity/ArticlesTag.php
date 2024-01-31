<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
// use App\Model\Entity\ImageUploadTrait;
// use App\Model\Entity\DocumentUploadTrait;

class ArticlesTag extends Entity{

	// use ImageUploadTrait;
	// use DocumentUploadTrait;

	protected $_accessible = [
		'article_id' => true,
		'tag_id' => true,
		'date' => true,
	];
}

 ?>
