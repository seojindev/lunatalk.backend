<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AdminSystemServices;
use Illuminate\Support\Facades\Response;

class SystemController extends Controller
{

    /**
     * @var AdminSystemServices
     */
    protected AdminSystemServices $adminSystemServices;

    /**
     * @param AdminSystemServices $adminSystemServices
     */
    function __construct(AdminSystemServices $adminSystemServices)
    {
        $this->adminSystemServices = $adminSystemServices;
    }

    /**
     * 시스템 공지 사항 정보.
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSystemNotice() {
        return Response::success($this->adminSystemServices->getSystemNotice());
    }

    /**
     * 시스템 공지 사항 등록.
     * @return mixed
     */
    public function createSystemNotice() {
        $this->adminSystemServices->createSystemNotice();
        return Response::success_only_message(201);
    }
}
