<?php

namespace interactivesolutions\honeycombregions\app\providers;

use Illuminate\Support\ServiceProvider;

class HCRegionsServiceProvider extends ServiceProvider
{
    /**
     * Register commands
     *
     * @var array
     */
    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombregions\app\http\controllers';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // register artisan commands
        $this->commands($this->commands);

        // loading views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'HCRegions');

        // loading translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'HCRegions');

        // registering elements to publish
        $this->registerPublishElements();

        // registering helpers
        $this->registerHelpers();

        // registering routes
        $this->registerRoutes();
    }

    /**
     * Register helper function
     */
    private function registerHelpers()
    {
        $filePath = __DIR__ . '/../Http/helpers.php';

        if (\File::isFile($filePath))
            require_once $filePath;
    }

    /**
     *  Registering all vendor items which needs to be published
     */
    private function registerPublishElements()
    {
        // Publish your migrations
        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('/migrations'),
        ], 'migrations');

        /*// Publishing assets
        $this->publishes([
            __DIR__ . '/../public' => public_path('honeycomb'),
        ], 'public');*/
    }

    /**
     * Registering routes
     */
    private function registerRoutes()
    {
        \Route::group(['namespace' => $this->namespace], function ($router) {
            require __DIR__ . '/../../app/honeycomb/routes.php';
        });
    }
}

