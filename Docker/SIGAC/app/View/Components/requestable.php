<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class requestable extends Component {
    
    public $data;

    public function __construct($data) {   
        $this->data = $data;
    }

    public function render() {
        return view('components.requestable');
    }
}
