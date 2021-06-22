<?php

namespace Tests\Feature\Api\AuthController;

use App\Exceptions\ServiceErrorException;
use Tests\BaseCustomTestCase;

class LoginTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // 아이디 없이 요청.
    public function test_login_아이디_없이_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.login_name_required'));

        $testBody = '{
            "login_name": "",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/login', json_decode($testBody, true));
    }

    // 존재 하지 않은 사용자 요청.
    public function test_login_존재하지_않은_사용자_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.login_name_exists'));

        $testBody = '{
            "login_name": "test2222",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/login', json_decode($testBody, true));
    }

    // 비밀번호 없이 요청.
    public function test_login_존재하는_사용자_이지만_비밀번호_없이_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.password_required'));

        $testBody = '{
            "login_name": "test1",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/login', json_decode($testBody, true));
    }

    // 존재 하는 사용자 이지만 비밀번호 틀릴때.
    public function test_login_존재하는_사용자_이지만_다른_비밀번호_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.password_fail'));

        $testBody = '{
            "login_name": "test1",
            "login_password": "1111"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/login', json_decode($testBody, true));
    }

    // 성공.
    public function test_login_정상_요청()
    {
        $testBody = '{
            "login_name": "test3",
            "login_password": "password"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/login', json_decode($testBody, true))
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'access_token',
                'refresh_token'
            ]
        ]);
    }
}
