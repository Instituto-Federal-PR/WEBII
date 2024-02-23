<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textbox extends Component {

    public $name;
    public $label;
    public $type;
    
    public function __construct($name, $label, $type) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
    }

    public function render() {
        return view('components.textbox');
    }
}
