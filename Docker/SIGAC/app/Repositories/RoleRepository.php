<?php 

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Role());
    }   
}