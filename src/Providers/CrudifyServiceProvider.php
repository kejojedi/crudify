<?php

namespace Kejojedi\Crudify\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Kejojedi\Crudify\Commands\GeneratesCrud;
use Kejojedi\Crudify\Commands\InstallsCrudify;
use Kejojedi\Crudify\Components\Checkbox;
use Kejojedi\Crudify\Components\Checkboxes;
use Kejojedi\Crudify\Components\File;
use Kejojedi\Crudify\Components\Input;
use Kejojedi\Crudify\Components\Radios;
use Kejojedi\Crudify\Components\Select;
use Kejojedi\Crudify\Components\Textarea;

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

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'crudify');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/crudify')], 'views');

        $this->loadViewComponentsAs('crudify', [
            Checkbox::class,
            Checkboxes::class,
            File::class,
            Input::class,
            Radios::class,
            Select::class,
            Textarea::class,
        ]);
    }
}
