<?php 

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Role(), $this->paginate);
    }   
}