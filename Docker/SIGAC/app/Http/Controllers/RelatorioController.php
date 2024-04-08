<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlunoRepository;
use App\Repositories\TurmaRepository;
use Dompdf\Dompdf;

class RelatorioController extends Controller {
    
    private $dompdf;
    private $curso_id = 2;
    
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
        // return $data;

        // Carrega o HTML da View
        $this->dompdf->loadHtml(view('relatorio.pdf.turma', compact('data')));
        
        // Converte o HTML em PDF
        $this->dompdf->render();

        // Serializa o PDF para Abertura em uma Nova Aba
        $this->dompdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));
    }

    public function reportStudent($aluno_id) {
        
    }
}
