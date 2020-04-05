<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\HasInputAttributes;

class Textarea extends Component
{
    use HasInputAttributes;

    public $rows;
    public $value;
    public $readonly;

    public function __construct($name, $rows = 3, $label = null, $id = null, $value = null, $hint = null, $disabled = false, $readonly = false)
    {
        $this->name = $name;
        $this->rows = $rows;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
    }

    public function render()
    {
        return view('crudify::textarea');
    }
}
