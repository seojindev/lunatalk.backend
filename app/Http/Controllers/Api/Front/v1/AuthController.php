<?php

namespace App\Http\Controllers\Api\Front\v1;

use App\Exceptions\ClientErrorException;
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
     * @throws ClientErrorException
     */
    public function phoneAuth(string $phoneNumber)
    {
        return Response::success($this->authServices->getPhoneAuthCode($phoneNumber));
    }

    /**
     * @throws ClientErrorException
     */
    public function phoneAuthConfirm(Int $authIndex)
    {
        !$authIndex ?? $authIndex = 0;

        return Response::success($this->authServices->phoneAuthConfirm($authIndex));
    }

    /**
     * @throws ClientErrorException
     */
    public function register()
    {
        return Response::custom_success(201, __('register.register_success'), $this->authServices->attemptRegister());
    }

    /**
     * @throws ClientErrorException
     */
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
