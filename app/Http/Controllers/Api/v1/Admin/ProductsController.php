<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Exceptions\ClientErrorException;
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
     * 삼품 등록.
     * @param Request $request
     * @return mixed
     * @throws ClientErrorException
     */
    public function create(Request $request) {

        $this->productsService->productCreate($request);

        return Response::success_only_message();
    }

    /**
     * @param Request $request
     * @param String $product_uuid
     * @return mixed
     */
    public function update(Request $request, String $product_uuid) {

        $this->productsService->productUpdate($request, $product_uuid);

        return Response::success_only_message();
    }
}
