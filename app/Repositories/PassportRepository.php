<?php


namespace App\Repositories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ServerErrorException;
use stdClass;

/**
 * Class PassportRepository
 * @package App\Repositories
 */
class PassportRepository implements PassportRepositoryInterface
{
    protected $client;

    public function __construct() {
        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
    }

    /**
     * @throws ServerErrorException
     */
    public function clientInfo() : object
    {
        /**
         * Passport 클라이언트 오류.
         */
        if($this->client == null) {
            /**
             * Passport 클라이언트 정보(id, secret)을 가지고 오지 못할떄
             */
            throw new ServerErrorException(__('message.exception.PassportClient'));
        }

        $returnObj = new stdClass();

        // FIXME: id 경고
        $returnObj->client_id = $this->client->id;
        $returnObj->client_secret = $this->client->secret;

        return $returnObj;
    }

    /**
     * @param String $login_id
     * @param String $login_password
     * @return object
     * @throws ServerErrorException
     */
    public function newToken(String $login_id, String $login_password) : object
    {
        $clientInfo = $this->clientInfo();

        $payloadObject = [
            'grant_type' => 'password',
            'client_id' => $clientInfo->client_id,
            'client_secret' => $clientInfo->client_secret,
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
     * @throws Exception
     */
    public function tokenRefesh(String $refresh_token) : object
    {
        $clientInfo = $this->clientInfo();

        $payloadObject = [
            'grant_type' => 'refresh_token',
            'client_id' => $clientInfo->client_id,
            'client_secret' => $clientInfo->client_secret,
            'refresh_token' => $refresh_token,
            'scope' => '',
        ];

        $tokenRequest = Request::create('/oauth/token', 'POST', $payloadObject);
        $tokenRequestResult = json_decode(app()->handle($tokenRequest)->getContent());

        if(isset($tokenRequestResult->message) && $tokenRequestResult->message) {
            throw new ServerErrorException(__('message.token.required_refresh_token_fail'));
        }

        return $tokenRequestResult;
    }
}
