<?php

namespace App\Policies;
use App\Models\User;
use App\Facades\Permissions;
use App\Models\Role;

class UserPolicy {
    
    public function __construct() {
        
    }

    public function hasFullPermission($user) {

        if(strcmp(Role::getIdRole($user->role_id), "ADMINISTRADOR") == 0) {
            return Permissions::isAuthorized('administrador.coordenadores');
        }
        
        return Permissions::isAuthorized('coordenador.professor');
    }
}
