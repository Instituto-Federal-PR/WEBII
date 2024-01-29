<?php 

namespace App\Repositories;

use App\Models\Eixo;

class EixoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Eixo());
    }   
}