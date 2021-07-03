<?php

namespace App\Http\Controllers\Api\v1\Pages;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Support\Facades\Response;
use App\Services\Api\ProductsService;
use App\Services\Api\OtherServices;

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
     * @var OtherServices
     */
    protected OtherServices $otherServices;

    /**
     * TabsController constructor.
     * @param ProductsService $productsService
     * @param OtherServices $otherServices
     */
    public function __construct(ProductsService $productsService, OtherServices $otherServices)
    {
        $this->productsService = $productsService;
        $this->otherServices = $otherServices;
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

    /**
     * 홈 메인 탭 기록용.
     * @param String $click_code
     * @return mixed
     * @throws ClientErrorException
     */
    public function tab_click(String $click_code)
    {
        $this->otherServices->createHomeTabClick($click_code);
        return Response::success_no_content();
    }
}
