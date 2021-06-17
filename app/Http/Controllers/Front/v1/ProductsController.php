<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Controller;
use App\Services\FrontRootServices;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected FrontRootServices $frontRootServices;

    public function __construct(FrontRootServices $frontRootServices)
    {
        $this->frontRootServices = $frontRootServices;
    }

    public function list()
    {
        $pageData = [
            'pages' => [
                'pageStep' => 'products',
                'pageTitle' => '상품 리스트'
            ]
        ];

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
                'pageTitle' => '상품 등록'
            ],
            'pageOption' => [
                'dropzone' => true
            ],
            'commonData' => [
                'code' => $this->frontRootServices->getCommonCode()
            ]
        ];

        return view('admin/v1/pages/products/product-add', $pageData);
    }
}
