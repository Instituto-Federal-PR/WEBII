<?php 

namespace App\Repositories;

use stdClass;
use App\Models\Turma;

class TurmaRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Turma(), $this->paginate);
    }   

    public function selectAllAdapted($curso_id = 0) {

        if($curso_id == 0)
            $turmas = $this->selectAllWith(['curso']);
        else 
            $turmas = $this->findByColumnWith('curso_id', $curso_id, ['curso']);

        $data = collect();
        $cont = 0;
        foreach($turmas as $turma) {
            $data[$cont] = [
                "id" => $turma->id,
                "turma" => $turma->curso->sigla.$turma->ano,
                "ano" => $turma->ano,
                "curso_id" => $turma->curso_id,
                "curso" => $turma->curso->nome,
            ];
            $cont++;
        }   

        return $data;
    }
}