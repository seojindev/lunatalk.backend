<?php

namespace App\Console\Commands\Development;

use App\Models\MediaFiles;
use App\Models\ProductBadgeMasters;
use App\Models\ProductBadges;
use App\Models\ProductImages;
use App\Models\ProductReviews;
use App\Models\User;
use App\Models\PhoneVerifies;
use App\Models\ProductCategories;
use App\Models\ProductMasters;
use App\Models\ProductOptionMasters;
use App\Models\UserRegisterSelects;
use Illuminate\Console\Command;

class FactoryDataTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:factory-data-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '개발 DB Factrory 실행';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "User -> ";
        User::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "PhoneVerifies -> ";
        PhoneVerifies::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "UserRegisterSelects -> ";
        UserRegisterSelects::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "ProductCategories -> ";
        ProductCategories::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "ProductMasters -> ";
        ProductMasters::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "ProductOptionMasters -> ";
        ProductOptionMasters::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "MediaFiles -> ";
        MediaFiles::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "ProductReviews -> ";
        ProductReviews::factory(50)->create();
        echo " END ".PHP_EOL;

        echo "ProductBadgeMasters -> ";
        ProductBadgeMasters::factory(20)->create();
        echo " END ".PHP_EOL;

        echo "ProductBadges -> ";
        ProductBadges::factory(5)->create();
        echo " END ".PHP_EOL;

        echo "ProductImages -> ";
        ProductImages::factory(50)->create();
        echo " END ".PHP_EOL;

        return 0;
    }
}
