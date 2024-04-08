<?php 

namespace App\Repositories;

use App\Models\Aluno;
use App\Models\Documento;

class AlunoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Aluno());
    }   

    public function selectAllByTurmas($curso_id) {

        $turmas = (new TurmaRepository())->findByColumnWith('curso_id', $curso_id, ['curso']);
        
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

    public function selectHoursByClass($turma_id) {

        $turma = (new TurmaRepository())->findByIdWith(['curso'], $turma_id);
        $alunos = $this->findByColumnWith('turma_id', $turma_id, ['turma', 'curso']);

        $aux = array();
        $cont = 0;
        foreach($alunos as $item) {

            $hours = Documento::Where('user_id', $item->user_id)
                ->selectRaw("SUM(horas_in) as total_in")
                ->selectRaw("SUM(horas_out) as total_out")
                ->first();

            if(isset($hours)) {
                if($hours->total_in == NULL) $hours->total_in = 0;
                if($hours->total_out == NULL) $hours->total_out = 0;
            }

            $aux[$cont] = (Object) [
                "id" => $item->id,
                "nome" => $item->nome,
                "solicitado" => $hours->total_in,
                "validado" => $hours->total_out
            ];
            $cont++;
        }
        $data = collect();
        $data["turma"] = $turma->curso->sigla . "-" . $turma->ano;
        $data["aluno"] = $aux;

        return $data;
    }
}