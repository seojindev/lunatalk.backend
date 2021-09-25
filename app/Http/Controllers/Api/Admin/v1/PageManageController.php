<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use App\Services\AdminPageManageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PageManageController extends Controller
{
    protected AdminPageManageServices $adminPageManageServices;

    function __construct(AdminPageManageServices $adminPageManageServices)
    {
        $this->adminPageManageServices = $adminPageManageServices;
    }

        public function createMainSlide()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminPageManageServices->createMainSlide());
    }

    public function showMainSlide()
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminPageManageServices->showMainSlide());
    }

    public function detailMainSlide()
    {
        return Response::success_only_message(200);
    }

    public function updateMainSlide()
    {
        return Response::success_only_message(200);
    }

    public function deleteMainSlide()
    {
        return Response::success_only_message(200);
    }
}
