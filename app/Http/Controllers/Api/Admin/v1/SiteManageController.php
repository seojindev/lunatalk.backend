<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Services\AdminSiteManageServices;

class SiteManageController extends Controller
{
    /**
     * @var AdminSiteManageServices
     */
    protected AdminSiteManageServices $adminSiteManageServices;

    /**
     * @param AdminSiteManageServices $adminSiteManageServices
     */
    function __construct(AdminSiteManageServices $adminSiteManageServices) {
        $this->adminSiteManageServices = $adminSiteManageServices;
    }

    /**
     * 싸이트 공지 사항 추가.
     * @return mixed
     * @throws ClientErrorException
     */
    public function createNotice() {
        return Response::custom_success(201, __('default.response.process_success'), $this->adminSiteManageServices->noticeCreate());
    }

    /**
     * 싸이트 공지 사항 업데이트.
     * @param String $noticeUUID
     * @return mixed
     * @throws ClientErrorException
     */
    public function updateNotice(String $noticeUUID) {
        $this->adminSiteManageServices->noticeUpdate($noticeUUID);
        return Response::success_only_message(200);
    }

    /**
     * 싸이트 공지 사항 삭제.
     * @return mixed
     * @throws ClientErrorException
     */
    public function deleteNotice() {
        $this->adminSiteManageServices->noticeDelete();
        return Response::success_only_message(200);
    }

    /**
     * 상품 공지 사항 상세.
     * @param String $noticeUUID
     * @return mixed
     */
    public function detailNotice(String $noticeUUID) {
        return Response::success($this->adminSiteManageServices->noticeDetail($noticeUUID));
    }

    /**
     * 싸이트 공지 사항 리스트.
     * @return mixed
     */
    public function showNotice() {
        return Response::custom_success(200, __('default.response.process_success'), $this->adminSiteManageServices->defaultShowNotice());
    }
}
