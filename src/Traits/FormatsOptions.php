<?php

namespace Kejojedi\Crudify\Traits;

use Illuminate\Support\Arr;

trait FormatsOptions
{
    private function formatOptions($options)
    {
        if (!Arr::isAssoc($options)) {
            return array_combine($options, $options);
        }

        return $options;
    }
}
