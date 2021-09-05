<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use App\Services\AdminProductServices;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    protected AdminProductServices $adminProductServices;

    function __construct(AdminProductServices $adminProductServices)
    {
        $this->adminProductServices = $adminProductServices;
    }

    public function create_product_category()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminProductServices->createProduct());
    }

    public function update_product_category(string $productUUID)
    {
        $this->adminProductServices->updateProduct($productUUID);
        return Response::success_only_message(200);
    }

    public function delete_product_category(string $productUUID)
    {
        $this->adminProductServices->deleteProduct($productUUID);
        return Response::success_only_message(200);
    }

    public function show_product_category()
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminProductServices->showProduct());
    }
}
