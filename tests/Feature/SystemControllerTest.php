<?php

namespace Tests\Feature;

use Tests\BaseCustomTestCase;
use Illuminate\Support\Facades\Storage;

class SystemControllerTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * 공지사항 파일 없을때.
     * @return void
     */
    public function test_system_notice_not_exists()
    {
        Storage::disk('inside-temp')->delete('server_notice.txt');
        $this->withHeaders(self::getTestDefaultApiHeaders())->json('GET', '/api/system/check-notice')->assertStatus(204);
    }

    /**
     * 공지사항 파일은 있지만 내용은 없을때.
     * @return void
     */
    public function test_system_notice_not_exists_contents()
    {
        Storage::disk('inside-temp')->put('server_notice.txt', '');
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/system/check-notice');
        // $response->dump();
        $response->assertStatus(204);
    }

    /**
     * 공지사항 있을때.
     * @return void
     */
    public function test_system_notice_exists_contents()
    {
        $tmpNoticeMessage = '긴급 공지 사항 테스트입니다.';
        Storage::disk('inside-temp')->put('server_notice.txt', $tmpNoticeMessage);
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/system/check-notice');
        // $response->dump();
        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'result' => [
                'notice'
            ]
        ])->assertJsonFragment([
            "notice" => $tmpNoticeMessage
        ]);
        Storage::disk('inside-temp')->delete('server_notice.txt');
    }

    /**
     * 기본 데이터
     *
     * @return void
     */
    public function test_system_check_base_data() {
        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', '/api/system/base-data');
//         $response->dump();
        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'result'
        ]);
        $response->assertJsonStructure([
            'message',
            'result' => [
                "codes" => [
                    "code_name",
                    "code_group"
                ]
            ]
        ]);
    }
}
