<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use App\Http\Services\AdminPageManageServices;
use Illuminate\Support\Facades\Response;

class PageManageController extends Controller
{

    protected AdminPageManageServices $adminPageManageServices;

    function __construct(AdminPageManageServices $adminPageManageServices)
    {
        $this->adminPageManageServices = $adminPageManageServices;
    }

    /**
     * @return mixed
     * @throws ClientErrorException
     */
    public function createMainSlide()
    {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminPageManageServices->createMainSlide());
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\ServiceErrorException
     */
    public function showMainSlide()
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminPageManageServices->showMainSlide());
    }

    /**
     * @param string $mainSlideUUID
     * @return mixed
     */
    public function detailMainSlide(string $mainSlideUUID)
    {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminPageManageServices->detailMainSlide($mainSlideUUID));
    }

    /**
     * @param string $mainSlideUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function updateMainSlide(string $mainSlideUUID)
    {
        $this->adminPageManageServices->updateMainSlide($mainSlideUUID);
        return Response::success_only_message(200);
    }

    /**
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteMainSlide()
    {
        $this->adminPageManageServices->deleteMainSlides();
        return Response::success_only_message(200);
    }
}
