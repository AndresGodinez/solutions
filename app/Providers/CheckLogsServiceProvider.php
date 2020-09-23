<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CheckLogsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App::bind('build', function()
        {
            return new \App\Components\CheckLogs;
        });
    }
}
