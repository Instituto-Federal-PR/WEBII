<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlunoRepository;
use App\Repositories\TurmaRepository;
use Dompdf\Dompdf;

class RelatorioController extends Controller {
    
    private $dompdf;
    private $curso_id = 2;  //temporário, até implementar autenticação
    
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
