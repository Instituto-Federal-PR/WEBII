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
    public $create;
    public $id;
    public $modal;

    public function __construct($title, $header, $crud, $data, $fields, $hide, $remove, $create, $id, $modal) {
        $this->title = $title;
        $this->header = $header;
        $this->crud = $crud;
        $this->data = $data;
        $this->fields = $fields;
        $this->hide = $hide;
        $this->remove = $remove;
        $this->create = $create;
        $this->id = $id;
        $this->modal = $modal;
    }

    public function render() {
        return view('components.datatable');
    }
}
