<?php

namespace Tur1\modules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Tur1\modules\Services\GenerateModuleFile;

class MakeModuleModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model {name} {--m=}';
    protected $description = 'Create a model for a specific module';

    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->option('m');

        try {
            $namespace = GenerateModuleFile::generate('baseModel', $module, $name, 'Models');
        } catch (\Exception $ex) {
            $this->error($ex->getMessage());
            return 1;
        }

        $this->info("{$name} created successfully in $namespace");
        return 0;
    }
}
