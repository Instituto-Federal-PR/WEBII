<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aluno extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function turma() {
        return $this->belongsTo('App\Models\Turma');
    }
}
