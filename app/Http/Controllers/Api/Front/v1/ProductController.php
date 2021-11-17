<?php

namespace App\Http\Controllers\Api\Front\v1;

use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProductServices;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    protected ProductServices $productServices;

    function __construct(ProductServices $productServices) {
        $this->productServices = $productServices;
    }

    /**
     * 상품 전체 상세 리스트.
     * @throws ServiceErrorException
     */
    public function totalProducts() {
        return Response::success($this->productServices->productTotalList());
    }

    /**
     * 상품 상세 정보.
     * @param String $uuid
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function productDetail(String $uuid) {
        return Response::success($this->productServices->productDetail($uuid));
    }

    /**
     * 상품 검색 리스트.
     * @param String $search
     * @return mixed
     * @throws ServiceErrorException
     * @throws \App\Exceptions\ClientErrorException
     */
    public function productSearch(String $search) {
        return Response::success($this->productServices->productTotalSearchList($search));
    }
}
