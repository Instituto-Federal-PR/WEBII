<?php 

namespace App\Repositories;

use App\Models\Nivel;

class NivelRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Nivel());
    }   
}