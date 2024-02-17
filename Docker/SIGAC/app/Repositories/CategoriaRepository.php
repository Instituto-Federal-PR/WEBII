<?php 

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Categoria());
    }   
}