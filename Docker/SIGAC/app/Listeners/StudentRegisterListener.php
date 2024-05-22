<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\StudentRegister;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Repositories\TurmaRepository;

class StudentRegisterListener {
    
    public function __construct() {
        //
    }

    public function handle(StudentRegister $event): void {
        
        $role_id = Role::getRoleId("COORDENADOR");
        $user = (new UserRepository())->findUserByRoleAndCourse($role_id, $event->curso_id);
        $turma = (new TurmaRepository())->findById($event->turma_id);
        info("[StudentRegisterListener]: $event->aluno");
        info("[StudentRegisterListener]: $turma->ano");
        info("[StudentRegisterListener]: $user->name");
        info("[StudentRegisterListener]: $user->email");
        info("[StudentRegisterListener]: ".$user->curso->nome);
    }
}
