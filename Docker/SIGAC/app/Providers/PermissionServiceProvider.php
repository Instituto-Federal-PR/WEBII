<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Facades\Permissions;

class PermissionServiceProvider extends ServiceProvider {
    
    public function register(): void {
        
        $this->app->bind('permissions', function() {
            return new Permissions();
        });
    }

    public function boot(): void {
        
    }
}
