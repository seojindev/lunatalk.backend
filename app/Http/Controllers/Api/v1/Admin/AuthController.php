<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Services\Front\AuthServices;

class AuthController extends RootController
{
    protected AuthServices $AuthServices;

    public function __construct(AuthServices $authServices)
    {
        $this->AuthServices = $authServices;
    }

    public function login()
    {
        $task = $this->AuthServices->attemptAdminLogin();
        return Response::success($task);

    }
}
