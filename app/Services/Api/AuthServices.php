<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Exceptions\ServerErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PassportRepository;
use App\Repositories\AuthRepository;
use Helper;

class AuthServices
{
    protected Request $currentRequest;

    protected PassportRepository $passportRepository;
    protected AuthRepository $authRepository;

    function __construct(Request $request, PassportRepository $passportRepository, AuthRepository $authRepository){
        $this->currentRequest = $request;
        $this->passportRepository = $passportRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * @throws ServerErrorException
     * @throws ServiceErrorException
     */
    public function attemptLogin() : array
    {
        $request = $this->currentRequest;

        $validator = Validator::make($request->all(), [
                'login_name' => 'required|exists:users,login_name',
                'login_password' => 'required',
            ],
            [
                'login_name.required' => __('message.login.login_name_required'),
                'login_name.exists' => __('message.login.login_name_exists'),
                'login_password.required' => __('message.login.password_required'),
            ]);

        if( $validator->fails() ) {
            // 로그인 실패.
            throw new ServiceErrorException($validator->errors()->first());
        }

        if(!Auth::attempt(['login_name' => $request->input('login_name'), 'password' => $request->input('login_password')])) {
            // 비밀번호 실패.
            throw new ServiceErrorException(__('message.login.password_fail'));
        }

        return $this->publishNewToken();
    }

    /**
     * @throws ServerErrorException
     * @throws ServerErrorException
     */
    public function publishNewToken() : array
    {
        $client = $this->passportRepository->clientInfo();

        $payloadObject = [
            'grant_type' => 'password',
            'client_id' => $client->client_id,
            'client_secret' => $client->client_secret,
            'username' => $this->currentRequest->input('login_name'),
            'password' => $this->currentRequest->input('login_password'),
            'scope' => '',
        ];

        $tokenRequest = Request::create('/oauth/token', 'POST', $payloadObject);
        $tokenRequestResult = json_decode(app()->handle($tokenRequest)->getContent());

        if(isset($tokenRequestResult->message) && $tokenRequestResult->message) {
            throw new ServerErrorException($tokenRequestResult->message);
        }

        return [
            'access_token' => $tokenRequestResult->access_token,
            'refresh_token' => $tokenRequestResult->refresh_token
        ];
    }

    public function phoneAuth() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'phone_number' => 'required|numeric|digits_between:8,11'
        ],
            [
                'phone_number.required' => __('message.register.phone_auth.required'),
                'phone_number.min' => __('message.register.phone_auth.minmax'),
                'phone_number.digits_between' => __('message.register.phone_auth.minmax'),
                'phone_number.numeric' => __('message.register.phone_auth.numeric'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $authCode = Helper::generateAuthNumberCode();

        $task = $this->authRepository->createUserPhoneVerify([
            'user_id' => 1,
            'phone_number' => $this->currentRequest->input('phone_number'),
            'auth_code' => $authCode
        ]);

        return [
            'phone_number' => $this->currentRequest->input('phone_number'),
            'auth_index' => $task->id,
            'auth_code' => $authCode
        ];
    }

    public function phoneAuthConfirm(int $auth_index)
    {

    }

}
