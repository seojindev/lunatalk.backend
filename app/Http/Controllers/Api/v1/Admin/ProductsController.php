<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\RootController;
use App\Services\Api\MediaServices;
use App\Services\Api\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductsController extends RootController
{
    protected ProductsService $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function create(Request $request) {

        $this->productsService->productCreate($request);

        Response::success_only_message();
    }
}
