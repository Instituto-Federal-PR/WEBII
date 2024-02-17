<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Declaracao extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "declaracoes";

    public function aluno() {
        return $this->belongsTo('App\Models\Aluno');
    }

    public function comprovante() {
        return $this->belongsTo('App\Models\Comprovante');
    }
}
