<?php 

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Resource());
    }   
}