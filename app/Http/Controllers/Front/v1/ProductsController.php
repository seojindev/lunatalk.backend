<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Controller;
use App\Services\FrontRootServices;
use App\Services\Front\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected FrontRootServices $frontRootServices;
    protected ProductsService $productsService;

    public function __construct(FrontRootServices $frontRootServices, ProductsService $productsService)
    {
        $this->frontRootServices = $frontRootServices;
        $this->productsService = $productsService;
    }

    public function list()
    {
        return view('admin/v1/pages/products/product-list', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'products' => $this->productsService->makeProductsList()
        ]);
    }

    public function detail(String $product_uuid)
    {
        return view('admin/v1/pages/products/product-detail', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'detail' => $this->productsService->detailProduct($product_uuid)
        ]);
    }

    public function add()
    {
        return view('admin/v1/pages/products/product-add', [
            'pages' => [
                'pageStep' => 'products',
            ],
            'code_list' => $this->frontRootServices->getCommonCode(),
        ]);
    }
}
