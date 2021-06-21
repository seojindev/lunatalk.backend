<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();

        $this->artisan('migrate',['-vvv' => true]);
        $this->artisan('passport:install',['-vvv' => true]);
        $this->artisan('db:seed',['-vvv' => true]);

        /**
         * Exception 테스트시 에러 방지.
         */
        $this->withoutExceptionHandling();
    }
}
