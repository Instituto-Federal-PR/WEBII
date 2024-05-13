<?php 

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Resource(), $this->paginate);
    }   
}