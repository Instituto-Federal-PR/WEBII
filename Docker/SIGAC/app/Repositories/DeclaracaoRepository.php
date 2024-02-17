<?php 

namespace App\Repositories;

use App\Models\Declaracao;

class DeclaracaoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Declaracao());
    }   
}