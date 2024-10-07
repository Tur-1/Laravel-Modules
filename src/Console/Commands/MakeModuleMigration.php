<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;

class MakeModuleMigration extends MigrateMakeCommand
{
    protected $name = 'make:migration';  // Override the command name to replace the default one

    protected $description = 'Create a new migration file with optional module support';

    protected $module;

    public function __construct(MigrationCreator $creator, Composer $composer)
    {
        parent::__construct($creator, $composer);
    }

    protected function getOptions()
    {
        // Add the --module option in addition to the default options
        return array_merge(parent::getOptions(), [
            ['module', null, InputOption::VALUE_OPTIONAL, 'The name of the module to place the migration in.'],
        ]);
    }

    protected function getMigrationPath()
    {
        // Check if the --module option was provided
        if ($this->option('module')) {
            $module = $this->option('module');
            $modulePath = base_path("app/Modules/{$module}/Database/migrations");

            // Create the module's migrations directory if it doesn't exist
            if (!is_dir($modulePath)) {
                mkdir($modulePath, 0755, true);
            }

            return $modulePath;
        }

        // If no module is provided, use the default migration path
        return parent::getMigrationPath();
    }
}
