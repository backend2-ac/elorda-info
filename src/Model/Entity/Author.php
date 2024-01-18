<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Author extends Entity{



	protected $_accessible = [
		'name' => true,
		'img' => true,
		'item_order' => true,

		'created_at' => true,
		'updated_at' => true,
	];


}

 ?>
