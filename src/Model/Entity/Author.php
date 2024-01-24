<?php

namespace App\Model\Entity;

use App\Model\Entity\ImageUploadTrait;
use Cake\ORM\Entity;

class Author extends Entity{

    use ImageUploadTrait;

	protected $_accessible = [
		'name' => true,
		'password' => true,
        'alias' => true,
        'email' => true,
        'biography' => true,
        'img' => true,
        'published_at' => true,
        'created_by_id' => true,
        'Updated_by_id' => true,
		'item_order' => true,

		'created_at' => true,
		'updated_at' => true,
	];

    public function _setImg($file){
        return $this->uploadImageFunc($file, 'authors', 1500, 1500, 350, 350);
    }
}

 ?>
