<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class listitem extends Component {
    
    public $data;
    public $field;
    public $primaryroute;
    public $secondaryroute;
    public $id;
    public $label;

    public function __construct($data, $field, $primaryroute, $secondaryroute, $id, $label) {
        $this->data = $data;
        $this->field = $field;
        $this->primaryroute = $primaryroute;
        $this->secondaryroute = $secondaryroute;
        $this->id = $id;
        $this->label = $label;
    }

    public function render() {
        return view('components.listitem');
    }
}
