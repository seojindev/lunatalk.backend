<?php


namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ServerErrorException;
use stdClass;

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
}
