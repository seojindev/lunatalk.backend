<?php

namespace Tests;

use App\Console\Kernel;
use App\Models\MediaFiles;
use App\Models\PhoneVerifies;
use App\Models\ProductBadgeMasters;
use App\Models\ProductBadges;
use App\Models\ProductCategories;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptionMasters;
use App\Models\ProductReviews;
use App\Models\User;
use App\Models\UserRegisterSelects;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() : void
    {
        parent::setUp();

        /**
         * 로컬 mysql을 유닛 테스트 디비로 변경 하면서 마이그레이션 리프래쉬를 처음 한번만 적용하기 위해
         * migrations 파일 리스트와 migrations 테이블을 비교해서 하나라도 다를시에만 마이그레이션을 실행 시키기 위해 (꼼수로)
         */
        $checkFailed = false;

        foreach (File::allFiles(database_path('migrations')) as $file) {
            $filename = pathinfo($file)['filename'];
            if(!DB::table('migrations')->where([['migration', $filename], ['batch' , 1]])->exists()) {
                $checkFailed = true;
            }
        }

        if ($checkFailed)
        {

            $this->artisan('db:wipe',['-vvv' => true]);
            $this->artisan('migrate:fresh',['-vvv' => true]);
            $this->artisan('db:seed',['-vvv' => true]);
            $this->artisan('passport:install',['-vvv' => true]);

            $this->dbSeedHandle();

            $this->app[Kernel::class]->setArtisan(null);
        }

        /**
         * Exception 테스트시 에러 방지.
         */
        $this->withoutExceptionHandling();
    }

    protected function dbSeedHandle() : void
    {
        User::factory(2)->create();
        PhoneVerifies::factory(3)->create();
        UserRegisterSelects::factory(3)->create();
        ProductCategories::factory(5)->create();
        ProductMasters::factory(4)->create();
        ProductOptionMasters::factory(4)->create();
        MediaFiles::factory(16)->create();
        ProductReviews::factory(16)->create();
        ProductBadgeMasters::factory(2)->create();
        ProductBadges::factory(2)->create();
        ProductImages::factory(4)->create();
    }
}
