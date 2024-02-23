<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component {

    public $label;
    public $type;
    public $route;

    public function __construct($label, $type, $route) {
        $this->label = $label;
        $this->type = $type;
        $this->route = $route;
    }

    public function render() {
        return view('components.button');
    }
}
