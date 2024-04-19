<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class listitem extends Component {
    
    public $data;               // array com os dados a serem apresentados (alunos)
    public $field;              // campo do array a ser exibido na listagem (nome) 
    public $primaryroute;       // Rota para o relatório geral (turma)
    public $secondaryroute;     // Rota para o relatório específico (aluno)
    public $id;                 // Parâmetro passado para rota geral (turma_id)

    public function __construct($data, $field, $primaryroute, $secondaryroute, $id) {
        $this->data = $data;
        $this->field = $field;
        $this->primaryroute = $primaryroute;
        $this->secondaryroute = $secondaryroute;
        $this->id = $id;
    }

    public function render() {
        return view('components.listitem');
    }
}
