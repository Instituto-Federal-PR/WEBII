<?php 

namespace App\Repositories;

use App\Models\Declaracao;

class DeclaracaoRepository extends Repository { 

    protected $rows = 6;

    public function __construct() {
        parent::__construct(new Declaracao());
    }   

    public function getRows() { return $this->rows; }

    public function isExists($aluno_id) {
        return Declaracao::where('aluno_id', $aluno_id)->whereNull('comprovante_id')->first();
    }
}