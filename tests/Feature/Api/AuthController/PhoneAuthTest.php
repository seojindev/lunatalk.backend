<?php

namespace Tests\Feature\Api\AuthController;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseCustomTestCase;

class PhoneAuthTest extends BaseCustomTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    // 전화 번호 없이 요청.
    public function test_phone_auth_전화_번호_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth.required'));

        $testPayload = '{
            "phone_number": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/phone-auth', json_decode($testPayload, true));
    }

    // 정상적인 전화 번호가 아닐때.
    public function test_phone_auth_정상적인_전화_번호가_아닐때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth.numeric'));

        $testPayload = '{
            "phone_number": "adsdasdasdasd"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/phone-auth', json_decode($testPayload, true));

        $testPayload = '{
            "phone_number": "010-1234-1233"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/phone-auth', json_decode($testPayload, true));
    }

    // 정상적인 전화 번호 자리수 아닐때 요청.
    public function test_phone_auth_정상적인_전화_번호_자리수_아닐때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth.minmax'));

        $testPayload = '{
            "phone_number": "0101234123456"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/phone-auth', json_decode($testPayload, true));
    }

    // 정상 요청.
    public function test_phone_auth_정상_요청()
    {
        $testPayload = '{
            "phone_number": "01012341234"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/phone-auth', json_decode($testPayload, true))
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                "phone_number",
                "auth_index",
                "auth_code"
            ]
        ]);
    }
}
