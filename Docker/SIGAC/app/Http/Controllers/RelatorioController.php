<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Declaracao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AlunoRepository;
use App\Repositories\DeclaracaoRepository;

class RelatorioController extends Controller {
    
    private $dompdf;
    private $curso_id = 2;  //temporário, até implementar autenticação
    private $meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    
    public function __construct() {
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper('A4', 'portrait');  // opcional
    }

    public function index() {

        $data = (new AlunoRepository())->selectAllByTurmas($this->curso_id);
        return view('relatorio.index', compact(['data']));
    }

    public function reportClass($turma_id) {
        
        $data = (new AlunoRepository())->selectHoursByClass($turma_id);
        
        // Carrega o HTML da View
        $this->dompdf->loadHtml(view('relatorio.pdf.turma', compact('data')));
        // Converte o HTML em PDF
        $this->dompdf->render();
        // Serializa o PDF para Abertura em uma Nova Aba
        $this->dompdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));
    }

    public function reportStudent($aluno_id) {
        
        $data = (new AlunoRepository())->selectHoursByStudent($aluno_id);

        // Carrega o HTML da View
        $this->dompdf->loadHtml(view('relatorio.pdf.aluno', compact('data')));
        // Converte o HTML em PDF
        $this->dompdf->render();
        // Serializa o PDF para Abertura em uma Nova Aba
        $this->dompdf->stream("relatorio-horas-aluno.pdf", array("Attachment" => false));
    }

    public function declaration($total, $id) {

        // Dados do Aluno
        $aluno = (new AlunoRepository())->findByIdWith(['curso'], $id);

        if(isset($aluno)) {
            if(((int)$total) >= $aluno->curso->total_horas) {
                $hoje = date('d/m/Y');
                $data = (Object)[
                    "nome" => $aluno->nome,
                    "cpf" => $aluno->cpf,
                    "horas_cumpridas" => (int) $total,
                    "curso" => $aluno->curso->nome,
                    "horas_necessarias" => $aluno->curso->total_horas,
                    "dia" => substr($hoje, 0, 2),
                    "mes" => $this->meses[(int)substr($hoje, 3, 2)],
                    "ano" => substr($hoje, 6, 4),
                    "hash" => $this->registerDeclaration($id, null),
                ];

                // Carrega o HTML da View
                $this->dompdf->loadHtml(view('relatorio.pdf.comprovante', compact('data')));
                // Converte o HTML em PDF
                $this->dompdf->render();
                // Serializa o PDF para Abertura em uma Nova Aba
                $this->dompdf->stream("comprovante-conclusao.pdf", array("Attachment" => false));
            }
        }

        return view('message')
                ->with('template', "main")
                ->with('type', "danger")
                ->with('titulo', "OPERAÇÃO INVÁLIDA")
                ->with('message', "Não foi possível efetuar o procedimento!")
                ->with('link', "student.listhours");
    }

    public function registerDeclaration($aluno_id, $comprovante_id) {

        $declaracao = (new DeclaracaoRepository())->isExists($aluno_id);
        if(isset($declaracao)) {
            return $declaracao->hash;
        }

        $obj = new Declaracao();
        $obj->data = date('Y-m-d H:i:s');
        $obj->aluno_id = $aluno_id;
        $obj->hash = Hash::make($obj->aluno_id . "_" . $obj->data);

        if($comprovante_id != null) {
            $obj->comprovante_id = $comprovante_id;
        }

        (new DeclaracaoRepository())->save($obj);
        return $obj->hash;
    } 

    // ============================================================//
    // ============================================================//
    // Apenas Exemplo - Material de Aula (método pode ser removido)
    public function test() {
        // Instancia um Objeto da Classe Dompdf
        $dompdf = new Dompdf();
        // Carrega o HTML
        $dompdf->loadHtml('hello world');
        // (Opcional) Configura o Tamanho e Orientação da Página
        $dompdf->setPaper('A4', 'landscape');
        // Converte o HTML em PDF
        $dompdf->render();
        // Serializa o PDF para Navegador
        $dompdf->stream();
    }
}
