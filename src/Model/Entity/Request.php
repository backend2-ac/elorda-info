<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Request extends Entity{

	protected $_accessible = [
		'service_id' => true,
		'name' => true,
		'email' => true,
		'phone' => true,
		'date' => true,
	];
}

 ?>