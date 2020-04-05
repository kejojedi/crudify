<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\FormatsOptions;

class Checkboxes extends Component
{
    use FormatsOptions;

    public $name;
    public $options;
    public $label;
    public $id;
    public $value;
    public $hint;

    public function __construct($name, $options, $label = null, $id = null, $value = null, $hint = null)
    {
        $this->name = $name;
        $this->options = $this->formatOptions($options);
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->hint = $hint;
    }

    public function render()
    {
        return view('crudify::checkboxes');
    }
}
