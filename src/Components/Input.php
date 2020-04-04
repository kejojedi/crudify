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

    public function __construct($name, $type = 'text', $label = null, $id = null, $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('crudify::input');
    }
}
