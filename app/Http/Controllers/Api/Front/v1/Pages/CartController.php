<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Http\Services\FrontPageServices;

class CartController extends RootController
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
     * 장바구니 리스트 상품 등록.
     * @param $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function create($product_uuid) {
        $this->frontPageServices->createCartList($product_uuid);
        return Response::success_only_message();
    }

    /**
     * 장바구니 리스트.
     * @return mixed
     * @throws ClientErrorException
     */
    public function list() {
        return Response::custom_success(200, __('default.response.process_success'), $this->frontPageServices->cartList());
    }

    /**
     * 장바구니 상품 삭제 단건.
     * @param Int $cart_id
     * @return mixed
     */
    public function delete(Int $cart_id) {
        $this->frontPageServices->deleteCart($cart_id);
        return Response::success_only_message(200);
    }

    /**
     * 장바구니 상품 삭제 (복수)
     * @return mixed
     * @throws ClientErrorException
     */
    public function manyDelete() {
        $this->frontPageServices->deletesCart();
        return Response::success_only_message(200);
    }
}
