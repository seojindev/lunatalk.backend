<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

/**
 * Class FrontServiceProvider
 * @package App\Providers
 */
class FrontServiceProvider extends ServiceProvider
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
        // front view 공통 컴포저.
        View::composer(
            '*', 'App\Http\Composers\ViewBaseComposer'
        );

//        View::composer('*', function ($view) {
//            //
//        });
    }
}
