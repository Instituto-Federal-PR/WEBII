<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\StudentRegister;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Repositories\TurmaRepository;

use App\Mail\StudentRegister as StudentRegisterMail;
use Illuminate\Support\Facades\Mail;

class StudentRegisterListener {
    
    public function __construct() {
        //
    }

    public function handle(StudentRegister $event): void {
        
        $role_id = Role::getRoleId("COORDENADOR");
        $user = (new UserRepository())->findUserByRoleAndCourse($role_id, $event->curso_id);
        $turma = (new TurmaRepository())->findById($event->turma_id);

        Mail::send(
            new StudentRegisterMail(
                (Object) [
                    "aluno" => $event->aluno,
                    "turma" => $turma->ano,
                    "coordenador" => $user->name,
                    "email" => $user->email,
                    "curso" => $user->curso->nome
                ]
            )
        );
    }
}
