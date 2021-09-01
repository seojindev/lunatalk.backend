<?php

namespace App\Http\Controllers\Api\admin\v1;

use App\Http\Controllers\Api\RootController;
use App\Services\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends RootController
{
    /**
     * @var AuthServices
     */
    protected AuthServices $authServices;

    /**
     * @param AuthServices $authServices
     */
    function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function login()
    {
        return Response::success($this->authServices->attemptAdminLogin());
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return Response::message_success($this->authServices->attemptAdminLogout());
    }
}
