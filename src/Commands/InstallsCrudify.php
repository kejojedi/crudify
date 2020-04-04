<?php

namespace Kejojedi\Crudify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class InstallsCrudify extends Command
{
    protected $signature = 'crudify:install';
    protected $description = 'Install Crudify.';

    public function handle()
    {
        // migrate and seed db
        $this->updateDatabaseSeeder();
        Artisan::call('migrate:fresh --seed', [], $this->getOutput());

        // configure & generate ide helper file
        Artisan::call('vendor:publish --tag=config', [], $this->getOutput());
        $this->updateIdeHelperConfig();
        Artisan::call('ide-helper:generate', [], $this->getOutput());

        // configure datatables
        Artisan::call('vendor:publish --tag=datatables-html', [], $this->getOutput());
        $this->updateDatatablesConfig();
        $this->replaceDatatablesScript();

        // scaffold frontend
        Artisan::call('ui bootstrap --auth', [], $this->getOutput());
        $this->insertBrowserSyncMix();
        $this->insertJsResources();
        $this->insertSassResources();
        $this->insertNpmPackages();
        $this->executeNpmCommands();

        $this->info('Crudify installation complete.');
    }

    private function updateDatabaseSeeder()
    {
        $seeder_path = database_path('seeds/DatabaseSeeder.php');
        $seeder_contents = file_get_contents($seeder_path);
        $updated_contents = str_replace('// $this->call(UserSeeder::class);', '$this->call(\Kejojedi\Crudify\Seeders\AdminUserSeeder::class);', $seeder_contents);

        file_put_contents($seeder_path, $updated_contents);

        $this->line('Updated database seeder.');
    }

    private function updateIdeHelperConfig()
    {
        $config_path = config_path('ide-helper.php');
        $config_contents = file_get_contents($config_path);
        $updated_contents = str_replace("'write_eloquent_model_mixins' => false", "'write_eloquent_model_mixins' => true", $config_contents);

        file_put_contents($config_path, $updated_contents);

        $this->line('Updated IDE helper config.');
    }

    private function updateDatatablesConfig()
    {
        $config_path = config_path('datatables-html.php');
        $config_contents = file_get_contents($config_path);
        $updated_contents = str_replace("'class' => 'table'", "'class' => 'table table-hover'", $config_contents);

        file_put_contents($config_path, $updated_contents);

        $this->line('Updated datatables config.');
    }

    private function replaceDatatablesScript()
    {
        $stub_path = __DIR__ . '/../../resources/stubs/install/datatables-script.stub';
        $stub_contents = file_get_contents($stub_path);
        $script_path = resource_path('views/vendor/datatables/script.blade.php');

        file_put_contents($script_path, $stub_contents);

        $this->line('Replaced datatables script.');
    }

    private function insertBrowserSyncMix()
    {
        $mix_path = base_path('webpack.mix.js');
        $mix_contents = file_get_contents($mix_path);
        $mix_domain = str_replace(['http://', 'https://'], '', config('app.url'));
        $stub_contents = str_replace('DummyDomain', $mix_domain, rtrim(file_get_contents(__DIR__ . '/../../resources/stubs/install/browser-sync.stub')));

        if (!Str::contains($mix_contents, $stub_contents)) {
            $mix_contents = rtrim($mix_contents) . PHP_EOL . PHP_EOL . $stub_contents;
        }

        file_put_contents($mix_path, $mix_contents);

        $this->line('Inserted browser sync mix.');
    }

    private function insertJsResources()
    {
        $js_path = resource_path('js/app.js');
        $js_contents = file_get_contents($js_path);
        $js_resources = [
            'datatables.net-bs4',
            'datatables.net-responsive-bs4',
            '../../vendor/kejojedi/crudify/resources/js/crudify',
        ];

        foreach ($js_resources as $js_resource) {
            if (!Str::contains($js_contents, $js_resource)) {
                $js_require = "require('$js_resource');";
                $js_contents = trim($js_contents) . PHP_EOL . PHP_EOL . $js_require;
            }
        }

        file_put_contents($js_path, $js_contents);

        $this->line('Inserted JS resources.');
    }

    private function insertSassResources()
    {
        $sass_path = resource_path('sass/app.scss');
        $sass_contents = file_get_contents($sass_path);
        $sass_resources = [
            '~@fortawesome/fontawesome-free/css/all.css',
            '~datatables.net-bs4/css/dataTables.bootstrap4.css',
            '~datatables.net-responsive-bs4/css/responsive.bootstrap4.css',
            '../../vendor/kejojedi/crudify/resources/css/crudify.css',
        ];

        foreach ($sass_resources as $sass_resource) {
            if (!Str::contains($sass_contents, $sass_resource)) {
                $sass_import = "@import '$sass_resource';";
                $sass_contents = trim($sass_contents) . PHP_EOL . PHP_EOL . $sass_import;
            }
        }

        file_put_contents($sass_path, $sass_contents);

        $this->line('Inserted SASS resources.');
    }

    private function insertNpmPackages()
    {
        $package_path = base_path('package.json');
        $package_contents = file_get_contents($package_path);
        $package_array = json_decode($package_contents, true);
        $packages_to_insert = [
            '@fortawesome/fontawesome-free' => '^5.13.0',
            'datatables.net-bs4' => '^1.10.20',
            'datatables.net-responsive-bs4' => '^2.2.3',
        ];

        foreach ($packages_to_insert as $name => $version) {
            if (!isset($package_array['devDependencies'][$name])) {
                $package_array['devDependencies'][$name] = $version;
            }
        }

        file_put_contents($package_path, json_encode($package_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->line('Inserted NPM packages.');
    }

    private function executeNpmCommands()
    {
        exec('npm install && npm run dev');
        exec('npm run dev');

        $this->line('Executed NPM commands.');
    }
}
