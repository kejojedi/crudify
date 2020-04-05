<?php

namespace Kejojedi\Crudify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GeneratesCrud extends Command
{
    protected $signature = 'crudify:generate {model} {--force}';
    protected $description = 'Generate CRUD scaffolding for a new model.';
    private $replaces;

    public function handle()
    {
        $this->setReplaces();
        $this->createPhpFiles();
        $this->createViewFiles();
        $this->insertNavLink();
        $this->insertRoutes();

        Artisan::call('ide-helper:generate', [], $this->getOutput());

        $this->info('CRUD generation complete for: ' . $this->argument('model'));
        $this->warn("Don't forget to migrate after updating the new migration file.");
    }

    private function setReplaces()
    {
        $title = trim(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', ' $0', $this->argument('model')));

        $this->replaces = [
            'DummyTitles' => $titles = Str::plural($title),
            'DummyTitle' => $title,
            'DummyClasses' => str_replace(' ', '', $titles),
            'DummyClass' => $this->argument('model'),
            'DummyVars' => $vars = Str::snake($titles),
            'DummyVar' => Str::snake($title),
            'DummyMigration' => date('Y_m_d_') . '000000_create_' . $vars . '_table',
        ];
    }

    private function replace($contents)
    {
        foreach ($this->replaces as $search => $replace) {
            $contents = str_replace($search, $replace, $contents);
        }

        return $contents;
    }

    private function createPhpFiles()
    {
        File::ensureDirectoryExists(app_path('Http/Datatables'));
        File::ensureDirectoryExists(app_path('Http/Requests'));

        $files = [
            'DummyClass' => app_path(),
            'DummyClassController' => app_path('Http/Controllers'),
            'DummyClassDatatable' => app_path('Http/Datatables'),
            'DummyClassRequest' => app_path('Http/Requests'),
            'DummyClassFactory' => database_path('factories'),
            'DummyClassSeeder' => database_path('seeds'),
            'DummyMigration' => database_path('migrations'),
        ];

        foreach ($files as $stub => $path) {
            $stub_contents = file_get_contents(__DIR__ . '/../../resources/stubs/generate/' . $stub . '.stub');
            $new_file = $path . '/' . $this->replace($stub) . '.php';

            $this->createFile($new_file, $stub_contents);
        }
    }

    private function createViewFiles()
    {
        $view_path = resource_path('views/' . $this->replaces['DummyVars']);
        File::ensureDirectoryExists($view_path);

        foreach (File::allFiles(__DIR__ . '/../../resources/stubs/generate/views') as $stub) {
            $stub_contents = $this->replace($stub->getContents());
            $new_file = $view_path . '/' . str_replace('.stub', '.blade.php', $stub->getBasename());

            $this->createFile($new_file, $stub_contents);
        }
    }

    private function createFile($new_file, $stub_contents)
    {
        if (!file_exists($new_file) || $this->option('force')) {
            file_put_contents($new_file, $this->replace($stub_contents));

            $this->line('Created new file: ' . $new_file);
        }
        else {
            $this->info('File already exists: ' . $new_file);
        }
    }

    private function insertNavLink()
    {
        $stub_contents = $this->replace(rtrim(file_get_contents(__DIR__ . '/../../resources/stubs/generate/navbar-link.stub')));
        $nav_file = resource_path('views/layouts/app.blade.php');

        if (file_exists($nav_file)) {
            $nav_contents = file_get_contents($nav_file);
            $nav_hook = '                            <li class="nav-item dropdown">';

            if (Str::contains($nav_contents, $nav_hook) && !Str::contains($nav_contents, $stub_contents)) {
                $nav_contents = Str::replaceLast($nav_hook, $stub_contents . PHP_EOL . PHP_EOL . $nav_hook, $nav_contents);

                file_put_contents($nav_file, $nav_contents);

                $this->line('Nav link inserted in: ' . $nav_file);
            }
        }
    }

    private function insertRoutes()
    {
        $stub_contents = $this->replace(rtrim(file_get_contents(__DIR__ . '/../../resources/stubs/generate/routes.stub')));
        $routes_file = base_path('routes/web.php');
        $routes_contents = file_get_contents($routes_file);

        if (!Str::contains($routes_contents, $stub_contents)) {
            file_put_contents($routes_file, rtrim($routes_contents) . PHP_EOL . PHP_EOL . $stub_contents);

            $this->line('Routes inserted in: ' . $routes_file);
        }
    }
}
