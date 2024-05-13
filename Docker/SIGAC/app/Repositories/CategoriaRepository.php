<?php 

namespace App\Repositories;

use App\Models\Categoria;

class CategoriaRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Categoria(), $this->paginate);
    }   
}