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
        // Get the migration name and module from the input
        $name = $this->argument('name');
        $module = $this->option('module');

        if ($module) {
            $modulePath = base_path("app/Modules/{$module}/Database/migrations");

            if (!is_dir($modulePath)) {
                $this->error("Module '{$module}' does not exist or the migration path is invalid.");
                return;
            }

            $command = "php artisan make:migration {$name} --path=app/Modules/{$module}/Database/migrations";
            system($command);

            $this->info("Migration created in module: {$module}.");
        } else {
            $command = "php artisan make:migration {$name}";
            system($command);

            $this->info("Migration created in the default migrations directory.");
        }
    }
}
