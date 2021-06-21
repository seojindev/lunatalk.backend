<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Exceptions\ServerErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Support\Facades\Response;
use App\Services\Front\AuthServices;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api\v1\Admin
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
        return Response::success($this->AuthServices->attemptAdminLogin());
    }
}
