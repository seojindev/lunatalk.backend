<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PassportRepository;
use App\Repositories\AuthRepository;
use Helper;

/**
 * Class AuthServices
 * @package App\Services\Api
 */
class AuthServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var PassportRepository
     */
    protected PassportRepository $passportRepository;

    /**
     * @var AuthRepository
     */
    protected AuthRepository $authRepository;

    /**
     * AuthServices constructor.
     * @param Request $request
     * @param PassportRepository $passportRepository
     * @param AuthRepository $authRepository
     */
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
     * @throws ServerErrorException
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

        if(isset($tokenRequestResult->message) && $tokenRequestResult->message) {
            throw new ServerErrorException($tokenRequestResult->message);
        }

        return [
            'access_token' => $tokenRequestResult->access_token,
            'refresh_token' => $tokenRequestResult->refresh_token
        ];
    }

    /**
     * 회원 가입 휴대폰 인증.
     * @return array
     * @throws ClientErrorException
     */
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
            'phone_number' => Crypt::encryptString($this->currentRequest->input('phone_number')),
            'auth_code' => $authCode
        ]);

        if(env('APP_ENV') == "production") {
            return [
                'phone_number' => $this->currentRequest->input('phone_number'),
                'auth_index' => $task->id
            ];
        }

        // 운영 버전이 아니면 인증코드도 같이.
        return [
            'phone_number' => $this->currentRequest->input('phone_number'),
            'auth_index' => $task->id,
            'auth_code' => $authCode
        ];
    }

    /**
     * 회원 가입 휴대폰 인증 확인.
     * @param Int $auth_index
     * @return array
     * @throws ClientErrorException
     */
    public function phoneAuthConfirm(Int $auth_index) : array
    {
        $task = $this->authRepository->findUserPhoneVerify($auth_index);

        if($task->verified === 'Y') {
            throw new ClientErrorException(__('message.register.phone_auth_confirm.auth_code_fail_verified'));
        }

        $validator = Validator::make($this->currentRequest->all(), [
            'auth_code' => 'required|string|min:4'
        ],
            [
                'auth_code.required' => __('message.register.phone_auth_confirm.required'),
                'auth_code.string' => __('message.register.phone_auth_confirm.auth_code_fail'),
                'auth_code.min' => __('message.register.phone_auth_confirm.auth_code_fail'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        if($this->currentRequest->input('auth_code') !== $task->auth_code) {
            throw new ClientErrorException(__('message.register.phone_auth_confirm.auth_code_compare_fail'));
        }

        $this->authRepository->updateUserPhoneVerifyVerified($auth_index, 'Y');

        return [
            'auth_index' => $task->id,
            'phone_number' => Crypt::decryptString($task->phone_number),
        ];
    }
}
