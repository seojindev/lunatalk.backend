<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Supports\HelperClass;

class CustomFacadesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('helperclass', function() {

            return new HelperClass();

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
