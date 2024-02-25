<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class selectbox extends Component {

    public $name;
    public $label;
    public $color;
    public $data;
    public $field;
    public $disabled;
    public $event;

    public function __construct($name, $label, $color, $data, $field, $disabled) {
        $this->name = $name;
        $this->label = $label;
        $this->color = $color;
        $this->data = $data;
        $this->field = $field;
        $this->disabled = $disabled;
    }

    public function render() {
        return view('components.selectbox');
    }
}
