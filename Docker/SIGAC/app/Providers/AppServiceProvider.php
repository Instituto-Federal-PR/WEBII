<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\{textbox, button, selectbox, datatable};
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {

    public function register(): void {
        
    }

    public function boot(): void {
        Blade::component('components.textbox', 'textbox');
        Blade::component('components.button', 'button');
        Blade::component('components.selectbox', 'selectbox');
        Blade::component('components.datatable', 'datatable');
        Blade::component('components.listbox', 'listbox');
        Blade::component('components.tablist', 'tablist');
        Blade::component('components.requestable', 'requestable');
        Blade::component('components.listitem', 'listitem');
        Paginator::useBootstrap();
    }
}
