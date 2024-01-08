<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity{

	protected $_accessible = [
		'username' => true,
		'password' => true,
		'role' => true,

		'name' => true,
		'surname' => true,
		'phone' => true,

		'is_active' => true, // активен ли аккаунт
		'confirm_code' => true, // код верификации для активации аккаунта
		'forgetpwd' => true, // код для сброса пароля

		'created_at' => true,
		'updated_at' => true,
	];
}


 ?>