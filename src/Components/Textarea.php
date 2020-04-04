<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $rows;
    public $label;
    public $id;
    public $value;

    public function __construct($name, $rows = 3, $label = null, $id = null, $value = null)
    {
        $this->name = $name;
        $this->rows = $rows;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('crudify::textarea');
    }
}
