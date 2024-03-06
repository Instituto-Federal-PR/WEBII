<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public function eixo() {
        return $this->belongsTo('\App\Models\Eixo');
    }

    public function nivel() {
        return $this->belongsTo('\App\Models\Nivel');
    }
}
