<?php

namespace App\Http\Controllers\Api;

use App\Services\RootServices;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Response;

/**
 * Class SystemController
 * @package App\Http\Controllers\Api
 */
class SystemController extends RootController
{
    /**
     * @var RootServices
     */
    protected RootServices $rootServices;

    /**
     * SystemController constructor.
     * @param RootServices $rootServices
     */
    public function __construct(RootServices $rootServices)
    {
        $this->rootServices = $rootServices;
    }

    /**
     * 서버 상태 체크.
     * @return mixed
     */
    public function checkStatus()
    {
        return Response::success_no_content();
    }

    /**
     * 서버 공지 사항 체크.
     * @return mixed
     * @throws FileNotFoundException
     */
    public function checkServerNotice()
    {
        $task = $this->rootServices->checkSererNotice();

        if($task['check']) {
            return Response::success([
                'notice' => $task['notice']
            ]);
        }

        return Response::success_no_content();
    }

    /**
     * 공통 데이터.
     * @return mixed
     */
    public function baseData()
    {
        return Response::success($this->rootServices->createBaseData());
    }
}
