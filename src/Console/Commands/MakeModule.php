<?php

namespace Tur1\modules\Console\Commands;

use Tur1\modules\Services\MakeModuleService;
use Illuminate\Console\Command;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module structure';

    protected $makeModuleService;

    public function __construct(MakeModuleService $makeModuleService)
    {
        parent::__construct();
        $this->makeModuleService = $makeModuleService;
    }

    public function handle()
    {
        $moduleName = $this->argument('name');

        $response =  $this->makeModuleService->makeModule($moduleName);
        if ($response['error']) {
            $this->error($response['message']);
        } else {

            $this->info($response['message']);
        }
    }
}
