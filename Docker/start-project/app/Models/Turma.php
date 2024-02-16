<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turma extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }
}
