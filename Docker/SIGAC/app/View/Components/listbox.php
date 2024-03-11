<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class listbox extends Component
{
    public $title;
    public $data;
    public $field;

    public function __construct($title, $data, $field) {
        $this->title = $title;
        $this->data = $data;
        $this->field = $field;
    }

    public function render() {
        return view('components.listbox');
    }
}
