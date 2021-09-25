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

    public function detailMainSlide(string $mainSlideUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminPageManageServices->detailMainSlide($mainSlideUUID));
    }

    public function updateMainSlide(string $mainSlideUUID)
    {
        $this->adminPageManageServices->updateMainSlide($mainSlideUUID);
        return Response::success_only_message(200);
    }

    public function deleteMainSlide()
    {
        $this->adminPageManageServices->deleteMainSlides();
        return Response::success_only_message(200);
    }
}
