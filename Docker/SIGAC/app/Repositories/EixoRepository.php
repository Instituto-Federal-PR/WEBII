<?php 

namespace App\Repositories;

use App\Models\Eixo;

class EixoRepository extends Repository { 

    protected $rows = 6;

    public function __construct() {
        parent::__construct(new Eixo());
    }   

    public function getRows() { return $this->rows; }
}