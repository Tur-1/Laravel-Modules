<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeMiddleware extends Command
{
    protected $signature = 'module:middleware {name} {--module=}';
    protected $description = 'Create a new middleware class for a given module';

    public function handle()
    {

        $name = $this->argument('name');
        $module = $this->option('module');

        if (empty($module)) {
            $this->error("The --module option (module) is required.");
            return 1;
        }

        $stubPath = __DIR__ . '/../stubs/middleware.stub';
        $targetPath = base_path("app/Modules/{$module}/Middleware/{$name}.php");

        if (!File::exists($stubPath)) {
            $this->error("Stub file does not exist at: {$stubPath}");
            return 1;
        }

        $stubContent = File::get($stubPath);
        $namespace = "App\\Modules\\{$module}\\Middleware";
        $stubContent = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $name],
            $stubContent
        );

        $directory = dirname($targetPath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($targetPath, $stubContent);

        $this->info("Middleware class {$name} created successfully in app/Modules/{$module}/Middleware.");

        return 0;
    }
}
