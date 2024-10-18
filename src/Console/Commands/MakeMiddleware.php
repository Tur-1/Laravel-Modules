<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Tur1\Laravelmodules\Services\GenerateModuleFile;

class MakeMiddleware extends Command
{
    protected $signature = 'module:middleware {name} {--m=}';
    protected $description = 'Create a new middleware class for a given module';

    public function handle()
    {

        $name = $this->argument('name');
        $module = $this->option('m');

        try {
            $namespace = GenerateModuleFile::generate('middleware', $module, $name, 'Middleware');
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("{$name} created successfully in $namespace");
        return 0;
    }
}
