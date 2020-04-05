<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\HasInputAttributes;

class Input extends Component
{
    use HasInputAttributes;

    public $type;
    public $value;
    public $readonly;

    public function __construct($name, $type = 'text', $label = null, $id = null, $value = null, $hint = null, $disabled = false, $readonly = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
    }

    public function render()
    {
        return view('crudify::input');
    }
}
