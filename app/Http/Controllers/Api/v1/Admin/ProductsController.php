<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Api\RootController;
use App\Services\Api\ProductsService;
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
     * ProductsController constructor.
     * @param ProductsService $productsService
     */
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * 삼충 등록.
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {

        $this->productsService->productCreate($request);

        return Response::success_only_message();
    }
}
