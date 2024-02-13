<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Request extends Entity{

    protected $_accessible = [
        'email' => true,
        'created_at' => true,
    ];
}

?>
