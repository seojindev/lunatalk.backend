<?php

namespace App\Providers;

use App\Repositories\Eloquent\PhoneVerifyRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\PhoneVerifyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CodesRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\CodesRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CodesRepositoryInterface::class, CodesRepository::class);
        $this->app->bind(PhoneVerifyRepositoryInterface::class, PhoneVerifyRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
