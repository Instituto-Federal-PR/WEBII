<?php 

namespace App\Repositories;

use App\Models\Turma;

class TurmaRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Turma());
    }   
}