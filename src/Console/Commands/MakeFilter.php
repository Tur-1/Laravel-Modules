<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFilter extends Command
{
    protected $signature = 'filter:create {name} {--module=}';
    protected $description = 'Create a new filter class for a given module';

    public function handle()
    {

        $filterClass = $this->argument('name');
        $module = $this->option('module');

        if (empty($module)) {
            $this->error("The --module option (module) is required.");
            return 1;
        }

        $stubPath = base_path('stubs/filter.stub');
        $targetPath = base_path("app/Modules/{$module}/Filters/{$filterClass}.php");

        if (!File::exists($stubPath)) {
            $this->error("Stub file does not exist at: {$stubPath}");
            return 1;
        }

        $stubContent = File::get($stubPath);
        $namespace = "App\\Modules\\{$module}\\Filters";
        $stubContent = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $filterClass],
            $stubContent
        );

        $directory = dirname($targetPath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($targetPath, $stubContent);

        $this->info("Filter class {$filterClass} created successfully in app/Modules/{$module}/Filters.");

        return 0;
    }
}
