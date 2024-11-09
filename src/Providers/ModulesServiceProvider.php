<?php

namespace Tur1\modules\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->configureJsonResource();

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->registerMigrations();
        }

        if (!$this->app->routesAreCached()) {
            $this->registerRoutes();
        }

        $this->registerModulePolicies();
    }
    protected function registerModulePolicies(): void
    {
        $modulesPath = app_path('Modules');
        $modules = glob("{$modulesPath}/*", GLOB_ONLYDIR);

        foreach ($modules as $module) {
            $moduleName = basename($module);

            $modelNamespace = "App\\Modules\\{$moduleName}\\Models";
            $policyNamespace = "App\\Modules\\{$moduleName}\\Policies";

            $modelsPath = "{$module}/Models";

            if (is_dir($modelsPath)) {
                foreach (glob("{$modelsPath}/*.php") as $modelFile) {
                    $modelName = pathinfo($modelFile, PATHINFO_FILENAME);
                    $modelClass = "{$modelNamespace}\\{$modelName}";
                    $policyClass = "{$policyNamespace}\\{$modelName}Policy";

                    if (class_exists($modelClass) && class_exists($policyClass)) {
                        Gate::policy($modelClass, $policyClass);
                    }
                }
            }
        }
    }
    protected function configureJsonResource(): void
    {
        JsonResource::withoutWrapping();
    }
    protected function registerCommands(): void
    {
        $this->commands([
            \Tur1\modules\Console\Commands\MakeModule::class,
            \Tur1\modules\Console\Commands\MakeFilter::class,
            \Tur1\modules\Console\Commands\MakePage::class,
            \Tur1\modules\Console\Commands\MakeModuleMigration::class,
            \Tur1\modules\Console\Commands\MakeModuleModel::class,
            \Tur1\modules\Console\Commands\MakeModuleRequest::class,
            \Tur1\modules\Console\Commands\MakeModuleResource::class,
            \Tur1\modules\Console\Commands\MakeModuleController::class,
            \Tur1\modules\Console\Commands\MakeMiddleware::class,
            \Tur1\modules\Console\Commands\MakeAction::class,
        ]);
    }
    protected function registerMigrations(): void
    {
        $migrationPaths = glob(base_path('app/Modules/*/Database/migrations/*'));

        if ($migrationPaths) {
            $this->loadMigrationsFrom($migrationPaths);
        }
    }
    protected function registerRoutes(): void
    {
        $moduleRouteFiles = glob(app_path('Modules/*/Routes/*'));
        $pageRouteFiles = glob(app_path('Pages/*/Routes/*'));

        $routeFiles = array_merge($moduleRouteFiles, $pageRouteFiles);

        foreach ($routeFiles as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }
    }
}
