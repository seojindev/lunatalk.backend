<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use Illuminate\Http\Request;
use App\Services\Front\ProductsService;

class AdminController extends RootController
{
    protected ProductsService $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function blank()
    {
        return view('admin/v1/pages/blank');
    }

    public function dashboard()
    {

        $pageData = [
            'pages' => [
                'pageStep' => 'dashboard',
                'pageTitle' => '대시보드'
            ]
        ];

        return view('admin/v1/pages/dashboard', $pageData);
    }
}
