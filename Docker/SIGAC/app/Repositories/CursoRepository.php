<?php 

namespace App\Repositories;

use App\Models\Curso;

class CursoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Curso());
    }   
}