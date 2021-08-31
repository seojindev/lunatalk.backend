<?php

namespace App\Supports;

use App\Exceptions\ServerErrorException;
use DB;
use Illuminate\Http\Request;
use stdClass;

trait PassportTrait
{
    /**
     * @return object
     * @throws ServerErrorException
     */
    public function clientInfo() : object
    {
        $client = DB::table('oauth_clients')->where('id', 2)->first();

        /**
         * Passport 클라이언트 오류.
         */
        if($client == null) {
            /**
             * Passport 클라이언트 정보(id, secret)을 가지고 오지 못할떄
             */
            throw new ServerErrorException(__('exception.PassportClient'));
        }

        $returnObj = new stdClass();

        $returnObj->client_id = $client->id;
        $returnObj->client_secret = $client->secret;

        return $returnObj;
    }

    /**
     * @param String $login_id
     * @param String $login_password
     * @return object
     * @throws ServerErrorException
     */
    public  function newToken(String $login_id, String $login_password) : object
    {
        $client = DB::table('oauth_clients')->where('id', 2)->first();

        $payloadObject = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $login_id,
            'password' => $login_password,
            'scope' => '',
        ];

        $tokenRequest = Request::create('/oauth/token', 'POST', $payloadObject);
        $tokenRequestResult = json_decode(app()->handle($tokenRequest)->getContent());

        if(isset($tokenRequestResult->message) && $tokenRequestResult->message) {
            throw new ServerErrorException($tokenRequestResult->message);
        }

        return $tokenRequestResult;
    }

    /**
     * @param String $refresh_token
     * @return object
     * @throws ServerErrorException
     */
    public function tokenRefesh(String $refresh_token) : object
    {
        $client = DB::table('oauth_clients')->where('id', 2)->first();

        $payloadObject = [
            'grant_type' => 'refresh_token',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'refresh_token' => $refresh_token,
            'scope' => '',
        ];

        $tokenRequest = Request::create('/oauth/token', 'POST', $payloadObject);
        $tokenRequestResult = json_decode(app()->handle($tokenRequest)->getContent());

        if(isset($tokenRequestResult->message) && $tokenRequestResult->message) {
            throw new ServerErrorException(__('token.required_refresh_token_fail'));
        }

        return $tokenRequestResult;
    }
}
