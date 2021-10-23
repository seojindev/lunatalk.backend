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

    public function mainProductCategory() {
        return Response::success($this->frontPageServices->mainProductCategory());
    }

    public function mainBestItem() {
        return Response::success($this->frontPageServices->mainBestProductItem());
    }

    public function mainNewItem() {
        return Response::success($this->frontPageServices->mainNewProductItem());
    }

    public function mainNotice() {

    }
}
