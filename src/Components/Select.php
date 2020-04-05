<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\FormatsOptions;
use Kejojedi\Crudify\Traits\HasInputAttributes;

class Select extends Component
{
    use HasInputAttributes, FormatsOptions;

    public $options;
    public $value;
    public $empty;

    public function __construct($name, $options, $empty = true, $label = null, $id = null, $value = null, $hint = null, $disabled = false)
    {
        $this->name = $name;
        $this->options = $this->formatOptions($options);
        $this->empty = $empty;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('crudify::select');
    }
}
