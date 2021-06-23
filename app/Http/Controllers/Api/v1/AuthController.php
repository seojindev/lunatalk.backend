<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use App\Services\Api\AuthServices;
use Illuminate\Support\Facades\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api\v1
 */
class AuthController extends RootController
{
    /**
     * @var AuthServices
     */
    protected AuthServices $AuthServices;

    /**
     * AuthController constructor.
     * @param AuthServices $authServices
     */
    public function __construct(AuthServices $authServices)
    {
        $this->AuthServices = $authServices;
    }

    /**
     * 공통 로그인.
     * @return mixed
     * @throws ServerErrorException
     * @throws ServiceErrorException
     */
    public function login()
    {
        $task = $this->AuthServices->attemptLogin();

        return Response::message_success(__('message.login.login_success'), $task);
    }

    /**
     * 공통 로그아웃.
     * @return mixed
     */
    public function logout()
    {
        return Response::success_only_message();
    }

    /**
     * 휴대폰 인증 요청.
     * @param Request $request
     * @return mixed
     * @throws ClientErrorException
     */
    public function phone_auth(Request $request)
    {
        return Response::message_success(__('message.other.send_phone_auth_code'), $this->AuthServices->phoneAuth());
    }

    /**
     * 휴대폰 인증코드 확인.
     * @param Int $auth_index
     * @param Request $request
     * @return mixed
     * @throws ClientErrorException
     */
    public function phone_auth_confirm(Int $auth_index, Request $request)
    {
        return Response::message_success(__('message.other.success_phone_auth_code'), $this->AuthServices->phoneAuthConfirm($auth_index));
    }

    /**
     * 회원 가입.
     * @return mixed
     * @throws ClientErrorException
     */
    public function register()
    {
        return Response::custom_success(201, __('message.register.register_success'), $this->AuthServices->attemptRegister());
    }
}
