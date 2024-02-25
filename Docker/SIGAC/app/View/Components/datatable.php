<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class datatable extends Component {

    public $title;
    public $header;
    public $crud;
    public $data;
    public $fields;
    public $hide;
    public $remove;
    public $add;

    public function __construct($title, $header, $crud, $data, $fields, $hide, $remove, $add) {
        $this->title = $title;
        $this->header = $header;
        $this->crud = $crud;
        $this->data = $data;
        $this->fields = $fields;
        $this->hide = $hide;
        $this->remove = $remove;
        $this->add = $add;
    }

    public function render() {
        return view('components.datatable');
    }
}
