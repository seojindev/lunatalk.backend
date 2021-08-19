<?php

namespace App\Services;

use App\Supports\PassportTrait;
use App\Exceptions\ClientErrorException;
use App\Repositories\UserRegisterSelectsRepositoryInterface;
use App\Repositories\PhoneVerifyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Crypt;
use Hash;
use Helper;
use Str;

class AuthServices
{
    use PassportTrait {
        PassportTrait::newToken as PassportTraitNewToken;
    }

    protected Request $currentRequest;
    protected UserRepositoryInterface $userRepository;
    protected PhoneVerifyRepositoryInterface $phoneVerifyRepository;
    protected UserRegisterSelectsRepositoryInterface $userRegisterSelectsRepository;

    function __construct(Request $request, UserRepositoryInterface $userRepository, PhoneVerifyRepositoryInterface $phoneVerifyRepository, UserRegisterSelectsRepositoryInterface $userRegisterSelectsRepository)
    {
        $this->currentRequest = $request;
        $this->userRepository = $userRepository;
        $this->phoneVerifyRepository = $phoneVerifyRepository;
        $this->userRegisterSelectsRepository = $userRegisterSelectsRepository;
    }

    /**
     * @throws ClientErrorException
     */
    public function getPhoneAuthCode(string $phoneNumber) : array
    {
        $validator = Validator::make(['phone_number' => $phoneNumber], [
            'phone_number' => 'required|numeric|digits_between:8,11'
        ],
            [
                'phone_number.required' => __('register.phone_auth.required'),
                'phone_number.min' => __('register.phone_auth.minmax'),
                'phone_number.digits_between' => __('register.phone_auth.minmax'),
                'phone_number.numeric' => __('register.phone_auth.numeric'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $authCode = Helper::generateAuthNumberCode();

        $task = $this->phoneVerifyRepository->create([
            'phone_number' => Crypt::encryptString($phoneNumber),
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
            'phone_number' => $phoneNumber,
            'auth_index' => $task->id,
            'auth_code' => $authCode
        ];
    }

    public function phoneAuthConfirm(Int $authIndex) : array
    {
        $task = $this->phoneVerifyRepository->defaultFindById($authIndex);

        if($task->verified === 'Y') {
            throw new ClientErrorException(__('register.phone_auth_confirm.auth_code_fail_verified'));
        }

        $validator = Validator::make($this->currentRequest->all(), [
            'auth_code' => 'required|string|min:4'
        ],
            [
                'auth_code.required' => __('register.phone_auth_confirm.required'),
                'auth_code.string' => __('register.phone_auth_confirm.auth_code_fail'),
                'auth_code.min' => __('register.phone_auth_confirm.auth_code_fail'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        if($this->currentRequest->input('auth_code') !== $task->auth_code) {
            throw new ClientErrorException(__('register.phone_auth_confirm.auth_code_compare_fail'));
        }

        $this->phoneVerifyRepository->update($authIndex, [
            'verified' => 'Y'
        ]);

        return [
            'auth_index' => $task->id,
            'phone_number' => Crypt::decryptString($task->phone_number),
        ];
    }

    public function attemptRegister() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'auth_id' => 'required|exists:phone_verifies,id',
            'user_id' => 'required|between:5,20|regex:/^[a-z]/i|regex:/(^[A-Za-z0-9 ]+$)+/|unique:users,login_id',
            'user_password' => 'required|between:5,20',
            'user_password_confirm' => 'required|same:user_password|between:5,20',
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email',
            'user_select_email' => 'required|in:Y,N|max:1',
            'user_select_message' => 'required|in:Y,N|max:1'

        ],
            [
                'auth_id.required' => __('register.attempt.required.auth_id'),
                'auth_id.exists' => __('register.attempt.auth_code.exists'),
                'user_id.required' => __('register.attempt.required.user_id'),
                'user_id.between' => __('register.attempt.user_id.check'),
                'user_id.regex' => __('register.attempt.user_id.check'),
                'user_id.unique' => __('register.attempt.user_id.unique'),
                'user_password.required' => __('register.attempt.required.user_password'),
                'user_password_confirm.required' => __('register.attempt.required.user_password_confirm'),
                'user_password.between' => __('register.attempt.password.check'),
                'user_password_confirm.same' => __('register.attempt.required.user_password_same'),
                'user_name.required' => __('register.attempt.required.user_name'),
                'user_email.required' => __('register.attempt.required.user_email'),
                'user_email.email' => __('register.attempt.email.check'),
                'user_email.unique' => __('register.attempt.email.unique'),
                'user_select_email.required'=> __('register.attempt.select_email.required'),
                'user_select_email.in'=> __('register.attempt.select_email.in'),
                'user_select_message.required'=> __('register.attempt.select_message.required'),
                'user_select_message.in'=> __('register.attempt.select_message.in'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $authTask = $this->phoneVerifyRepository->defaultFindById($this->currentRequest->input('auth_id'));

        /**
         * 인증 받지 않은 auth index 인지.
         */
        if($authTask->verified === 'N') {
            throw new ClientErrorException(__('register.attempt.auth_code.yet_verified'));
        }

        /**
         * 이미 회원 가입 까지 진행 된 auth index 인지.
         */
        if(!empty($authTask->user_id)) {
            throw new ClientErrorException(__('register.attempt.auth_code.verified'));
        }

        // 금지 아이디 체크.
        if(Helper::checkProhibitLoginId($this->currentRequest->input('user_id'))) {
            throw new ClientErrorException(__('register.attempt.prohibit_user_id'));
        }

        // 닉네임 금지어 단어 체크
        if(Helper::checkProhibitWord($this->currentRequest->input('user_name'))) {
            throw new ClientErrorException(__('register.attempt.prohibit_user_name'));
        }

        // 닉네임 금지어 체크
        if(Helper::checkProhibitUserNickname($this->currentRequest->input('user_name'))) {
            throw new ClientErrorException(__('register.attempt.prohibit_user_name'));
        }

        // 각 코드들 때문에 웹 외엔 추가 수정 필요.
        $createTask = $this->userRepository->create([
            'uuid' => Str::uuid()->toString(),
            'type' => $this->currentRequest->header('request-client-type'),
            'level' => config('extract.default.user_level'),
            'status' => config('extract.default.user_status'),
            'login_id' => $this->currentRequest->input('user_id'),
            'name' => $this->currentRequest->input('user_name'),
            'email' => $this->currentRequest->input('user_email'),
            'password' => Hash::make($this->currentRequest->input('user_password')),
        ]);

        $this->userRegisterSelectsRepository->create([
            'user_id' => $createTask->id,
            'email' => $this->currentRequest->input('user_select_email'),
            'message' => $this->currentRequest->input('user_select_message')
        ]);

        $this->phoneVerifyRepository->update($authTask->id, [
            'user_id' => $createTask->id
        ]);

        return [
            'id' => $createTask->id,
            'uuid' => $createTask->uuid,
            'login_id' => $createTask->login_id,
            'name' => $createTask->name,
            'type' => $createTask->type,
            'level' => $createTask->level,
            'status' => $createTask->status,
        ];
    }

    public function attemptLogin() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'login_id' => 'required|exists:users,login_id',
            'login_password' => 'required',
        ],
            [
                'login_id.required' => __('login.login_id_required'),
                'login_id.exists' => __('login.login_id_exists'),
                'login_password.required' => __('login.password_required'),
            ]);

        if( $validator->fails() ) {
            // 로그인 실패.
            throw new ClientErrorException($validator->errors()->first());
        }

        if(!Auth::attempt(['login_id' => $this->currentRequest->input('login_id'), 'password' => $this->currentRequest->input('login_password')])) {
            // 비밀번호 실패.
            throw new ClientErrorException(__('login.password_fail'));
        }

        // 차단 상태 체크
        $userTask = $this->userRepository->defaultCustomFind('login_id', $this->currentRequest->input('login_id'));
        if($userTask->status == config('extract.user_status.block.code')) {
            throw new ClientErrorException(__('login.block_user'));
        }

        $tokenRequestResult = $this->PassportTraitNewToken($this->currentRequest->input('login_id'), $this->currentRequest->input('login_password'));

        return [
            'access_token' => $tokenRequestResult->access_token,
            'refresh_token' => $tokenRequestResult->refresh_token
        ];
    }
}
