<?php 

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Permission(), $this->paginate);
    }   
}