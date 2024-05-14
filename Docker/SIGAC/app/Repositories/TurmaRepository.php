<?php 

namespace App\Repositories;

use stdClass;
use App\Models\Turma;

class TurmaRepository extends Repository { 

    protected $paginate = true;

    public function __construct() {
        parent::__construct(new Turma(), $this->paginate);
    }   

    public function selectAllAdapted($curso_id = 0) {

        if($curso_id == 0)
            $turmas = $this->selectAllWith(['curso']);
        else 
            $turmas = $this->findByColumnWith('curso_id', $curso_id, ['curso']);

        $cont = 0;
        foreach($turmas as $turma) {
            $turmas[$cont]["turma"] = $turma->curso->sigla.$turma->ano;
            $turmas[$cont]["curso"] = $turma->curso->nome;
            $cont++;
        }   

        return $turmas;
    }
}