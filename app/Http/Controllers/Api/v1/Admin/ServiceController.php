<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Api\RootController;
use Illuminate\Http\Request;
use App\Services\ApiRootServices;
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
     * ServiceController constructor.
     * @param ApiRootServices $apiRootServices
     */
    public function __construct(ApiRootServices $apiRootServices)
    {
        $this->apiRootServices = $apiRootServices;
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
}
