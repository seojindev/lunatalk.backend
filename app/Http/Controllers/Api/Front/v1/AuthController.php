<?php

namespace App\Http\Controllers\Api\Front\v1;

use App\Http\Controllers\Api\RootController;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends RootController
{
    protected AuthServices $authServices;

    function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function phoneAuth(string $phoneNumber)
    {
        return Response::success($this->authServices->getPhoneAuthCode($phoneNumber));
    }

    public function phoneAuthConfirm(Int $authIndex)
    {
        !$authIndex ?? $authIndex = 0;

        return Response::success($this->authServices->phoneAuthConfirm($authIndex));
    }

    public function register()
    {
        return Response::custom_success(201, __('register.register_success'), $this->authServices->attemptRegister());
    }

    public function login()
    {
        return Response::success($this->authServices->attemptLogin());
    }

    public function logout()
    {
        return Response::message_success($this->authServices->attemptLogout());
    }

    public function tokenInfo()
    {
        return Response::success($this->authServices->getTokenInfo());
    }
}
