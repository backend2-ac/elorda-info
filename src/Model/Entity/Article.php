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
		'rubric_id' => true,
		'author_id' => true,
		'title' => true,
		'sub_title' => true,
		'alias' => true,
		'img' => true,
		'img_text' => true,
		'short_desc' => true,
		'body' => true,
		'date' => true,

		'reading_time' => true,
		'views' => true,
		'on_main' => true,
		'on_sidebar' => true,

		'meta_title' => true,
		'meta_keywords' => true,
		'meta_description' => true,

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