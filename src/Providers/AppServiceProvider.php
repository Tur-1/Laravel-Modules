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
