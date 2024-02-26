<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\ImageUploadTrait;
use App\Model\Entity\DocumentUploadTrait;

class Article extends Entity{

	use ImageUploadTrait;
	use DocumentUploadTrait;

	protected $_accessible = [
		'category_id' => true,
		'author_id' => true,
		'title' => true,
		'alias' => true,
		'img' => true,
		'img_text' => true,
        'img_path' => true,
        'img_hash' => true,
		'body' => true,
		'date' => true,

		'views' => true,
		'on_main' => true,

		'meta_title' => true,
		'meta_keywords' => true,
		'meta_description' => true,

        'publish_start_at' => true,
        'publish_end_at' => true,
        'featured' => true,
        'created_by_id' => true,
        'updated_by_id' => true,
        'locale' => true,
        'cover_photo_source' => true,
        'anonymous' => true,

		'created_at' => true,
		'updated_at' => true,
	];

	public function _setImg($file){
		return $this->uploadImageFunc($file, 'articles', 1500, 1500, 350, 350);
	}

	// public function _setDoc($file){
	// 	return $this->uploadDocumentFunc($file, 'news');
	// }
}

 ?>
