<?php 

namespace App\Repositories;

use App\Models\Nivel;

class NivelRepository extends Repository { 

    protected $rows = 2;

    public function __construct() {
        parent::__construct(new Nivel());
    }   

    public function getRows() { return $this->rows; }
}