<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class button extends Component {

    public $label;
    public $type;
    public $route;
    public $color;

    public function __construct($label, $type, $route, $color) {
        $this->label = $label;
        $this->type = $type;
        $this->route = $route;
        $this->color = $color;
    }

    public function render() {
        return view('components.button');
    }
}
