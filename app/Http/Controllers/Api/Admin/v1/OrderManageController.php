<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AdminOrderManageServices;
use Illuminate\Support\Facades\Response;

class OrderManageController extends Controller
{
    /**
     * @var AdminOrderManageServices
     */
    protected AdminOrderManageServices $adminOrderManageServices;

    /**
     * @param AdminOrderManageServices $adminOrderManageServices
     */
    function __construct(AdminOrderManageServices $adminOrderManageServices)
    {
        $this->adminOrderManageServices = $adminOrderManageServices;
    }

    /**
     * 주문 리스트 ( 어드민 )
     * @return mixed
     */
    public function showOrder() {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminOrderManageServices->showOrder());
    }

    /**
     * 주문 상세 ( 어드민 )
     * @param String $uuid
     * @return mixed
     */
    public function showOrderDetail(String $uuid) {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminOrderManageServices->showOrderDetail($uuid));
    }

}
