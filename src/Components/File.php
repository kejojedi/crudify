<?php

namespace Kejojedi\Crudify\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class File extends Component
{
    public $name;
    public $label;
    public $file_label;
    public $id;
    public $multiple;
    public $hint;

    public function __construct($name, $label = null, $fileLabel = null, $id = null, $multiple = false, $hint = null)
    {
        $this->name = $name;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->file_label = $fileLabel;
        $this->id = $id ?? $name;
        $this->multiple = $multiple;
        $this->hint = $hint;
    }

    public function render()
    {
        return view('crudify::file');
    }
}
