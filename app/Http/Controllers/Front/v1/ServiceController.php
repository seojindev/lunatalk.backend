<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use App\Services\FrontRootServices;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class ServiceController
 * @package App\Http\Controllers\Front\v1
 */
class ServiceController extends RootController
{
    /**
     * @var FrontRootServices
     */
    protected FrontRootServices $frontRootServices;

    /**
     * ServiceController constructor.
     * @param FrontRootServices $frontRootServices
     */
    public function __construct(FrontRootServices $frontRootServices)
    {
        parent::__construct();

        $this->frontRootServices = $frontRootServices;
    }

    /**
     * 서비스 공지 사항 관리 페이지.
     * @return Application|Factory|View
     * @throws FileNotFoundException
     */
    public function service_notice()
    {
        return view('admin/v1/pages/service/service-notice', [
            'pages' => [
                'pageStep' => 'service',
            ],
            'noticeContents' => $this->frontRootServices->getServerNotice()
        ]);
    }

    /**
     * 홈 메인 편집 리스트.
     * @return Application|Factory|View
     */
    public function edit_home_main_list()
    {
        return view('admin/v1/pages/service/edit-home-main-list', [
            'pages' => [
                'pageStep' => 'service',
            ],
            'main_list' => '',
        ]);
    }

    /**
     * 홈 메인 편집 생성.
     * @return Application|Factory|View
     */
    public function edit_home_main_create()
    {
        return view('admin/v1/pages/service/edit-home-main-create', [
            'pages' => [
                'pageStep' => 'service',
            ],
            'main' => '',
        ]);
    }
}
