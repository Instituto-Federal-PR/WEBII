<?php 

namespace App\Repositories;

use App\Models\Curso;

class CursoRepository extends Repository { 

    protected $paginate = true;

    public function __construct() {
        parent::__construct(new Curso(), $this->paginate);
    }   
}