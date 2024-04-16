<?php 

namespace App\Repositories;

use App\Models\Aluno;
use App\Models\Documento;
use App\Models\Declaracao;
use App\Repositories\DocumentoRepository;

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

            // Solicitados pelo aluno
            $hours = (new DocumentoRepository())->getTotalHoursByStudent($item->user_id);
            
            // Lançados pelos professores
            $total_entry = (new ComprovanteRepository())->getTotalHoursByStudent($item->id);

            $aux[$cont] = (Object) [
                "nome" => $item->nome,
                "solicitado" => $this->convertNullToZero($hours->total_in),
                "validado" => $this->convertNullToZero($hours->total_out),
                "lancado" => $this->convertNullToZero($total_entry),
            ];
            $cont++;
        }
        $data = collect();
        $data["turma"] = $turma->curso->sigla . "-" . $turma->ano;
        $data["aluno"] = $aux;

        return $data;
    }

    public function selectHoursByStudent($aluno_id) {

        // Aluno
        $aluno = $this->findByIdWith(['curso', 'turma', 'user'], $aluno_id);
        // Horas Solicitadas pelo aluno
        $horas_solicitadas = (new DocumentoRepository())->findByColumnWith('user_id', $aluno->user->id, ['categoria']);
        // Horas Lançadas para o aluno
        $horas_lancadas = (new ComprovanteRepository())->getHoursByStudent($aluno->id);

        $data = collect();
        $data["aluno"] = $aluno->nome;
        $data["curso"] = $aluno->curso->nome;
        $data["turma"] = $aluno->curso->sigla . "-" . $aluno->turma->ano;
        $data["total"] = (new DocumentoRepository())->getTotalHoursByStudent($aluno->user->id)->total_out + 
            (new ComprovanteRepository())->getTotalHoursByStudent($aluno->id);

        $pedidos = array();
        $cont = 0;
        
        foreach($horas_solicitadas as $item) {

            $pedidos[$cont] = (Object) [
                "descricao" => $item->descricao,
                "horas_in" => $item->horas_in,
                "status" => (new DocumentoRepository())->getMapStatus($item->status),
                "horas_out" => $item->horas_out,
                "categoria" => $item->total_in,
            ];
            $cont++;
        } 
        $data["pedidos"] = $pedidos;

        $lancados = array();
        $cont = 0;
        foreach($horas_lancadas as $item) {

            $lancados[$cont] = (Object) [
                "nome" => $item->atividade,
                "horas" => $item->horas,
                "categoria" => $item->categoria->nome,
                "servidor" => $item->user->name
            ];
            $cont++;
        } 
        $data["lancados"] = $lancados;

        return $data;
    }
    
    public function convertNullToZero($value) {
        if(is_null($value)) return 0;
        return $value;
    }

    public function sumHoursStudent($aluno_id) {
        return  (new ComprovanteRepository())->getTotalHoursByStudent($aluno_id);
    }
}