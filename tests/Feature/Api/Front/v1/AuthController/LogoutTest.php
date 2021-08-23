<?php

namespace Tests\Feature\Api\Front\v1\AuthController;

use App\Exceptions\ClientErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\BaseCustomTestCase;

class LogoutTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/front/v1/auth/logout";
        $this->insertTestUser();
    }

    // 로그인 없이 요청.
    public function test_front_v1_auth_logout_로그인_하지_않은_상태_요청()
    {
        $this->expectException(AuthenticationException::class);

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('DELETE', $this->apiURL);
    }

    // 정상 요청.
    public function test_front_v1_auth_logout_정상_요청()
    {
        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('DELETE', $this->apiURL)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);

        $this->deleteTestUser();
    }
}