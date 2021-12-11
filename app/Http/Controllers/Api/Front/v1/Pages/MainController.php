<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Api\RootController;
use App\Http\Services\FrontPageServices;
use Illuminate\Support\Facades\Response;

class MainController extends RootController
{
    /**
     * @var FrontPageServices
     */
    protected FrontPageServices $frontPageServices;

    /**
     * @param FrontPageServices $frontPageServices
     */
    function __construct(FrontPageServices $frontPageServices)
    {
        $this->frontPageServices = $frontPageServices;
    }

    /**
     * 메인 슬라이드 리스트.
     * @return mixed
     * @throws \App\Exceptions\ServerErrorException
     */
    public function mainSlide() {
        return Response::success($this->frontPageServices->mainSlide());
    }

    /**
     * 메인 상품 카테고리
     * @return mixed
     */
    public function mainProductCategory() {
        return Response::success($this->frontPageServices->mainProductCategory());
    }

    /**
     * 메인 베스트 아이템
     * @return mixed
     */
    public function mainBestItem() {
        return Response::success($this->frontPageServices->mainBestProductItem());
    }

    /**
     * 메인 뉴 아이템
     * @return mixed
     */
    public function mainNewItem() {
        return Response::success($this->frontPageServices->mainNewProductItem());
    }

    /**
     * 메인 공지 사항.
     * @return mixed
     */
    public function mainNotice() {
        return Response::success($this->frontPageServices->mainNoticeList());
    }

    /**
     * 공지 사항 상세.
     * @param String $uuid
     * @return mixed
     */
    public function noticeDetail(String $uuid) {
        return Response::success($this->frontPageServices->detailNotice($uuid));
    }
}
