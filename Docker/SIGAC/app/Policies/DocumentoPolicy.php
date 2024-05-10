<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class DocumentoPolicy {
    
    public function __construct() {

    }

    public function hasFullPermission($user) {
        return true;
        //return Permissions::isAuthorized('professor.cadastrar');
    }

    public function hasAssessPermission() {
        return Permissions::isAuthorized('coordenador.avaliar');
    }
}
