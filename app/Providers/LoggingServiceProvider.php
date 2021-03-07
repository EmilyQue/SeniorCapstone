<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Utility\MyLogger;

class LoggingServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Utility\ILoggerService', function ($app) {
            return new MyLogger();
        });
    }

    public function provides() {
        echo "Deffered true and I am here in provides()";
        return ['App\Services\Utility\ILoggerService'];
    }
}
