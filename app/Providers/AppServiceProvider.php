<?php

namespace Bahdcasts\Providers;

use Blade;         //create custom blade statement
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //create custom blade statement
        Blade::if('hasStartedSeries', function($series) {
            return auth()->user()->hasStartedSeries($series);
        });
        Blade::if('admin', function() {
            return auth()->user()->isAdmin();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
