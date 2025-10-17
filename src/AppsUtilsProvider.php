<?php

namespace EfficientDev\AppsUtilsModule;

use Illuminate\Support\ServiceProvider;

class AppsUtilsProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load migrations from the package
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'apps-utils');

        // Optionally register Blade components under a prefix
        \Illuminate\Support\Facades\Blade::componentNamespace(
            'EfficientDev\\AppsUtilsModule\\View\\Components',
            'apps-utils'
        );


        // Publish middleware, jobs, controllers if needed
        $this->publishes([
            __DIR__.'/Controllers' => app_path('Http/Controllers/Vendor'),
            __DIR__.'/Middleware' => app_path('Http/Middleware/Vendor'),
            __DIR__.'/Jobs' => app_path('Jobs/Vendor'),
        ], 'apps-utils');

        // Optionally allow publishing migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'apps-utils-migrations');

        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/vendor/shared-module/components'),
        ], 'apps-utils-components');

    }

    public function register()
    {
        // You can bind interfaces or register config here
    }
}
