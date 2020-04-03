<?php

namespace Kejojedi\Crudify\Traits;

use Illuminate\Support\Facades\Schema;

trait FillsColumns
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}
