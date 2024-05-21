<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Auth;
use App\Facades\Permissions;

class LoginListener {
    
    public function __construct() {
        
    }

    public function handle(object $event): void {
        // Carregando as Permissões do Usuário / Sessão
        Permissions::loadPermissions(Auth::user()->role_id);
    }
}
