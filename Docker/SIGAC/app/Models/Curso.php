<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model {
    
    use HasFactory;
    use SoftDeletes;

    public function eixo() {
        return $this->belongsTo('\App\Models\Eixo'); 
    }

    public function nivel() {
        return $this->belongsTo('\App\Models\Nivel'); 
    }

    public function aluno() {
        return $this->hasManyTo('\App\Models\Aluno'); 
    }

    public function turma() {
        return $this->hasManyTo('\App\Models\Turma'); 
    }

    public function categoria() {
        return $this->hasManyTo('\App\Models\Categoria'); 
    }
}
