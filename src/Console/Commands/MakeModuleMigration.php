<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class MakeModuleMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:migration {name} {--module=}';
    protected $description = 'Create a migration for a specific module';

    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->option('module');

        if ($module) {
            $modulePath = base_path("app/Modules/{$module}/Database/migrations");


            if (!is_dir($modulePath)) {
                $this->error("Module '{$module}' does not exist");
                return;
            }

            // Define the full path explicitly to avoid the namespace issue
            Artisan::call('make:migration', [
                'name' => $name,
                '--path' => "app/Modules/{$module}/Database/migrations",
            ]);

            $this->info("Migration created successfully in the {$module} module.");
        } else {
            $this->error('--module=  option is required.');
        }
    }
}
