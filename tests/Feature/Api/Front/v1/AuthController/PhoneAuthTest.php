<?php

namespace Tests\Feature\Api\Front\v1\AuthController;

use App\Exceptions\ClientErrorException;
use App\Models\PhoneVerifies;
use App\Models\UserPhoneVerify;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class PhoneAuthTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/front/v1/auth/phone-number/phone-auth";
    }

    // 전화 번호 없이 요청.
    public function test_front_v1_phone_auth_전화_번호_없이_요청()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', str_replace('phone-number', '', $this->apiURL));
    }

    // 정상적인 전화 번호가 아닐때.
    public function test_front_v1_phone_auth_정상적인_전화_번호가_아닐때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth.numeric'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', str_replace('phone-number', 'asdasdasd', $this->apiURL));
    }

    // 정상적인 전화 번호 자리수 아닐때 요청.
    public function test_front_v1_phone_auth_정상적인_전화_번호_자리수_아닐때()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth.minmax'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', str_replace('phone-number', '0101234123456', $this->apiURL));
    }

    // 정상 요청.
    public function test_front_v1_phone_auth_정상_요청()
    {
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('GET', str_replace('phone-number', '01012341234', $this->apiURL))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    "phone_number",
                    "auth_index",
                    "auth_code"
                ]
            ]);

        // 테스트 인증 삭제.
        PhoneVerifies::whereNull('user_id')->forcedelete();
    }
}
