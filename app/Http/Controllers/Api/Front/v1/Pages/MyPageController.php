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
     * 마이 페이지 오더 에 필요한 정보.
     * @return mixed
     */
    public function myOrderInfo() {
        return Response::custom_success(200, __('default.response.process_success'), $this->authServices->getUserOrderInfo());
    }

    /**
     * 내 오더 리스트.
     * @return mixed
     */
    public function myOrder() {
        return Response::custom_success(200, __('default.response.process_success'), $this->frontPageServices->getUserOrder());
    }

    /**
     * 내 오더 상세
     * @param String $uuid
     * @return mixed
     */
    public function myOrderDetail(String $uuid) {
        return Response::custom_success(200, __('default.response.process_success'), $this->frontPageServices->myOrderDetail($uuid));
    }
}
