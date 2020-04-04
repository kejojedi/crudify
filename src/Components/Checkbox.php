<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name;
    public $label;
    public $checkbox_label;
    public $id;
    public $value;

    public function __construct($name, $label = null, $checkboxLabel = null, $id = null, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->checkbox_label = $checkboxLabel ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('crudify::checkbox');
    }
}
