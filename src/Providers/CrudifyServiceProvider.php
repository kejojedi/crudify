<?php

namespace Kejojedi\Crudify\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Kejojedi\Crudify\Commands\GeneratesCrud;
use Kejojedi\Crudify\Commands\InstallsCrudify;

class CrudifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallsCrudify::class,
                GeneratesCrud::class,
            ]);
        }
    }
}
