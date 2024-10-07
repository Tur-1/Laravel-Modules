<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Tur1\Laravelmodules\Services\GenerateModuleFile;

class MakeModuleRequest extends Command
{
    protected $signature = 'module:request {name} {--module=}';
    protected $description = 'Create a new filter class for a given module';

    public function handle()
    {

        $name = $this->argument('name');
        $module = $this->option('module');


        try {
            $namespace = GenerateModuleFile::generate('request', $module, $name, 'Requests');
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("{$name} created successfully in $namespace");
        return 0;
    }
}
