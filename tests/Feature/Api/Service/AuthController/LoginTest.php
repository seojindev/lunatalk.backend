<?php

namespace Tests\Feature\Api\Service\AuthController;

use App\Exceptions\ServiceErrorException;
use App\Models\User;
use App\Models\UserPhoneVerify;
use Tests\BaseCustomTestCase;

class LoginTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // 아이디 없이 요청.
    public function test_service_login_아이디_없이_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.login_id_required'));

        $testPayload = '{
            "login_id": "",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true));
    }

    // 존재 하지 않은 사용자 요청.
    public function test_service_login_존재하지_않은_사용자_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.login_id_exists'));

        $testPayload = '{
            "login_id": "test2222",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true));
    }

    // 비밀번호 없이 요청.
    public function test_service_login_존재하는_사용자_이지만_비밀번호_없이_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.password_required'));

        $testPayload = '{
            "login_id": "test33",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true));
    }

    // 존재 하는 사용자 이지만 비밀번호 틀릴때.
    public function test_service_login_존재하는_사용자_이지만_다른_비밀번호_요청()
    {
        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.password_fail'));

        $testPayload = '{
            "login_id": "test33",
            "login_password": "1111"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true));
    }

    //  차단 상태 사용자 요청.
    public function test_service_login_차단_상태_사용자_요청()
    {

        $randTask = User::select()->where('user_level' , config('extract.user.user_level.user.level_code'))->first();
        User::where('id', $randTask->id)->update(['user_state' => config('extract.user.user_state.block.code')]);


        $this->expectException(ServiceErrorException::class);
        $this->expectExceptionMessage(__('message.login.block_user'));

        $testPayload = '{
            "login_id": "'.$randTask->login_id.'",
            "login_password": "password"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true));
    }

    // 성공.
    public function test_service_login_정상_요청()
    {
        $testPayload = '{
            "login_id": "test33",
            "login_password": "password"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/service/auth/login', json_decode($testPayload, true))
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
