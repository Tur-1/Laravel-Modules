<?php

namespace Tur1\Laravelmodules\Console\Commands;

use Tur1\Laravelmodules\Services\MakeModuleService;
use Illuminate\Console\Command;

class MakePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module structure and optionally a page structure';

    protected $makeModuleService;

    public function __construct(MakeModuleService $makeModuleService)
    {
        parent::__construct();
        $this->makeModuleService = $makeModuleService;
    }

    public function handle()
    {
        $moduleName = $this->argument('name');

        $PageResponse =  $this->makeModuleService->makePage($moduleName);
        if ($PageResponse['error']) {
            $this->error($PageResponse['message']);
        } else {

            $this->info($PageResponse['message']);
        }
    }
}
