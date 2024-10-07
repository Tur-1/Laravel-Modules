<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Tur1\Laravelmodules\Services\GenerateModuleFile;

class MakeModuleController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:controller {name} {--module=}';
    protected $description = 'Create a controller for a specific module';

    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->option('module');

        try {
            $namespace = GenerateModuleFile::generate('controller.api', $module, $name);
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("{$name} created successfully in $namespace");
        return 0;
    }
}
