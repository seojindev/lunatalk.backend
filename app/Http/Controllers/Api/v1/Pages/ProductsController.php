<?php

namespace App\Http\Controllers\Api\v1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\Api\ProductsService;

/**
 * Class ProductsController
 * @package App\Http\Controllers\Api\v1\Pages
 */
class ProductsController extends Controller
{
    /**
     * @var ProductsService
     */
    protected ProductsService $productsService;

    /**
     * ProductsController constructor.
     * @param ProductsService $productsService
     */
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * 상품 전체 페이지.
     * @param Int $page
     * @return mixed
     */
    public function total_list_paging(Int $page)
    {
        return Response::success($this->productsService->productsListPaging($page));
    }

    /**
     * 상품 상세 페이지.
     * @param String $product_uuid
     * @return mixed
     */
    public function detail(String $product_uuid)
    {
        return Response::success($this->productsService->productDetail($product_uuid));
    }
}
