<?php

namespace KABBOUCHI\LogsTool;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use KABBOUCHI\LogsTool\Http\Middleware\Authorize;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class LogsToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        $this->publishes([__DIR__.'/../config/nova-logs.php' => config_path('nova-logs.php'),
        ], 'nova-logs-config');

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Nova::router(['nova', Authenticate::class, Authorize::class], 'logs')
            ->group(__DIR__.'/../routes/inertia.php');

        Route::middleware(['nova', Authenticate::class, Authorize::class])
            ->prefix('nova-vendor/KABBOUCHI/logs-tool')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-logs.php', 'nova-logs');
    }
}
