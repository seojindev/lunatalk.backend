<?php

namespace Tests\Feature\Api\Admin\v1\AuthController;

use Illuminate\Auth\AuthenticationException;
use Tests\BaseCustomTestCase;

class LogoutTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/admin-front/v1/auth/logout";
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_v1_auth_logout_로그인_하지_않은_상태_요청()
    {
        $this->expectException(AuthenticationException::class);

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('DELETE', $this->apiURL);
    }

    public function test_admin_v1_auth_logout_정상_요청()
    {
        $this->withHeaders($this->getTestNormalAccessTokenHeader())->json('DELETE', $this->apiURL)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
