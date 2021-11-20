<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Http\Controllers\Controller;
use App\Http\Services\AdminProductServices;
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
     * 상품 카테고리 추가.
     * @return mixed
     * @throws ClientErrorException
     */
    public function createProductCategory()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminProductServices->createProductCategotry());
    }

    /**
     * 상품 카테고리 상세.
     * @param string $productCategoryUUID
     * @return mixed
     */
    public function detailProductCategory(string $productCategoryUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->detailProductCategory($productCategoryUUID));
    }

    /**
     * 상품 카테고리 수정.
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
     * 상품 카테고리 삭제 - 단건.
     * @param string $productCategoryUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteProductCategory(string $productCategoryUUID)
    {
        $this->adminProductServices->deleteProductCategory($productCategoryUUID);
        return Response::success_only_message(200);
    }

    /**
     * 상품 카테고리 삭제.
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteProductCategories()
    {
        $this->adminProductServices->deleteProductCategories();
        return Response::success_only_message(200);
    }

    /**
     * 상품 카테고리 리스트.
     * @return mixed
     * @throws ServiceErrorException
     */
    public function showProductCategory()
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->showProductCategotry());
    }

    /**
     * 상품 추가.
     * @return mixed
     * @throws ClientErrorException
     */
    public function createProduct()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminProductServices->createProduct());
    }

    /**
     * 상품 정보 업데이트
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
     * 상품 삭제 - 단건.
     * @param string $productUUID
     * @return mixed
     */
    public function deleteProduct(string $productUUID)
    {
        $this->adminProductServices->deleteProduct($productUUID);
        return Response::success_only_message(200);
    }

    /**
     * 상품 삭제.
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteProducts()
    {
        $this->adminProductServices->deleteProducts();
        return Response::success_only_message(200);
    }

    /**
     * 상품 리스트.
     * @return mixed
     * @throws ServiceErrorException
     */
    public function showProduct()
    {
        return Response::success($this->adminProductServices->defaultShowProduct());
    }

    /**
     * 상품 상세.
     * @param string $productUUID
     * @return mixed
     */
    public function detailProduct(string $productUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->detailProduct($productUUID));
    }

    /**
     * 상품 리뷰 리스트.
     * @return mixed
     * @throws ServiceErrorException
     */
    public function showProductReviews() {
        return Response::success($this->adminProductServices->showProductReviews());
    }

    /**
     * 상품 리뷰 상세.
     * @param $id
     * @return mixed
     * @throws ServiceErrorException
     */
    public function detailProductReviews($id) {
        return Response::success($this->adminProductServices->detailProductReviews($id));
    }

    /**
     * 상품 리뷰 답변 등록.
     * @param $id
     * @return mixed
     * @throws ClientErrorException
     * @throws ServiceErrorException
     */
    public function answerProductReview($id) {
        $this->adminProductServices->answerProductReview($id);
        return Response::success_only_message(201);
    }
}
