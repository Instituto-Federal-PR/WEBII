<?php 

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository extends Repository { 

    protected $rows = 6;

    public function __construct() {
        parent::__construct(new Categoria());
    }   

    public function getRows() { return $this->rows; }
}