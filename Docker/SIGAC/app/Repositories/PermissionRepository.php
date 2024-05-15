<?php 

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends Repository { 

    protected $rows = 2;

    public function __construct() {
        parent::__construct(new Permission());
    }   

    public function getRows() { return $this->rows; }
}