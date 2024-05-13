<?php 

namespace App\Repositories;

use App\Models\Nivel;

class NivelRepository extends Repository { 

    protected $paginate = true;

    public function __construct() {
        parent::__construct(new Nivel(), $this->paginate);
    }   
}