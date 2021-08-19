<?php

namespace Tests\Feature\Api\Front\v1\AuthController;

use App\Exceptions\ClientErrorException;
use App\Models\PhoneVerifies;
use App\Models\User;
use Tests\BaseCustomTestCase;

class RegisterTest extends BaseCustomTestCase
{
    protected string $apiURL;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiURL = "/api/front/v1/auth/register";
    }

    //  인증코드 없이 요청.
    public function test_front_v1_auth_register_인증_index_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.auth_id'));

        $testPayload = '{
                "auth_id": "",
                "user_id": "",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  존재 하지 않은 인증코드 요청.
    public function test_front_v1_auth_register_존재_하지_않은_인증코드_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.auth_code.exists'));

        $testPayload = '{
                "auth_id": "111111",
                "user_id": "",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  휴대폰 인증하지 않은 상태로 요청.
    public function test_front_v1_auth_register_휴대폰_인증하지_않은_상태로_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['verified' => 'N']);
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.auth_code.yet_verified'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "aaaaaaaaa",
                "user_password": "password",
                "user_password_confirm": "password",
                "user_name": "테스트사용자",
                "user_email": "test@test.com"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  이미 인증이 끝난 인증 정보 요청.
    public function test_front_v1_auth_register_이미_인증이_끝난_인증_정보_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        if(!$randTask) {
            PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
            $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        }
        PhoneVerifies::where('id', $randTask->id)->update(['user_id' => 1]);
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.auth_code.verified'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "aaaaaaaaa",
                "user_password": "password",
                "user_password_confirm": "password",
                "user_name": "테스트사용자",
                "user_email": "test@test.com"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  아이디 없이 요청.
    public function test_front_v1_auth_register_아이디_없이_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_id'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }
    //  정확하지 않은 아이디 요청(길이?).
    public function test_front_v1_auth_register_정확하지_않은_아이디_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.user_id.check'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "t",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }
    //  이미 사용중인 아이디 요청.
    public function test_front_v1_auth_register_이미_사용중인_아이디_요청()
    {
        PhoneVerifies::where('id', '>', 0)->update(['verified' => 'Y']);
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $userTask = User::select()->where([['level' , config('extract.default.user_level')],['status' , config('extract.default.user_status')]])->inRandomOrder()->first();
        $test_login_id = $userTask->login_id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.user_id.unique'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "'.$test_login_id.'",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  사용할수 없는 아이디 요청.
    public function test_front_v1_auth_register_사용할수_없는_아이디_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        PhoneVerifies::where('id', $randTask->id)->update(['user_id' => null]);
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.prohibit_user_id'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "webmaster",
                "user_password": "password",
                "user_password_confirm": "password",
                "user_name": "테스트사용자",
                "user_email": "test@test.com"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  패스워드 없이 요청.
    public function test_front_v1_auth_register_패스워드_없이_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_password'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "testuser1",
                "user_password": "",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  패스워드 정확한(길이?)
    public function test_front_v1_auth_register_패스워드_정확한_체크()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.password.check'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "testuser1",
                "user_password": "pass",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  패스워드 확인 없이 요청.
    public function test_front_v1_auth_register_패스워드_확인_없이_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_password_confirm'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "testuser1",
                "user_password": "password",
                "user_password_confirm": "",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  패스워드와 패스워드가 다른 요청.
    public function test_front_v1_auth_register_패스워드와_패스워드가_다른_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_password_same'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "testuser1",
                "user_password": "password1",
                "user_password_confirm": "password2",
                "user_name": "",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  이름 없이 요청.
    public function test_front_v1_auth_register_이름_없이_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_name'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "test1111",
                "user_password": "asdfasdf",
                "user_password_confirm": "asdfasdf",
                "user_name": "",
                "user_email": "test@test.com"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  사용할수 없는 이름 요청.
    public function test_front_v1_auth_register_사용할수_없는_이름_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_email'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "test1111",
                "user_password": "asdfasdf",
                "user_password_confirm": "asdfasdf",
                "user_name": "어둠의계정",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  이메일 없이 요청.
    public function test_front_v1_auth_register_이메일_없이_요청_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.required.user_email'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "test1111",
                "user_password": "asdfasdf",
                "user_password_confirm": "asdfasdf",
                "user_name": "어둠의계정",
                "user_email": ""
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }
    //  정확하지 않은 이메일 요청.
    public function test_front_v1_auth_register_정확하지_않은_이메일_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.email.check'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "test1111",
                "user_password": "asdfasdf",
                "user_password_confirm": "asdfasdf",
                "user_name": "어둠의계정",
                "user_email": "test"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  중복 이메일 요청.
    public function test_front_v1_auth_register_중복_이메일_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $userTask = User::select()->where([['level' , config('extract.default.user_level')],['status' , config('extract.default.user_status')]])->inRandomOrder()->first();
        $test_email = $userTask->email;

        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('register.attempt.email.unique'));

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "test1111",
                "user_password": "asdfasdf",
                "user_password_confirm": "asdfasdf",
                "user_name": "어둠의계정",
                "user_email": "'.$test_email.'"
        }';

        $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
    }

    //  정상 요청.
    public function test_front_v1_auth_register_정상_요청()
    {
        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        PhoneVerifies::where('id', $randTask->id)->update(['user_id' => null]);
        $auth_index = $randTask->id;

        $randTask = PhoneVerifies::select('id')->where('verified' , 'Y')->inRandomOrder()->first();
        $auth_index = $randTask->id;

        $testPayload = '{
                "auth_id": "'.$auth_index.'",
                "user_id": "testuserid",
                "user_password": "password",
                "user_password_confirm": "password",
                "user_name": "어둠의계정",
                "user_email": "test1111@test.com"
        }';

        $response = $this->withHeaders($this->getTestDefaultApiHeaders())->json('POST', $this->apiURL, json_decode($testPayload, true));
        //            ->dump()
//        $createTask = User::select()->where('login_id' , 'testuserid')->first();

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'result' => [
                'id',
                'uuid',
                'login_id',
                'name',
                'type',
                'level',
                'status'
            ]
        ]);
        User::where('login_id', "testuserid")->forcedelete();

//        $response->assertJsonStructure([
//            'message',
//            'result' => [
//                'id' => $createTask->id,
//                'user_uuid' => $createTask->user_uuid,
//                'login_id' => $createTask->login_id,
//                'name' => $createTask->name,
//                'user_type' => $createTask->user_type,
//                'user_level' => $createTask->user_level,
//                'user_state'  => $createTask->user_state
//            ]
//        ]);
    }
}
