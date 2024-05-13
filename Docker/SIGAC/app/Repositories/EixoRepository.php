<?php 

namespace App\Repositories;

use App\Models\Eixo;

class EixoRepository extends Repository { 

    protected $paginate = true;

    public function __construct() {
        parent::__construct(new Eixo(), $this->paginate);
    }   
}