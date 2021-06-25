<?php

namespace Tests\Feature\Api\Admin\ServiceController;

use App\Exceptions\ClientErrorException;
use Tests\BaseCustomTestCase;

class ServiceNoticeTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    //  공지사항_문구_없이_요청.
    public function test_admin_service_notice_서비스_공지사항_문구_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.required.notice_message'));

        $testPayload = '{
                "notice_message": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/admin/service/service-notice', json_decode($testPayload, true));
    }

    //  공지사항_정상_요청.
    public function test_admin_service_notice_서비스_공지사항_정상_요청()
    {
        $testPayload = '{
                "notice_message": "테스트 공지 사항 입니다."
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/admin/service/service-notice', json_decode($testPayload, true))
        ->assertStatus(201)
        ->assertJsonStructure([
            'message'
        ]);

        $response = $this->withHeaders($this->getTestApiHeaders())->json('GET', '/api/system/check-notice');
        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'result' => [
                'notice'
            ]
        ])->assertJsonFragment([
            'notice' => '테스트 공지 사항 입니다.'
        ]);
    }

    //  시스템 공지사항 삭제 요청.
    public function test_admin_service_notice_시스템_공지사항_삭제_요청()
    {
        $this->withHeaders($this->getTestApiHeaders())->json('DELETE', '/api/v1/admin/service/service-notice')
            ->assertStatus(202)
            ->assertJsonStructure([
                'message'
            ]);

        $this->withHeaders(self::getTestApiHeaders())->json('GET', '/api/system/check-notice')->assertStatus(204);
    }
}
