<?php

namespace Tests\Unit;

use App\Exceptions\ClientErrorException;
use Tests\BaseCustomTestCase;

class BaseTest extends BaseCustomTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * 마이그레이션 시드 체크
     *
     * @return void
     */
    public function test_base_server_migrate()
    {
        $this->assertDatabaseHas('codes', [
            'code_id' => config('extract.default.front_code'),
        ]);
    }

    /**
     * 클라이언트 코드 없을때
     */
    public function test_base_server_exception_클라이언트_코드없을때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.exception.ClientTypeError'));

        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('GET', '/api/system/check-status')->assertStatus(412);
    }

    /**
     * front 클라이언트 코드 체크
     */
    public function test_base_server_exception_front_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.front_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * ios 클라이언트 코드 체크
     */
    public function test_base_server_exception_ios_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.ios_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * android 클라이언트 코드 체크
     */
    public function test_base_server_exception_android_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.android_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }

    /**
     * service admin 클라이언트 코드 체크
     */
    public function test_base_server_exception_service_front_클라이언트()
    {
        $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Request-Client-Type' => config('extract.default.service_front_code'),
        ])->json('GET', '/api/system/check-status')->assertNoContent();
    }
}
