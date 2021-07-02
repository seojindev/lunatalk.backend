<?php

namespace App\Http\Controllers\Api\v1\Pages;

use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\Api\ProductsService;

/**
 * Class TabsController
 * @package App\Http\Controllers\Api\v1\Pages
 */
class TabsController extends RootController
{
    /**
     * @var ProductsService
     */
    protected ProductsService $productsService;

    /**
     * TabsController constructor.
     * @param ProductsService $productsService
     */
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * 메인 상단 이미지.
     * @return mixed
     */
    public function mainTop()
    {
        return Response::success($this->productsService->tabMainTopItems());
    }

    /**
     * 메인 카테고리 상품.
     * @return mixed
     */
    public function mainProductsCategory()
    {
        return Response::success($this->productsService->tabMainProductsCategoryItems());
    }

    /**
     * 메인 Best Item.
     * @return mixed
     */
    public function mainProductsBestItems()
    {
        return Response::success($this->productsService->tabMainProductsBestItems());
    }

    /**
     * 메인 Hot Item.
     * @return mixed
     */
    public function mainProductsHotItems()
    {
        return Response::success($this->productsService->tabMainProductsHotItems());
    }
}
