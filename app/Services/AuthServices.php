<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Repositories\UserPhoneVerifyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Crypt;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthServices
{
    protected Request $currentRequest;
    protected UserRepositoryInterface $userRepository;
    protected UserPhoneVerifyRepositoryInterface $userPhoneVerifyRepository;

    function __construct(Request $request, UserRepositoryInterface $userRepository, UserPhoneVerifyRepositoryInterface $userPhoneVerifyRepository)
    {
        $this->currentRequest = $request;
        $this->userRepository = $userRepository;
        $this->userPhoneVerifyRepository = $userPhoneVerifyRepository;
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

        $task = $this->userPhoneVerifyRepository->create([
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
        $task = $this->userPhoneVerifyRepository->defaultFindById($authIndex);

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

        $this->userPhoneVerifyRepository->update($authIndex, [
            'verified' => 'Y'
        ]);

        return [
            'auth_index' => $task->id,
            'phone_number' => Crypt::decryptString($task->phone_number),
        ];
    }
}
