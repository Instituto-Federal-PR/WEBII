<?php

namespace App\Policies;
use App\Models\User;
use App\Facades\Permissions;
class AlunoPolicy {
    
    public function __construct() {
        
    }

    public function hasFullPermission() {
        return Permissions::isAuthorized('coordenador.alunos');
    }
}
