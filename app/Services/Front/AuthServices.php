<?php


namespace App\Services\Front;

use App\Exceptions\ServiceErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PassportRepository;

class AuthServices
{
    protected Request $currentRequest;

    protected PassportRepository $passportRepository;

    function __construct(Request $request, PassportRepository $passportRepository){
        $this->currentRequest = $request;
        $this->passportRepository = $passportRepository;
    }

    /**
     * @throws ServerErrorException
     * @throws ServiceErrorException
     */
    public function attemptAdminLogin() : array
    {
        $request = $this->currentRequest;

        $validator = Validator::make($request->all(), [
                'login_id' => 'required|exists:users,login_id',
                'login_password' => 'required',
            ],
            [
                'login_id.required' => __('message.login.login_id_required'),
                'login_id.exists' => __('message.login.login_id_exists'),
                'login_password.required' => __('message.login.password_required'),
            ]);

        if( $validator->fails() ) {
            // 로그인 실패.
            throw new ServiceErrorException($validator->errors()->first());
        }

        if(!Auth::attempt(['login_id' => $request->input('login_id'), 'password' => $request->input('login_password')])) {
            // 비밀번호 실패.
            throw new ServiceErrorException(__('message.login.password_fail'));
        }

        return $this->publishNewToken();
    }

    /**
     * @throws ServerErrorException
     * @throws ServiceErrorException
     */
    public function publishNewToken() : array
    {
        $client = $this->passportRepository->clientInfo();

        $payloadObject = [
            'grant_type' => 'password',
            'client_id' => $client->client_id,
            'client_secret' => $client->client_secret,
            'username' => $this->currentRequest->input('login_id'),
            'password' => $this->currentRequest->input('login_password'),
            'scope' => '',
        ];

        $tokenRequest = Request::create('/oauth/token', 'POST', $payloadObject);
        $tokenRequestResult = json_decode(app()->handle($tokenRequest)->getContent());

        if(isset($tokenRequestResult->error_message) && $tokenRequestResult->error_message) {
            throw new ServiceErrorException($tokenRequestResult->error_message);
        }

        return [
            'access_token' => $tokenRequestResult->access_token,
            'refresh_token' => $tokenRequestResult->refresh_token
        ];
    }
}
