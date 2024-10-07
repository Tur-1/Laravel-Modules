<?php

namespace Tur1\Laravelmodules\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
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

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Tur1\Laravelmodules\Console\Commands\MakeModule::class,
                \Tur1\Laravelmodules\Console\Commands\MakeFilter::class,
                \Tur1\Laravelmodules\Console\Commands\MakePage::class,
                \Tur1\Laravelmodules\Console\Commands\MakeModuleMigration::class,
                \Tur1\Laravelmodules\Console\Commands\MakeModuleModel::class,
                \Tur1\Laravelmodules\Console\Commands\MakeModuleRequest::class,
                \Tur1\Laravelmodules\Console\Commands\MakeModuleResource::class,
                \Tur1\Laravelmodules\Console\Commands\MakeModuleController::class,
                \Tur1\Laravelmodules\Console\Commands\MakeMiddleware::class,



            ]);
        }
        JsonResource::withoutWrapping();

        $moduleRouteFiles = glob(app_path('Modules/*/Routes/*'));
        $pageRouteFiles = glob(app_path('Pages/*/Routes/*'));

        $routeFiles = array_merge($moduleRouteFiles, $pageRouteFiles);

        foreach ($routeFiles as $routeFile) {
            $this->loadRoutesFrom($routeFile);
        }

        $this->loadMigrationsFrom(glob(base_path('/app/Modules/*/Database/migrations/*')));
    }
}
