<?php

namespace Hasnularief\Auditor;

use Illuminate\Support\ServiceProvider;

class AuditorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/views'              => base_path('resources/views/hasnularief/auditor'),
            __DIR__.'/config/auditor.php' => config_path('auditor.php'),
            __DIR__.'/migrations'         => base_path('database/migrations'),
            __DIR__.'/resources/assets/js' => public_path('vendor/js'),
        ], 'auditor');
        
        $this->loadViewsFrom(__DIR__.'/views', 'auditor');

        if ($this->app->runningInConsole()) {
            $this->commands([
                AuditorClearCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
        __DIR__.'/config/auditor.php', 'auditor'
        );


        // include __DIR__.'/routes.php';
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->app->make('Hasnularief\Auditor\AuditorController');


    }
}
