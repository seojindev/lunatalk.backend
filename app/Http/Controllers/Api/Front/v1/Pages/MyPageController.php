<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\AuthServices;

class MyPageController extends Controller
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
     * 회원 정보
     * @return mixed
     */
    public function myInfo() {
        return Response::custom_success(200, __('default.response.process_success'), $this->authServices->getMyInfo());
    }
}
