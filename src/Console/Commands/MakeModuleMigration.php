<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;

class MakeModuleMigration extends Command
{
    protected $signature = 'make:migration {name} {--module=}';

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
            Artisan::call('make:migration', [
                'name' => $name,
                '--path' => "app/Modules/{$module}/Database/migrations",
            ]);
        }
    }
}
