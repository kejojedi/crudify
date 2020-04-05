<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Kejojedi\Crudify\Traits\HasInputAttributes;

class File extends Component
{
    use HasInputAttributes;

    public $file_label;
    public $multiple;

    public function __construct($name, $label = null, $fileLabel = null, $id = null, $multiple = false, $hint = null, $disabled = false)
    {
        $this->name = $name;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->file_label = $fileLabel;
        $this->id = $id ?? $name;
        $this->multiple = $multiple;
        $this->hint = $hint;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('crudify::file');
    }
}
