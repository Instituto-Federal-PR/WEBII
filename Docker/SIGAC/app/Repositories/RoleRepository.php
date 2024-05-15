<?php 

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository { 

    protected $rows = 6;

    public function __construct() {
        parent::__construct(new Role());
    }   

    public function getRows() { return $this->rows; }
}