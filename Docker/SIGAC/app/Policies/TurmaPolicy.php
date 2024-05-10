<?php

namespace App\Policies;

use App\Models\User;
use App\Facades\Permissions;

class TurmaPolicy {
    
    public function __construct() {
        
    }

    public function hasFullPermission() {
        return Permissions::isAuthorized('coordenador.turmas');
    }

    public function hasClassGraphPermission() {
        return Permissions::isAuthorized('coordenador.graficos.alunos');
    }

    public function hasHoursGraphPermission() {
        return Permissions::isAuthorized('coordenador.graficos.horas');
    }
}
