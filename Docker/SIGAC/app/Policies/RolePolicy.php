<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class RolePolicy {
    
    public function __construct() {
        
    }

    public function isAdmin() {
        return  Permissions::isAuthorized('administrador');
    }

    public function isCoordinator() {
        return  Permissions::isAuthorized('coordenador');
    }

    public function isProfessor() {
        return  Permissions::isAuthorized('professor');
    }

    public function isStudent() {
        return  Permissions::isAuthorized('aluno');
    }

}
