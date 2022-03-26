<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Repositories\Eloquent\BaseRepository;
use App\Http\Repositories\Eloquent\CodesRepository;
use App\Http\Repositories\Eloquent\MediaFileMastersRepository;
use App\Http\Repositories\Eloquent\PhoneVerifyRepository;
use App\Http\Repositories\Eloquent\UserRegisterSelectsRepository;
use App\Http\Repositories\Eloquent\ProductBadgeMastersRepository;
use App\Http\Repositories\Eloquent\ProductBadgesRepository;
use App\Http\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Http\Repositories\Eloquent\ProductColorOptionMastersRepository;
use App\Http\Repositories\Eloquent\ProductImagesRepository;
use App\Http\Repositories\Eloquent\ProductMastersRepository;
use App\Http\Repositories\Eloquent\ProductOptionsRepository;
use App\Http\Repositories\Eloquent\ProductReviewsRepository;
use App\Http\Repositories\Eloquent\ProductWirelessOptionMastersRepository;
use App\Http\Repositories\Eloquent\UserRepository;

use App\Http\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Http\Repositories\Interfaces\CodesRepositoryInterface;
use App\Http\Repositories\Interfaces\MediaFileMastersInterface;
use App\Http\Repositories\Interfaces\PhoneVerifyRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRegisterSelectsRepositoryInterface;
use App\Http\Repositories\Interfaces\ProductBadgeMastersInterface;
use App\Http\Repositories\Interfaces\ProductBadgesInterface;
use App\Http\Repositories\Interfaces\ProductCategoryMastersInterface;
use App\Http\Repositories\Interfaces\ProductColorOptionMastersInterface;
use App\Http\Repositories\Interfaces\ProductImagesInterface;
use App\Http\Repositories\Interfaces\ProductMastersInterface;
use App\Http\Repositories\Interfaces\ProductOptionsInterface;
use App\Http\Repositories\Interfaces\ProductReviewsInterface;
use App\Http\Repositories\Interfaces\ProductWirelessOptionMastersInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;



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
        $this->app->bind(MediaFileMastersInterface::class, MediaFileMastersRepository::class);
        $this->app->bind(PhoneVerifyRepositoryInterface::class, PhoneVerifyRepository::class);
        $this->app->bind(UserRegisterSelectsRepositoryInterface::class, UserRegisterSelectsRepository::class);

        $this->app->bind(ProductBadgeMastersInterface::class, ProductBadgeMastersRepository::class);
        $this->app->bind(ProductBadgesInterface::class, ProductBadgesRepository::class);
        $this->app->bind(ProductCategoryMastersInterface::class, ProductCategoryMastersRepository::class);
        $this->app->bind(ProductColorOptionMastersInterface::class, ProductColorOptionMastersRepository::class);
        $this->app->bind(ProductImagesInterface::class, ProductImagesRepository::class);
        $this->app->bind(ProductMastersInterface::class, ProductMastersRepository::class);
        $this->app->bind(ProductOptionsInterface::class, ProductOptionsRepository::class);
        $this->app->bind(ProductReviewsInterface::class, ProductReviewsRepository::class);
        $this->app->bind(ProductWirelessOptionMastersInterface::class, ProductWirelessOptionMastersRepository::class);
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
