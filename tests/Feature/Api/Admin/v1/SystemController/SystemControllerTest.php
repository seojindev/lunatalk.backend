<?php

namespace Tests\Feature\Api\Admin\v1\SystemController;

use App\Models\ProductReviews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class SystemControllerTest extends BaseCustomTestCase
{
    public function setUp(): void {
        parent::setUp();

    }

    public function test_admin_front_v1_SystemController_시스템_공지사항_등록()
    {
        $payload = [
            'notice' => '금일 00시 서버 점검 예정 입니다.'
        ];
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('POST', "/api/admin-front/v1/system/notice", $payload);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_admin_front_v1_SystemController_시스템_공지사항_정보()
    {
        $response = $this->withHeaders($this->getTestAdminAccessTokenHeader())->json('GET', "/api/admin-front/v1/system/notice");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'result' => [
                "notice"
            ]
        ]);
    }
}
