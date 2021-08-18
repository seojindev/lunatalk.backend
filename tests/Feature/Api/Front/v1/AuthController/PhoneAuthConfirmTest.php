<?php

namespace Tests\Feature\Api\Front\v1\AuthController;

use App\Exceptions\ClientErrorException;
use App\Models\PhoneVerifies;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\BaseCustomTestCase;

class PhoneAuthConfirmTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/front/v1/auth/authIndex/phone-auth-confirm";
    }


// 정상 라우터 체크
    public function test_front_v1_phone_auth_confirm_라우터_에러()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', '', $this->apiURL));
    }

    // 존재 하지 않은 auth index 요청.
    public function test_front_v1_phone_auth_confirm_존재_하지_않은_auth_index_요청()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', '999999', $this->apiURL));
    }

    // 이미 인증 받은 auth index 요청.
    public function test_front_v1_phone_auth_confirm_이미_인증_받은_auth_index_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth_confirm.auth_code_fail_verified'));

        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $randTask->id, $this->apiURL));
    }

    // 인증 코드 누락 요청.
    public function test_front_v1_phone_auth_confirm_인증_코드_누락_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $testPayload = '{
            "auth_code": ""
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth_confirm.required'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $auth_index, $this->apiURL), json_decode($testPayload, true));
    }

    public function test_front_v1_phone_auth_confirm_인증_코드_잘못된_자리수_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $testPayload = '{
            "auth_code": "11"
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth_confirm.auth_code_fail'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $auth_index, $this->apiURL), json_decode($testPayload, true));
    }

    // 잘못된 인증 코드 요청.
    public function test_front_v1_phone_auth_confirm_잘못된_인증_코드_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $testPayload = '{
            "auth_code": "asdasdasdasd"
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth_confirm.auth_code_compare_fail'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $auth_index, $this->apiURL), json_decode($testPayload, true));
    }

    // 인증 코드 비교 에러 요청.
    public function test_front_v1_phone_auth_confirm_인증_코드가_다른_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $testPayload = '{
            "auth_code": "0000"
        }';

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.phone_auth_confirm.auth_code_compare_fail'));

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $auth_index, $this->apiURL), json_decode($testPayload, true));
    }

    // 정상 요청.
    public function test_front_v1_phone_auth_confirm_정상_요청()
    {
        $randTask = PhoneVerifies::select()->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select()->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $testPayload = '{
            "auth_code": "'.$randTask->auth_code.'"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', str_replace('authIndex', $auth_index, $this->apiURL), json_decode($testPayload, true))
//            ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'auth_index',
                    'phone_number'
                ]
            ]);
    }
}
