<?php

namespace Tests\Feature\Api\Admin\v1\AuthController;

use App\Exceptions\ClientErrorException;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class LoginTest extends BaseCustomTestCase
{
    use WithFaker;

    protected string $apiURL;
    protected array $testUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/auth/login";

        // 테스트 사용자 입력.
        $this->testUser = $this->insertTestUser();
    }

    public function test_admin_v1_auth_login_아이디_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('login.login_id_required'));

        $testPayload = '{
            "login_id": "",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    // 존재 하지 않은 사용자 요청.
    public function test_admin_v1_auth_login_존재하지_않은_사용자_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('login.login_id_exists'));

        $testPayload = '{
            "login_id": "test2222",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    // 비밀번호 없이 요청.
    public function test_admin_v1_auth_login_존재하는_사용자_이지만_비밀번호_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('login.password_required'));

        $testPayload = '{
            "login_id": "'.$this->testUser['login_id'].'",
            "login_password": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    // 존재 하는 사용자 이지만 비밀번호 틀릴때.
    public function test_admin_v1_auth_login_존재하는_사용자_이지만_다른_비밀번호_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('login.password_fail'));

        $testPayload = '{
            "login_id": "'.$this->testUser['login_id'].'",
            "login_password": "1111"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    public function test_admin_v1_auth_login_관리자_권한_없는_사용자()
    {
        User::where('id', $this->testUser['id'])->update(['level' => config('extract.user_level.normal.level_code')]);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage(__('login.only_admin'));

        $testPayload = '{
            "login_id": "'.$this->testUser['login_id'].'",
            "login_password": "password"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    // 성공.
    public function test_admin_v1_auth_login_정상_요청()
    {
        User::where('id', $this->testUser['id'])->update(['level' => config('extract.user_level.admin.level_code')]);

        $testPayload = '{
            "login_id": "'.$this->testUser['login_id'].'",
            "login_password": "password"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'access_token',
                    'refresh_token'
                ]
            ]);


        $this->deleteTestUser();
    }
}
