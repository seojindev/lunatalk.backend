<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use App\Services\Front\ProductsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
//use Illuminate\Http\Request;

/**
 * Class ProductsController
 * @package App\Http\Controllers\Front\v1
 */
class ProductsController extends RootController
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
        parent::__construct();

        $this->productsService = $productsService;
    }

    /**
     * 상품 리스트 페이지.
     * @return Application|Factory|View
     */
    public function list()
    {
        return view('admin/v1/pages/products/product-list', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'products' => $this->productsService->makeProductsList()
        ]);
    }

    /**
     * 상품 상세 정보 페이지.
     * @param String $product_uuid
     * @return Application|Factory|View
     */
    public function detail(String $product_uuid)
    {
        return view('admin/v1/pages/products/product-detail', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'detail' => $this->productsService->detailProduct($product_uuid)
        ]);
    }

    /**
     * 상품 상세 페이지.
     * @param String $product_uuid
     * @return Application|Factory|View
     */
    public function update(String $product_uuid)
    {
        return view('admin/v1/pages/products/product-update', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'detail' => $this->productsService->detailProduct($product_uuid)
        ]);
    }

    /**
     * 상품 등록 페이지.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin/v1/pages/products/product-create', [
            'pages' => [
                'pageStep' => 'products',
            ],
        ]);
    }
}
