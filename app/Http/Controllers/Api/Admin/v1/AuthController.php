<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use App\Http\Controllers\Api\RootController;
use App\Services\AuthServices;
use Illuminate\Auth\AuthenticationException;
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
     * @throws ClientErrorException
     * @throws AuthenticationException|ServerErrorException
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
