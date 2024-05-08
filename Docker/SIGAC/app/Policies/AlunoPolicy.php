<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Facades\Permissions;

class AlunoPolicy {
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Aluno $aluno): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Aluno $aluno): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Aluno $aluno): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Aluno $aluno): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Aluno $aluno): bool {
        return Permissions::isAuthorized('coordenador.alunos');
    }

    /**
     * Determine whether the user can permanently list new students registers.
     */
    public function listNewRegisters() : bool {
        return Permissions::isAuthorized('coordenador.validar');
    }

    /**
     * Determine whether the user can permanently validate new registers.
     */
    public function validateNewRegisters() : bool {
        return Permissions::isAuthorized('coordenador.validar');
    }

    /**
     * Determine whether the user can permanently list Student Hours.
     */
    public function listStudentHours() : bool {
        return Permissions::isAuthorized('aluno.solicitar');
    }
}
