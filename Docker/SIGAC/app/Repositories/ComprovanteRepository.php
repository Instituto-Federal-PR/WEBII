<?php 

namespace App\Repositories;

use App\Models\Comprovante;

class ComprovanteRepository extends Repository { 

    protected $paginate = false;

    public function __construct() {
        parent::__construct(new Comprovante(), $this->paginate);
    }
    
    public function getTotalHoursByStudent($aluno_id) {
        return Comprovante::where('aluno_id', $aluno_id)->sum('horas');
    }

    public function getHoursByStudent($aluno_id) {
        return $this->findByColumnWith('aluno_id', $aluno_id, ['categoria', 'user']);
    }
}