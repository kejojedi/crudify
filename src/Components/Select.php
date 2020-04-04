<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\FormatsOptions;

class Select extends Component
{
    use FormatsOptions;

    public $name;
    public $options;
    public $empty;
    public $label;
    public $id;
    public $value;

    public function __construct($name, $options, $empty = true, $label = null, $id = null, $value = null)
    {
        $this->name = $name;
        $this->options = $this->formatOptions($options);
        $this->empty = $empty;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->id = $id ?? $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('crudify::select');
    }
}
