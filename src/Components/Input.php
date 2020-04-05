<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;
    public $label;
    public $id;
    public $value;
    public $hint;

    public function __construct($name, $type = 'text', $label = null, $id = null, $value = null, $hint = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
    }

    public function render()
    {
        return view('crudify::input');
    }
}
