<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:resource {name} {--module=}';
    protected $description = 'Create a resource for a specific module';

    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->option('module');

        if (empty($module)) {
            $this->error("The --module option (module) is required.");
            return 1;
        }

        $stubPath = __DIR__ . '/../stubs/resource.stub';

        $targetPath = base_path("app/Modules/{$module}/Resources/{$name}.php");

        if (!File::exists($stubPath)) {
            $this->error("Stub file does not exist at: {$stubPath}");
            return 1;
        }

        $stubContent = File::get($stubPath);
        $namespace = "App\\Modules\\{$module}\\Resources";
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

        $this->info("resource class {$name} created successfully in app/Modules/{$module}/Resources.");

        return 0;
    }
}
