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

}
