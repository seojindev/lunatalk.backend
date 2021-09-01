<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CodesRepository;
use App\Repositories\Eloquent\MediaFileMastersRepository;
use App\Repositories\Eloquent\PhoneVerifyRepository;
use App\Repositories\Eloquent\UserRegisterSelectsRepository;
use App\Repositories\Eloquent\ProductBadgeMastersRepository;
use App\Repositories\Eloquent\ProductBadgesRepository;
use App\Repositories\Eloquent\ProductCategoryMastersRepository;
use App\Repositories\Eloquent\ProductColorOptionMastersRepository;
use App\Repositories\Eloquent\ProductImagesRepository;
use App\Repositories\Eloquent\ProductMastersRepository;
use App\Repositories\Eloquent\ProductOptionsRepository;
use App\Repositories\Eloquent\ProductReviewsRepository;
use App\Repositories\Eloquent\ProductWirelessOptionMastersRepository;
use App\Repositories\Eloquent\UserRepository;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\CodesRepositoryInterface;
use App\Repositories\Interfaces\MediaFileMastersInterface;
use App\Repositories\Interfaces\PhoneVerifyRepositoryInterface;
use App\Repositories\Interfaces\UserRegisterSelectsRepositoryInterface;
use App\Repositories\Interfaces\ProductBadgeMastersInterface;
use App\Repositories\Interfaces\ProductBadgesInterface;
use App\Repositories\Interfaces\ProductCategoryMastersInterface;
use App\Repositories\Interfaces\ProductColorOptionMastersInterface;
use App\Repositories\Interfaces\ProductImagesInterface;
use App\Repositories\Interfaces\ProductMastersInterface;
use App\Repositories\Interfaces\ProductOptionsInterface;
use App\Repositories\Interfaces\ProductReviewsInterface;
use App\Repositories\Interfaces\ProductWirelessOptionMastersInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;



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
