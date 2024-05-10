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

    public function hasListStudentHoursPermission() {
        return Permissions::isAuthorized('aluno.gerar');
    }

    public function hasReportPermission() {
        return Permissions::isAuthorized('coordenador.relatorio');
    }

    public function hasValidateRegisterPermission() {
        return Permissions::isAuthorized('coordenador.validar');
    }
}
