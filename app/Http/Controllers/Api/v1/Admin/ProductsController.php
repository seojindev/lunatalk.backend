<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Api\RootController;
use App\Services\Api\ProductsService;
use App\Services\Api\AdminServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class ProductsController
 * @package App\Http\Controllers\Api\v1\Admin
 */
class ProductsController extends RootController
{
    /**
     * @var ProductsService
     */
    protected ProductsService $productsService;

    /**
     * @var AdminServices
     */
    protected AdminServices $adminServices;

    /**
     * ProductsController constructor.
     * @param ProductsService $productsService
     * @param AdminServices $adminServices
     */
    public function __construct(ProductsService $productsService, AdminServices $adminServices)
    {
        $this->productsService = $productsService;
        $this->adminServices = $adminServices;
    }

    /**
     * 삼품 등록.
     * @param Request $request
     * @return mixed
     * @throws ClientErrorException
     */
    public function create(Request $request) {

        $this->productsService->productCreate($request);
        return Response::success_only_message();
    }

    /**
     * @param Request $request
     * @param String $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function update(Request $request, String $product_uuid) {

        $this->productsService->productUpdate($request, $product_uuid);
        return Response::success_only_message();
    }

    /**
     * 베스트 상품 추가.
     * @param String $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function addBestItem(String $product_uuid)
    {
        $this->adminServices->addProductBestItem($product_uuid);
        return Response::success_only_message();
    }

    /**
     * 베스트 상품 취소.
     * @param String $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteBestItem(String $product_uuid)
    {
        $this->adminServices->deleteProductBestItem($product_uuid);
        return Response::custom_success(202);
    }

    /**
     * 핫 아이템 추가.
     * @param String $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function addHotItem(String $product_uuid)
    {
        $this->adminServices->addProductHotItem($product_uuid);
        return Response::success_only_message();
    }

    /**
     * 핫 아이템 취소.
     * @param String $product_uuid
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteHotItem(String $product_uuid)
    {
        $this->adminServices->deleteProductHotItem($product_uuid);
        return Response::custom_success(202);
    }
}
