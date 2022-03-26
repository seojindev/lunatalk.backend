<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Controller;
use App\Http\Services\FrontPageServices;
use App\Http\Services\OrderServices;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * @var FrontPageServices
     */
    protected FrontPageServices $frontPageServices;

    protected OrderServices $orderServices;

    /**
     * @param FrontPageServices $frontPageServices
     * @param OrderServices $orderServices
     */
    function __construct(FrontPageServices $frontPageServices, OrderServices $orderServices) {
        $this->frontPageServices = $frontPageServices;
        $this->orderServices = $orderServices;
    }

    /**
     * 메인 상품 카테고리 리스트.
     * @param String $category
     * @return mixed
     */
    public function productCategoryList(String $category) {

        return Response::success($this->frontPageServices->productCategoryList($category));
    }

    /**
     * 상품 오더.
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function productOrder() {
        return Response::custom_success(201, __('default.response.process_success'), $this->orderServices->productNewOrder());
    }
}
