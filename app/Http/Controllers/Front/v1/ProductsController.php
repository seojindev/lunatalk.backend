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
        $pageData = [
            'pages' => [
                'pageStep' => 'products',
            ]
        ];

        print_r($this->productsService->makeProductsList());

        return view('admin/v1/pages/products/product-list', $pageData);
    }

    public function view()
    {
        return view('admin/v1/pages/products/product-list');
    }

    public function add()
    {
        $pageData = [
            'pages' => [
                'pageStep' => 'products',
            ],
            'code_list' => $this->frontRootServices->getCommonCode(),
        ];

        return view('admin/v1/pages/products/product-add', $pageData);
    }
}
