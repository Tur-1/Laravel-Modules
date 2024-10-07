<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeModuleMigration extends Command
{
    protected $signature = 'make:migration {name} {--module=}';

    protected $description = 'Create a migration for a specific module';

    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->option('module');

        $arguments = [
            'name' => $name,
        ];

        // Check if the module option is provided
        if ($module) {
            $modulePath = base_path("app/Modules/{$module}/Database/migrations");

            // Validate if the module path exists
            if (!is_dir($modulePath)) {
                $this->error("Module '{$module}' does not exist or the migration path is invalid.");
                return;
            }

            // Add the path to the arguments if the module is specified
            $arguments['--path'] = "app/Modules/{$module}/Database/migrations";
        }

        // Run the Artisan command with or without the path
        Artisan::call('make:migration', $arguments);
    }
}
