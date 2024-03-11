<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nivel extends Model {
    
    use HasFactory;
    use SoftDeletes;
    protected $table = "niveis";

    public function curso() {
        return $this->hasMany('\App\Models\Curso');
    }
}
