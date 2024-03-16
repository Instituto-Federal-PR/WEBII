<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tablist extends Component {

    public $tabs;
    public $fieldtab;
    public $id;
    public $data;
    public $fielddata;
    public $header;
    public $fields;
    public $hide;
    public $crud;
    public $create;

    public function __construct($tabs, $fieldtab, $id, $data, $fielddata, $header, $fields, $hide, $crud, $create) {
        $this->tabs = $tabs; 
        $this->fieldtab = $fieldtab;
        $this->id = $id;
        $this->data = $data; 
        $this->fielddata = $fielddata;
        $this->header = $header; 
        $this->fields = $fields; 
        $this->hide = $hide; 
        $this->crud = $crud; 
        $this->create = $create; 
    }

    public function render() { 
        return view('components.tablist');
    }
}
