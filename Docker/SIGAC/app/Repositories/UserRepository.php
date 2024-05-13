<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository { 

    protected $paginate = true;

    public function __construct() {
        parent::__construct(new User(), $this->paginate);
    }   
}