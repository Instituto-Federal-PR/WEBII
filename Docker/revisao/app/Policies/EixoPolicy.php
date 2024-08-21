<?php

namespace App\Policies;

use App\Http\Controllers\PermissionController;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EixoPolicy
{
    use HandlesAuthorization;

    public function __construct() {
    }

    public function index() {
        return PermissionController::isAuthorized('eixo.index');
    }

    public function create() {
        return PermissionController::isAuthorized('eixo.create');
    }

    public function edit() {
        return PermissionController::isAuthorized('eixo.edit');
    }

    public function show() {
        return PermissionController::isAuthorized('eixo.show');
    }

    public function destroy() {
        return PermissionController::isAuthorized('eixo.destroy');
    }
    
}
