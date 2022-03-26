<?php

namespace App\Http\Controllers\Api\Front\v1;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Http\Controllers\Api\RootController;
use App\Http\Services\AuthServices;
use Illuminate\Support\Facades\Response;

class AuthController extends RootController
{
    protected AuthServices $authServices;

    function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    /**
     * 휴대폰 인증.
     * @throws ClientErrorException
     */
    public function phoneAuth(string $phoneNumber)
    {
        return Response::success($this->authServices->getPhoneAuthCode($phoneNumber));
    }

    /**
     * 휴대폰 인증 확인.
     * @throws ClientErrorException
     */
    public function phoneAuthConfirm(Int $authIndex)
    {
        !$authIndex ?? $authIndex = 0;

        return Response::success($this->authServices->phoneAuthConfirm($authIndex));
    }

    /**
     * 회원 가입.
     * @throws ClientErrorException
     */
    public function register()
    {
        return Response::custom_success(201, __('register.register_success'), $this->authServices->attemptRegister());
    }

    /**
     * 로그인.
     * @throws ClientErrorException|ServerErrorException
     */
    public function login()
    {
        return Response::success($this->authServices->attemptLogin());
    }

    /**
     * 로그아웃.
     * @return mixed
     */
    public function logout()
    {
        return Response::message_success($this->authServices->attemptLogout());
    }

    /**
     * 토큰 사용자 정보(임시)
     * @return mixed
     */
    public function tokenInfo()
    {
        return Response::success($this->authServices->getTokenInfo());
    }


    /**
     * 아이디 찾기
     * @return mixed
     * @throws ClientErrorException
     */
    public function findId()
    {
        return Response::success($this->authServices->findId());
    }


    /**
     * 비밀번호 초기화
     * @return mixed
     * @throws ClientErrorException
     */
    public function resetPassword()
    {
        return Response::success($this->authServices->resetPassword());
    }
}
