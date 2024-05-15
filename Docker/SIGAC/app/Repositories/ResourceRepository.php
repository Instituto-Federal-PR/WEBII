<?php 

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository extends Repository { 

    protected $rows = 2;

    public function __construct() {
        parent::__construct(new Resource());
    }   

    public function getRows() { return $this->rows; }
}