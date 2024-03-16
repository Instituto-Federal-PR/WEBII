<?php 

namespace App\Repositories;

use stdClass;
use App\Models\Turma;

class TurmaRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Turma());
    }   

    public function selectAllAdapted() {

        $turmas = $this->selectAllWith(['curso']);

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