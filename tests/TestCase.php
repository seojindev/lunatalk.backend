<?php

namespace Tests;

use App\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

        if ($checkFailed) {

            $this->artisan('db:wipe',['-vvv' => true]);
            $this->artisan('migrate:fresh',['-vvv' => true]);
            $this->artisan('db:seed',['-vvv' => true]);
            $this->artisan('passport:install',['-vvv' => true]);

            $this->app[Kernel::class]->setArtisan(null);
        }

        /**
         * Exception 테스트시 에러 방지.
         */
        $this->withoutExceptionHandling();
    }
}
