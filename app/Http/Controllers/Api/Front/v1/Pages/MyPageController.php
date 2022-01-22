<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Services\AuthServices;
use App\Http\Services\FrontPageServices;

class MyPageController extends Controller
{
    /**
     * @var AuthServices
     */
    protected AuthServices $authServices;

    /**
     * @var FrontPageServices
     */
    protected FrontPageServices $frontPageServices;

    /**
     * @param AuthServices $authServices
     * @param FrontPageServices $frontPageServices
     */
    function __construct(AuthServices $authServices, FrontPageServices $frontPageServices)
    {
        $this->authServices = $authServices;
        $this->frontPageServices = $frontPageServices;
    }

    /**
     * 회원 정보
     * @return mixed
     */
    public function myInfo() {
        return Response::custom_success(200, __('default.response.process_success'), $this->authServices->getUserInfo());
    }

    /**
     * 회원 정보 수정.
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function udpateMyInfo() {
        $this->authServices->updateUserInfo();
        return Response::success_only_message(200);
    }

    /**
     * @return mixed
     */
    public function myOrderInfo() {
        return Response::custom_success(200, __('default.response.process_success'), $this->authServices->getUserOrderInfo());
    }

    /**
     * @return mixed
     */
    public function myOrder() {
        return Response::custom_success(200, __('default.response.process_success'), $this->frontPageServices->getUserOrder());
    }
}
