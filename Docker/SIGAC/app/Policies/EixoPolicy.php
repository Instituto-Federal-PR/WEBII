<?php

namespace App\Policies;

use App\Models\Eixo;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Facades\Permissions;

class EixoPolicy {

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Eixo $eixo): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool{
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Eixo $eixo): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Eixo $eixo): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Eixo $eixo): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Eixo $eixo): bool {
        return Permissions::isAuthorized('administrador.eixos');
    }
}
