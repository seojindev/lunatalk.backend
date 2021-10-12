<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Api\RootController;
use App\Http\Services\FrontPageServices;
use Illuminate\Support\Facades\Response;

class MainController extends RootController
{
    protected FrontPageServices $frontPageServices;

    function __construct(FrontPageServices $frontPageServices)
    {
        $this->frontPageServices = $frontPageServices;
    }

    public function mainSlide() {
        return Response::success($this->frontPageServices->mainSlide());
    }

    public function mainProductCategory() {

    }

    public function mainBestItem() {

    }

    public function mainNewItem() {

    }

    public function mainNotice() {

    }
}
