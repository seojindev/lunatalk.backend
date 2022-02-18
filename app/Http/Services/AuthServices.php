<?php

namespace App\Http\Services;

use App\Exceptions\ServerErrorException;
use App\Models\User;
use App\Supports\PassportTrait;
use App\Exceptions\ClientErrorException;
use App\Http\Repositories\Interfaces\UserRegisterSelectsRepositoryInterface;
use App\Http\Repositories\Interfaces\PhoneVerifyRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\Eloquent\CodesRepository;
use App\Http\Repositories\Eloquent\UserAddressRepository;
use App\Http\Repositories\Eloquent\OrderMastersRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
    protected CodesRepository $codesRepository;
    protected UserAddressRepository $userAddressRepository;
    protected OrderMastersRepository $orderMastersRepository;

    function __construct(
        Request $request,
        UserRepositoryInterface $userRepository,
        PhoneVerifyRepositoryInterface $phoneVerifyRepository,
        UserRegisterSelectsRepositoryInterface $userRegisterSelectsRepository,
        CodesRepository $codesRepository,
        UserAddressRepository $userAddressRepository,
        OrderMastersRepository $orderMastersRepository
    )
    {
        $this->currentRequest = $request;
        $this->userRepository = $userRepository;
        $this->phoneVerifyRepository = $phoneVerifyRepository;
        $this->userRegisterSelectsRepository = $userRegisterSelectsRepository;
        $this->codesRepository = $codesRepository;
        $this->userAddressRepository = $userAddressRepository;
        $this->orderMastersRepository = $orderMastersRepository;
    }

    /**
     * 로그인 확인.
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function loginValidator() {
        return Validator::make($this->currentRequest->all(), [
            'login_id' => 'required|exists:users,login_id',
            'login_password' => 'required',
        ],
            [
                'login_id.required' => __('login.login_id_required'),
                'login_id.exists' => __('login.login_id_exists'),
                'login_password.required' => __('login.password_required'),
            ]);
    }

    /**
     * 휴대폰 인증 코드 생성.
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
            'uuid' => Str::uuid(),
            'phone_number' => Crypt::encryptString($phoneNumber),
            'auth_code' => $authCode
        ]);

        $message = "[lunatalk.co.kr] 회원가입 인증번호 : " . $authCode;
        $response = Http::withHeaders(
            [
                'X-Secret-Key' => env('SMS_SECRET_KEY'),
                'Content-Type' => 'application/json;charset=UTF-8'
            ]
        )->post('https://api-sms.cloud.toast.com/sms/v3.0/appKeys/'.env('SMS_API_KEY').'/sender/auth/sms',
            [
                'body' => $message,
                'sendNo' =>'01092153192',
                'recipientList' => [array('recipientNo' => $phoneNumber, 'countryCode' => '82')]
            ]);
        if($response->json()['header']['isSuccessful'] == false) {
            throw new ClientErrorException(__('register.phone_auth_confirm.message_server_error'));
        }

        if(env('APP_ENV') == "production") {
            return [
                'uuid' => Str::uuid(),
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

    /**
     * 휴대폰 인증 코드 확인.
     * @param Int $authIndex
     * @return array
     * @throws ClientErrorException
     */
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

    /**
     * 회원 가입 시도.
     * @return array
     * @throws ClientErrorException
     */
    public function attemptRegister() : array
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'auth_index' => 'required|exists:phone_verifies,id',
            'user_id' => 'required|between:5,20|regex:/^[a-z]/i|regex:/(^[A-Za-z0-9 ]+$)+/|unique:users,login_id',
            'user_password' => 'required|between:5,20',
            'user_password_confirm' => 'required|same:user_password|between:5,20',
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email',
            'user_select_email' => 'required|in:Y,N|max:1',
            'user_select_message' => 'required|in:Y,N|max:1'

        ],
            [
                'auth_index.required' => __('register.attempt.required.auth_index'),
                'auth_index.exists' => __('register.attempt.auth_code.exists'),
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

        $authTask = $this->phoneVerifyRepository->defaultFindById($this->currentRequest->input('auth_index'));

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

    /**
     * 로그인 시도.
     * @return array
     * @throws ClientErrorException|ServerErrorException
     */
    public function attemptLogin() : array
    {
        $validator = $this->loginValidator();

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

    /**
     * 로그아웃.
     * @return string
     */
    public function attemptLogout() : string
    {
        Auth::user()->token()->revoke();

        return "정상 처리 하였습니다.";
    }

    /**
     * 토큰 사용자 정보.
     * @return User|null
     */
    public function getTokenInfo(): ?User
    {
        return Auth::user();
    }

    /**
     * 어드민용 로그인
     * @return array
     * @throws AuthenticationException
     * @throws ClientErrorException|ServerErrorException
     */
    public function attemptAdminLogin() : array
    {
        $validator = $this->loginValidator();

        if( $validator->fails() ) {
            // 로그인 실패.
            throw new ClientErrorException($validator->errors()->first());
        }

        if(!Auth::attempt(['login_id' => $this->currentRequest->input('login_id'), 'password' => $this->currentRequest->input('login_password')])) {
            // 비밀번호 실패.
            throw new ClientErrorException(__('login.password_fail'));
        }

        if(!(
            Auth::attempt(['login_id' => $this->currentRequest->input('login_id'), 'password' => $this->currentRequest->input('login_password'), 'level' => config('extract.user_level.admin.level_code')]) ||
            Auth::attempt(['login_id' => $this->currentRequest->input('login_id'), 'password' => $this->currentRequest->input('login_password'), 'level' => config('extract.user_level.root.level_code')])
        )) {
            // 비밀번호 실패.
            throw new AuthenticationException(__('login.only_admin'));
        }

        $tokenRequestResult = $this->PassportTraitNewToken($this->currentRequest->input('login_id'), $this->currentRequest->input('login_password'));

        return [
            'access_token' => $tokenRequestResult->access_token,
            'refresh_token' => $tokenRequestResult->refresh_token
        ];
    }

    /**
     * 어드민용 로그아웃.
     * @return string
     */
    public function attemptAdminLogout() : string
    {
        Auth::user()->token()->revoke();

        return "정상 처리 하였습니다.";
    }

    /**
     * 회원 정보 ( 기본 )
     * @return array
     */
    public function getUserInfo() : array {

        $user_id = Auth()->id();

        $userTask = $this->userRepository->getUserDetailById($user_id)->first()->toArray();

        $tmpEmail = explode('@', $userTask['email']);

        $emailStep1 = $tmpEmail[0];
        $emailStep2 = $tmpEmail[1];

        $taskEmail = $this->codesRepository->defaultCustomFind('code_name', $emailStep2, []);

        $phoneNumber = !empty($userTask['phone_verifies']['phone_number']) ? Crypt::decryptString($userTask['phone_verifies']['phone_number']) : null;
        if($phoneNumber) {
            $phoneArray = explode('-', Helper::formatPhone($phoneNumber));
        } else {
            $phoneArray = null;
        }

        return [
            'uuid' => $userTask['uuid'],
            'login_id' => $userTask['login_id'],
            'client' => [
                'code_id' => $userTask['client']['code_id'],
                'code_name' => $userTask['client']['code_name'],
            ],
            'type' => [
                'code_id' => $userTask['type']['code_id'],
                'code_name' => $userTask['type']['code_name'],
            ],
            'level' => [
                'code_id' => $userTask['level']['code_id'],
                'code_name' => $userTask['level']['code_name'],
            ],
            'status' => [
                'code_id' => $userTask['status']['code_id'],
                'code_name' => $userTask['status']['code_name'],
            ],
            'name' => $userTask['name'],
            'address' => [
                'zipcode' => $userTask['address'] ? $userTask['address']['zipcode'] : '',
                'step1' => $userTask['address'] ? $userTask['address']['step1'] : '',
                'step2' => $userTask['address'] ? $userTask['address']['step2'] : '',
            ],
            'email' => [
                'full_email' => $userTask['email'],
                'gubun1' => [
                    'step1' => $emailStep1,
                    'step2' => $emailStep2,
                ],
                'gubun2' => [
                    'step1' => $emailStep1,
                    'step2' => $taskEmail->code_id,
                ],
            ],
            'phone_number' => [
                'step1' => !empty($phoneArray[0]) ? $phoneArray[0] : null,
                'step2' => !empty($phoneArray[1]) ? $phoneArray[1] : null,
                'step3' => !empty($phoneArray[2]) ? $phoneArray[2] : null,
            ],
        ];
    }

    /**
     * 내정보
     * 오더 페이지 용.
     * @return array
     */
    public function getUserOrderInfo() : array {

        $user_id = Auth()->id();

        $userTask = $this->userRepository->getUserDetailById($user_id)->first()->toArray();

        $tmpEmail = explode('@', $userTask['email']);

        $emailStep1 = $tmpEmail[0];
        $emailStep2 = $tmpEmail[1];

        $taskEmail = $this->codesRepository->defaultCustomFind('code_name', $emailStep2, []);

        $phoneNumber = !empty($userTask['phone_verifies']['phone_number']) ? Crypt::decryptString($userTask['phone_verifies']['phone_number']) : null;
        if($phoneNumber) {
            $phoneArray = explode('-', Helper::formatPhone($phoneNumber));
        } else {
            $phoneArray = null;
        }

        /**
         * 주소 내려주는 기준
         * 1. 주문 정보중 성공한 주소가 있을경우 마지막 주문 주소.
         * 2. 내정보 주소
         * 3. 없는경우는 '';
         */
        $address_zipcode = $userTask['address'] ? $userTask['address']['zipcode'] : '';
        $address_step1 = $userTask['address'] ? $userTask['address']['step1'] : '';
        $address_step2 = $userTask['address'] ? $userTask['address']['step2'] : '';

        $orderAddressTask = $this->orderMastersRepository->getOrder($user_id);
        if(!$orderAddressTask->isEmpty()) {
            $orderAddress = $orderAddressTask->first()->toArray();

            $address_zipcode = $orderAddress['address'] ? $orderAddress['address']['zipcode'] : '';
            $address_step1 = $orderAddress['address'] ? $orderAddress['address']['step1'] : '';
            $address_step2 = $orderAddress['address'] ? $orderAddress['address']['step2'] : '';
        }

        return [
            'name' => $userTask['name'],
            'address' => [
                'zipcode' => $address_zipcode,
                'step1' => $address_step1,
                'step2' => $address_step2,
            ],
            'email' => [
                'full_email' => $userTask['email'],
                'gubun1' => [
                    'step1' => $emailStep1,
                    'step2' => $emailStep2,
                ],
                'gubun2' => [
                    'step1' => $emailStep1,
                    'step2' => $taskEmail->code_id,
                ],
            ],
            'phone_number' => [
                'step1' => !empty($phoneArray[0]) ? $phoneArray[0] : null,
                'step2' => !empty($phoneArray[1]) ? $phoneArray[1] : null,
                'step3' => !empty($phoneArray[2]) ? $phoneArray[2] : null,
            ],
        ];
    }

    /**
     * 내정보 수정.
     * @return void
     * @throws ClientErrorException
     */
    public function updateUserInfo() : void {
        $user_id = Auth()->id();

        if($this->currentRequest->input('auth_index')) {
            $validator = Validator::make($this->currentRequest->all(), [
                'auth_index' => 'exists:phone_verifies,id',

            ],
                [
                    'auth_index.exists' => __('register.attempt.auth_code.exists'),
                ]);

            if( $validator->fails() ) {
                throw new ClientErrorException($validator->errors()->first());
            }

            $authTask = $this->phoneVerifyRepository->defaultGetCustomFind('id', $this->currentRequest->input('auth_index'))->first();

            /**
             * 인증 받지 않은 auth index 인지.
             */
            if($authTask->verified === 'N') {
                throw new ClientErrorException(__('register.attempt.auth_code.yet_verified'));
            }

            $this->phoneVerifyRepository->update($authTask->id, [
                'user_id' => $user_id,
            ]);
        }

        if($this->currentRequest->input('password')) {
            $this->userRepository->updateUserDetailInfo($user_id, [
                'password' => Hash::make($this->currentRequest->input('password')),
            ]);
        }

        if($this->currentRequest->input('email')) {
            $validator = Validator::make($this->currentRequest->all(), [
                'email' => 'required|email',
            ],
                [
                    'email.email' => __('register.attempt.email.check'),
                ]);

            if( $validator->fails() ) {
                throw new ClientErrorException($validator->errors()->first());
            }

            $this->userRepository->updateUserDetailInfo($user_id, [
                'email' => $this->currentRequest->input('email'),
            ]);
        }

        if($this->currentRequest->input('zipcode') && $this->currentRequest->input('step1') && $this->currentRequest->input('step2')) {

            $addressTask = $this->userAddressRepository->defaultGetCustomFind('user_id', $user_id);

            if($addressTask->isEmpty()) {
                $this->userAddressRepository->create([
                    'user_id' => $user_id,
                    'zipcode' => $this->currentRequest->input('zipcode'),
                    'step1' => $this->currentRequest->input('step1'),
                    'step2' => $this->currentRequest->input('step2'),
                ]);
            } else {
                $this->userAddressRepository->update($addressTask->first()->id, [
                    'zipcode' => $this->currentRequest->input('zipcode'),
                    'step1' => $this->currentRequest->input('step1'),
                    'step2' => $this->currentRequest->input('step2'),
                ]);
            }
        }
    }
}
