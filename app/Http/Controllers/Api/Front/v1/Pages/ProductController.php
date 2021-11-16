<?php

namespace App\Http\Controllers\Api\Front\v1\Pages;

use App\Http\Controllers\Controller;
use App\Http\Services\FrontPageServices;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
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
     * 메인 상품 카테고리 리스트.
     * @param String $category
     * @return mixed
     */
    public function productCategoryList(String $category) {

        return Response::success($this->frontPageServices->productCategoryList($category));
    }
}
