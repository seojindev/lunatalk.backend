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

//        print_r($task);

//        return Response::success_only_data($task);
        return Response::success($task);

    }
}
