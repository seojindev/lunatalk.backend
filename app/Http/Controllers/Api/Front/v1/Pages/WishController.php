<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Api\RootController;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Services\FrontPageServices;

class WishController extends RootController
{
    /**
     * @var FrontPageServices
     */
    protected FrontPageServices $frontPageServices;

    /**
     * @param FrontPageServices $frontPageServices
     */
    function __construct(FrontPageServices $frontPageServices) {
        $this->frontPageServices = $frontPageServices;
    }

    /**
     * 위시 리스트 등록.
     * @param $product_uuid
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function create($product_uuid) {
        $this->frontPageServices->createWishList($product_uuid);
        return Response::success_only_message();
    }

    public function list() {
    }

    public function delete($wish_uuid) {
    }

    public function manyDelete() {
    }
}
