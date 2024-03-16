<?php 

namespace App\Repositories;

use App\Models\Aluno;

class AlunoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Aluno());
    }   

    public function selectAllByTurmas() {

        $turmas = (new TurmaRepository())->selectAllWith(['curso']);
        
        $data = collect();
        $cont = 0;

        foreach($turmas as $turma) {
            $data[$cont] = [
                "id" => $turma->id,
                "turma" => $turma->curso->sigla.$turma->ano,
                "ano" => $turma->ano,
                "alunos" => $this->findByColumn('turma_id', $turma->id) 
            ];
            $cont++;
        }
        return $data;
        

    }
}