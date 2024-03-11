<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Eixo extends Model {
    
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['nome'];
    /* 
        Atributo que permite definir os campos que podem ser 
        "atribuídos em massa" (mass assignment) para a inserção 
        no banco. Utilizado por questões de segurança, contra 
        ataques "mass assignment". Só irá inserir no banco de dados 
        os valores das colunas especificadas no atributo "$fillable".
    */

    public function curso() {
        return $this->hasMany('\App\Models\Curso');
    }
}
