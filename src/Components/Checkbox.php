<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\HasInputAttributes;

class Checkbox extends Component
{
    use HasInputAttributes;

    public $checkbox_label;
    public $value;

    public function __construct($name, $label = null, $checkboxLabel = null, $id = null, $value = null, $hint = null, $disabled = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->checkbox_label = $checkboxLabel ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('crudify::checkbox');
    }
}
