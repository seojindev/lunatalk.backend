<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Api\RootController;
use App\Services\ApiRootServices;
use App\Services\Api\AdminServices;
use Illuminate\Support\Facades\Response;

/**
 * Class ServiceController
 * @package App\Http\Controllers\Api\v1\Admin
 */
class ServiceController extends RootController
{
    /**
     * @var ApiRootServices
     */
    protected ApiRootServices $apiRootServices;

    /**
     * @var AdminServices
     */
    protected AdminServices $adminServices;

    /**
     * ServiceController constructor.
     * @param ApiRootServices $apiRootServices
     * @param AdminServices $adminServices
     */
    public function __construct(ApiRootServices $apiRootServices, AdminServices $adminServices)
    {
        $this->apiRootServices = $apiRootServices;
        $this->adminServices = $adminServices;
    }

    /**
     * 서비스 공지사항 추가, 수정.
     * @return mixed
     * @throws ClientErrorException
     */
    public function service_notice()
    {
        $this->apiRootServices->createServiceNotice();
        return Response::success_only_message();
    }

    /**
     * 서비스 공지사항 삭제.
     * @return mixed
     */
    public function delete_service_notice()
    {
        $this->apiRootServices->deleteServiceNotice();
        return Response::success_only_message(202);
    }

    /**
     * 홈 메인 생성.
     * @return mixed
     * @throws ClientErrorException
     */
    public function edit_home_main_create()
    {
        $this->adminServices->createAdminMainHome();
        return Response::success_only_message();
    }

    /**
     * 홈 메인 업데이트.
     * @param Int $id
     * @return mixed
     * @throws ClientErrorException
     */
    public function edit_home_main_update(Int $id)
    {
        $this->adminServices->updateAdminMainHome($id);
        return Response::success();
    }

    /**
     * 홈 메인 삭제.
     * @param Int $id
     * @return mixed
     */
    public function edit_home_main_delete(Int $id)
    {
        $this->adminServices->deleteAdminMainHome($id);
        return Response::success();
    }

    /**
     * 홈 메인 상태 업데이트.
     * @param Int $id
     * @return mixed
     * @throws ClientErrorException
     */
    public function edit_home_main_statsu_update(Int $id)
    {
        $this->adminServices->updateStatusAdminMainHome($id);
        return Response::success();
    }
}
