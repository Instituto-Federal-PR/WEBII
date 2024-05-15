<?php 

namespace App\Repositories;

use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Documento;
use App\Models\Declaracao;
use App\Repositories\DocumentoRepository;

class AlunoRepository extends Repository { 

    protected $rows = 2;

    public function __construct() {
        parent::__construct(new Aluno());
    }   

    public function getRows() { return $this->rows; }

    public function selectAllAdapted($flag, $curso_id, $orm, $paginate) {

        // user_id -> NULL
        if($flag) $data = Aluno::whereNotNull('user_id');
        else $data = Aluno::whereNull('user_id');
        // ORM
        if(count($orm) > 0) $data->with($orm);        

        if($paginate)
            return $data->where('curso_id', $curso_id)->paginate($this->rows);

        return $data->where('curso_id', $curso_id)->get();
    }

    public function selectAllByTurmas($curso_id) {

        $turmas = (new TurmaRepository())->findByColumnWith(
            'curso_id', 
            $curso_id, ['curso'],
            (object) ["use" => false, "rows" => 0]
        );
        // $turmas = Turma::with(['curso'])->where('curso_id', $curso_id)->get();

        $data = collect();
        $cont = 0;

        foreach($turmas as $turma) {
            $data[$cont] = [
                "id" => $turma->id,
                "turma" => $turma->curso->sigla.$turma->ano,
                "ano" => $turma->ano,
                "alunos" => $this->findByColumnAdapted(
                        'turma_id', 
                        $turma->id, 
                        (object) ["use" => true, "rows" => $this->rows]
                ) 
            ];
            $cont++;
        }
        return $data; 
    }

    public function selectHoursByClass($turma_id) {

        $turma = (new TurmaRepository())->findByIdWith(['curso'], $turma_id);
        $alunos = $this->findByColumnWith(
            'turma_id', 
            $turma_id, 
            ['turma', 'curso'], 
            (object) ["use" => false, "rows" => 0]
        );

        $aux = array();
        $cont = 0;
        foreach($alunos as $item) {
            // Apenas aluno com cadastro já validado pelo Coordenador
            if($item->user_id != NULL) {
                // Solicitados pelo aluno
                $hours = (new DocumentoRepository())->getTotalHoursByStudent($item->user_id);
                // Lançados pelos professores
                $total_entry = (new ComprovanteRepository())->getTotalHoursByStudent($item->id);

                $aux[$cont] = (Object) [
                    "id" => $item->id,
                    "user_id" => $item->user_id,
                    "nome" => $item->nome,
                    "solicitado" => $this->convertNullToZero($hours->total_in),
                    "validado" => $this->convertNullToZero($hours->total_out),
                    "lancado" => $this->convertNullToZero($total_entry),
                ];
                $cont++;
            }
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
        $horas_solicitadas = (new DocumentoRepository())->findByColumnWith(
            'user_id', 
            $aluno->user->id, ['categoria'],
            (object) ["use" => false, "rows" => 0]
        );
        // $horas_solicitadas = Documento::with(['categoria'])->where('user_id', $aluno->user->id)->get();
        // Horas Lançadas para o aluno
        $horas_lancadas = (new ComprovanteRepository())->getHoursByStudent($aluno->id);

        $data = collect();
        $data["aluno"] = $aluno->nome;
        $data["curso"] = $aluno->curso->nome;
        $data["turma"] = $aluno->curso->sigla . "-" . $aluno->turma->ano;
        $data["total"] = $this->getTotalValidatedHoursByStudent($aluno);

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

    public function getTotalValidatedHoursByStudent($aluno) {

        return  (new DocumentoRepository())->getTotalHoursByStudent($aluno->user->id)->total_out 
                + 
                (new ComprovanteRepository())->getTotalHoursByStudent($aluno->id);
    }

    public function getTotalStudentsByClass($turma) {

        $total_horas_curso = ((new CursoRepository())->findById($turma->curso_id))->total_horas;
        $alunos_turma = $this->selectHoursByClass($turma->id);
        
        $total_alunos = count($alunos_turma["aluno"]);
        $total_cumpriu = 0;
        foreach($alunos_turma["aluno"] as $aluno) {
            if(($aluno->validado + $aluno->lancado) >= $total_horas_curso) $total_cumpriu++;
        }

        $data = collect();
        $data["turma"] = $alunos_turma["turma"];
        $data["grafico"] = ["total_sim" => $total_cumpriu, "total_nao" => $total_alunos - $total_cumpriu];

        return $data;
    }
    
    public function convertNullToZero($value) {
        if(is_null($value)) return 0;
        return $value;
    }

    public function sumHoursStudent($aluno_id) {
        return  (new ComprovanteRepository())->getTotalHoursByStudent($aluno_id);
    }

    // CARREGA APENAS ALUNOS QUE JÁ TIVERAM CADASTRO VALIDADO PELO COORDENADOR
    public function findByColumnAdapted($column, $value, $paginate) {
        if($paginate->use)
            return Aluno::whereNotNull('user_id')->where($column, $value)->paginate($paginate->rows);

        return Aluno::whereNotNull('user_id')->where($column, $value)->get();
    } 

    public function findByColumnWithAdapted($column, $value, $orm) {
        return Aluno::whereNotNull('user_id')->with($orm)->where($column, $value)->get();
    } 
}