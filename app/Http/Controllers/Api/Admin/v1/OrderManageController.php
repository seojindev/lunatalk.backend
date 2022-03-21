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

    /**
     * 주문 상품 상태 변경.
     * @param String $uuid
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function changeDelivery(String $uuid) {
        $this->adminOrderManageServices->changeDelivery($uuid);
        return Response::message_success(__('default.response.process_success'));
    }

    /**
     * 주문 메모 수정.
     * @param String $uuid
     * @return mixed
     * @throws \App\Exceptions\ClientErrorException
     */
    public function orderMemo(String $uuid) {
        $this->adminOrderManageServices->changeMemo($uuid);
        return Response::message_success(__('default.response.process_success'));
    }
}
