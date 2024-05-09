<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    
    use HasFactory;

    private static $roles = [
        "ADMINISTRADOR" => 1,
        "COORDENADOR" => 2,
        "PROFESSOR" => 3,
        "ALUNO" => 4,
    ];

    public function resource() {
        return $this->belongsToMany('\App\Models\Resource', 'permissions'); 
    }

    public static function getRoleId($name) {
        return self::$roles[$name];
    }

    public static function getIdRole($id) {
        return array_search($id, self::$roles);
    }
}
