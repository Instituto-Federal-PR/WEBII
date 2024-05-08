<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CursoPolicy {
    
    public function viewAny(User $user): bool {
        
    }

    public function view(User $user, Curso $curso): bool {
        
    }

    public function create(User $user): bool {
        
    }

    public function update(User $user, Curso $curso): bool {
        
    }

    public function delete(User $user, Curso $curso): bool {
        
    }

    public function restore(User $user, Curso $curso): bool {
        
    }

    public function forceDelete(User $user, Curso $curso): bool {
        
    }
}
