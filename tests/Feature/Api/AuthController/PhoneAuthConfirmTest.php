<?php

namespace Tests\Feature\Api\AuthController;

use App\Exceptions\ClientErrorException;
use App\Models\UserPhoneVerify;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class PhoneAuthConfirmTest extends BaseCustomTestCase
{
    // 정상 라우터 체크
    public function test_phone_auth_confirm_라우터_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth//phone-auth-confirm');
    }

    // 존재 하지 않은 auth index 요청.
    public function test_phone_auth_confirm_존재_하지_않은_auth_index_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        // TODO 테스트 코드 작성.
        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth/1111111111111111111111111111111111111/phone-auth-confirm');
    }

    // 이미 인증 받은 auth index 요청.
    public function test_phone_auth_confirm_이미_인증_받은_auth_index_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth_confirm.verified'));

        $randTask = UserPhoneVerify::select('id')->whereNull('verified_at')->inRandomOrder()->first();
        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth/'.$randTask->id.'/phone-auth-confirm');
    }

    // 인증 코드 누락 요청.
    public function test_phone_auth_confirm_인증_코드_누락_요청()
    {
        $testBody = '{
            "auth_code": ""
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth_confirm.required'));

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth/1/phone-auth-confirm', json_decode($testBody, true));
    }

    // 인증 코드 비교 에러 요청.
    public function test_phone_auth_confirm_인증_코드가_다른_요청()
    {
        $testBody = '{
            "auth_code": "1111"
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.register.phone_auth_confirm.auth_code_fail'));

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth/1/phone-auth-confirm', json_decode($testBody, true));
    }

    // 정상 요청.
    public function test_phone_auth_confirm_정상_요청()
    {
        $testBody = '{
            "auth_code": "1111"
        }';

        $this->withHeaders($this->getTestAccessTokenHeader())->json('POST', '/api/v1/auth/1/phone-auth-confirm', json_decode($testBody, true))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'phone_number',
                    'auth_index',
                    'auth_code'
                ]
            ]);
    }


}
