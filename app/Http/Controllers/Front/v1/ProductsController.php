<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function list()
    {

        $pageData = [
            'pages' => [
                'pageTitle' => '상품 리스트'
            ]
        ];


        return view('admin/v1/pages/products/product-list', $pageData);
    }

    public function view()
    {
        return view('admin/v1/pages/products/product-list');
    }
}
