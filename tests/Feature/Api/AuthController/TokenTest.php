<?php

namespace Tests\Feature\Api\AuthController;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Exceptions\OAuthServerException;
use Tests\BaseCustomTestCase;

class TokenTest extends BaseCustomTestCase
{
    public function test_token_토큰_새로고침_refresh_token_없이_요청()
    {
        $this->expectException(ClientErrorException::class);
        $this->expectExceptionMessage(__('message.token.required_refresh_token'));

        $testPayload = '{
            "refresh_token": ""
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/token-refresh', json_decode($testPayload, true));
    }

    //  정상 refresh_token 아닐때 요청.
    public function test_token_정상_refresh_token이_아닐때_요청()
    {
        $this->expectException(OAuthServerException::class);
        $this->expectExceptionMessage('The refresh token is invalid.');

        $testPayload = '{
            "refresh_token": "1"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/token-refresh', json_decode($testPayload, true));
    }

    //  정성 토큰 리프래시.
    public function test_token_refresh_token_정상_요청()
    {
        $response = $this->withHeaders(self::getTestApiHeaders())->postjson('/api/v1/auth/login', [
            'login_id' => User::where('user_level',  config('extract.user.user_level.user.level_code'))->orderBy('id', 'ASC')->first()->login_id,
            'login_password' => 'password'
        ]);

        $testPayload = '{
            "refresh_token": "'.$response['result']['refresh_token'].'"
        }';

        $this->withHeaders($this->getTestApiHeaders())->json('POST', '/api/v1/auth/token-refresh', json_decode($testPayload, true))
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'result' => [
                    'access_token',
                    'refresh_token'
                ]
            ]);
    }
}
