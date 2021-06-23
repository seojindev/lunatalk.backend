<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PassportRepository;
use App\Repositories\AuthRepository;
use Helper;
use Illuminate\Support\Str;

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

        // 차단 상태 체크
        $userTask = $this->authRepository->findUserByLoginId($request->input('login_id'));
        if($userTask->user_state == config('extract.user.user_state.block.code')) {
            throw new ServiceErrorException(__('message.login.block_user'));
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

    /**
     * 회원 가입 처리.
     * @return array
     * @throws ClientErrorException
     */
    public function attemptRegister() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'auth_id' => 'required|exists:users_phone_verify,id',
            'user_id' => 'required|between:5,20|regex:/^[a-z]/i|regex:/(^[A-Za-z0-9 ]+$)+/|unique:users,login_id',
            'user_password' => 'required|between:5,20',
            'user_password_confirm' => 'required|same:user_password|between:5,20',
            'user_nickname' => 'required',
            'user_email' => 'required|email|unique:users,email',
            ],
            [
                'auth_id.required' => __('message.register.attempt.required.auth_id'),
                'auth_id.exists' => __('message.register.attempt.auth_code.exists'),
                'user_id.required' => __('message.register.attempt.required.user_id'),
                'user_id.between' => __('message.register.attempt.user_id.check'),
                'user_id.regex' => __('message.register.attempt.user_id.check'),
                'user_id.unique' => __('message.register.attempt.user_id.unique'),
                'user_password.required' => __('message.register.attempt.required.user_password'),
                'user_password_confirm.required' => __('message.register.attempt.required.user_password_confirm'),
                'user_password.between' => __('message.register.attempt.password.check'),
                'user_password_confirm.same' => __('message.register.attempt.required.user_password_same'),
                'user_nickname.required' => __('message.register.attempt.required.user_nickname'),
                'user_email.required' => __('message.register.attempt.required.user_email'),
                'user_email.email' => __('message.register.attempt.email.check'),
                'user_email.unique' => __('message.register.attempt.email.unique'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $authTask = $this->authRepository->findUserPhoneVerify($this->currentRequest->input('auth_id'));

        /**
         * 인증 받지 않은 auth index 인지.
         */
        if($authTask->verified === 'N') {
            throw new ClientErrorException(__('message.register.attempt.auth_code.yet_verified'));
        }

        /**
         * 이미 회원 가입 까지 진행 된 auth index 인지.
         */
        if(!empty($authTask->user_id)) {
            throw new ClientErrorException(__('message.register.attempt.auth_code.verified'));
        }

        // 금지 아이디 체크.
        if(Helper::checkProhibitLoginId($this->currentRequest->input('user_id'))) {
            throw new ClientErrorException(__('message.register.attempt.prohibit_user_id'));
        }

        // 닉네임 금지어 단어 체크
        if(Helper::checkProhibitWord($this->currentRequest->input('user_nickname'))) {
            throw new ClientErrorException(__('message.register.attempt.prohibit_user_nickname'));
        }

        // 닉네임 금지어 체크
        if(Helper::checkProhibitUserNickname($this->currentRequest->input('user_nickname'))) {
            throw new ClientErrorException(__('message.register.attempt.prohibit_user_nickname'));
        }


        // 각 코드들 때문에 웹 외엔 추가 수정 필요.
        $createTask = $this->authRepository->createUser([
            'user_uuid' => Str::uuid()->toString(),
            'user_type' => config('extract.clientType.front.code'),
            'user_level' => config('extract.user.user_level.user.level_code'),
            'user_state' => config('extract.user.user_state.normal.code'),
            'login_id' => $this->currentRequest->input('user_id'),
            'nickname' => $this->currentRequest->input('user_nickname'),
            'email' => $this->currentRequest->input('user_email'),
            'password' => Hash::make($this->currentRequest->input('user_password')),
            'phone_number' => Hash::make(Crypt::decryptString($authTask->phone_number))
        ]);

        $this->authRepository->updateUserPhoneVerifyUserId($authTask->id, $createTask->id);

        return [
            'id' => $createTask->id,
            'user_uuid' => $createTask->user_uuid,
            'login_id' => $createTask->login_id,
            'name' => $createTask->nickname,
            'user_type' => $createTask->user_type,
            'user_level' => $createTask->user_level,
            'user_state' => $createTask->user_state,
        ];
    }
}
