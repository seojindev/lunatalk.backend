<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use App\Services\Api\AuthServices;
use Illuminate\Support\Facades\Response;

class AuthController extends RootController
{
    protected AuthServices $AuthServices;

    public function __construct(AuthServices $authServices)
    {
        $this->AuthServices = $authServices;
    }

    public function login()
    {
        $task = $this->AuthServices->attemptLogin();

        return Response::message_success(__('message.login.login_success'), $task);
    }

    public function logout()
    {
        $task = $this->AuthServices->attemptLogout();

        return Response::success_only_message();
    }

    public function phone_auth(Request $request)
    {
        return Response::message_success(__('message.other.send_phone_auth_code'), $this->AuthServices->phoneAuth());
    }

    public function phone_auth_confirm(Int $auth_index, Request $request)
    {
        return Response::message_success(__('message.other.success_phone_auth_code'), $this->AuthServices->phoneAuthConfirm($auth_index));
    }
}
