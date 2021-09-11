<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use App\Services\AdminProductServices;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * @var AdminProductServices
     */
    protected AdminProductServices $adminProductServices;

    /**
     * @param AdminProductServices $adminProductServices
     */
    function __construct(AdminProductServices $adminProductServices)
    {
        $this->adminProductServices = $adminProductServices;
    }

    /**
     * @return mixed
     * @throws ClientErrorException
     */
    public function createProductCategory()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminProductServices->createProductCategotry());
    }

    /**
     * @param string $productCategoryUUID
     * @return mixed
     */
    public function detailProductCategory(string $productCategoryUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->detailProductCategory($productCategoryUUID));
    }

    /**
     * @param string $productCategoryUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function updateProductCategory(string $productCategoryUUID)
    {
        $this->adminProductServices->updateProductCategotry($productCategoryUUID);
        return Response::success_only_message(200);
    }

    /**
     * @param string $productCategoryUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteProductCategory(string $productCategoryUUID)
    {
        $this->adminProductServices->deleteProductCategotry($productCategoryUUID);
        return Response::success_only_message(200);
    }

    /**
     * @return mixed
     */
    public function showProductCategory()
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->showProductCategotry());
    }

    /**
     * @return mixed
     * @throws ClientErrorException
     */
    public function createProduct()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminProductServices->createProduct());
    }

    /**
     * @param string $productUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function updateProduct(string $productUUID)
    {
        $this->adminProductServices->updateProduct($productUUID);
        return Response::success_only_message(200);
    }

    /**
     * @param string $productUUID
     * @return mixed
     */
    public function deleteProduct(string $productUUID)
    {
        $this->adminProductServices->deleteProduct($productUUID);
        return Response::success_only_message(200);
    }

    /**
     * @param Int $Page
     * @return mixed
     */
    public function showProduct(Int $Page)
    {
        return Response::success($this->adminProductServices->defaultShowProduct($Page));
    }

    /**
     * @param string $productUUID
     * @return mixed
     */
    public function detailProduct(string $productUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->detailProduct($productUUID));
    }
}
