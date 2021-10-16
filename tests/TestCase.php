<?php

namespace Tests;

use App\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:wipe',['-vvv' => true]);
        $this->artisan('migrate:fresh',['-vvv' => true]);
        $this->artisan('db:seed',['-vvv' => true]);
        $this->artisan('passport:install',['-vvv' => true]);

        $this->app[Kernel::class]->setArtisan(null);

        /**
         * Exception 테스트시 에러 방지.
         */
        $this->withoutExceptionHandling();
    }
}
