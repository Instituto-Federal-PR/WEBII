<?php 

namespace App\Repositories;

use App\Models\Aluno;

class AlunoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Aluno());
    }   
}