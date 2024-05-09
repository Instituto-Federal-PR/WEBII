<?php

namespace App\Policies;
use App\Models\User;
use App\Facades\Permissions;

class EixoPolicy {

    public function __construct() {
        
    }

    public function hasFullPermission() {
        return Permissions::isAuthorized('administrador.eixos');
    }
}
