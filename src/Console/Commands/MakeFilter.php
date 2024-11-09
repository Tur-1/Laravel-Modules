<?php

namespace Tur1\modules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Tur1\modules\Services\GenerateModuleFile;

class MakeFilter extends Command
{
    protected $signature = 'module:filter {name} {--m=}';
    protected $description = 'Create a new filter class for a given module';

    public function handle()
    {

        $name = $this->argument('name');
        $module = $this->option('m');

        try {
            $namespace = GenerateModuleFile::generate('filter', $module, $name, 'Filters');
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("{$name} created successfully in $namespace");
        return 0;
    }
}
