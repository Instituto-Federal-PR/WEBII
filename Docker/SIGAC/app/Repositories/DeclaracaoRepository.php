<?php 

namespace App\Repositories;

use App\Models\Declaracao;

class DeclaracaoRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Declaracao(), $this->paginate);
    }   

    public function isExists($aluno_id) {
        return Declaracao::where('aluno_id', $aluno_id)->whereNull('comprovante_id')->first();
    }
}