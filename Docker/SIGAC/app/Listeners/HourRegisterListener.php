<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\HourRegister;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Repositories\TurmaRepository;

use App\Mail\HourRegister as HourRegisterMail;
use App\Repositories\AlunoRepository;
use App\Repositories\CategoriaRepository;
use Illuminate\Support\Facades\Mail;

class HourRegisterListener {
    
    public function __construct() {
        //
    }

    public function handle(HourRegister $event): void {
        
        $role_id = Role::getRoleId("COORDENADOR");
        $coordenador = (new UserRepository())->findUserByRoleAndCourse($role_id, $event->user->curso_id);
        $categoria = (new CategoriaRepository())->findById($event->categoria_id);
        $turma = (new TurmaRepository())->findById(
            ((new AlunoRepository())->findFirstByColumn('user_id', $event->user->id))->turma_id
        );

        Mail::send(
            new HourRegisterMail(
                (Object) [
                    "aluno" => $event->user->name,
                    "turma" => $turma->ano,
                    "coordenador" => $coordenador->name,
                    "email" => $coordenador->email,
                    "curso" => $coordenador->curso->nome,
                    "categoria" => $categoria->nome,
                    "atividade" => $event->atividade,
                    "horas" => $event->horas,
                ]
            )
        );
    }
}
