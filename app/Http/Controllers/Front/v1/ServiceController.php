<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use App\Services\FrontRootServices;
use App\Services\Front\AdminServices;
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
     * @var AdminServices
     */
    protected AdminServices $adminServices;

    /**
     * ServiceController constructor.
     * @param FrontRootServices $frontRootServices
     * @param AdminServices $adminServices
     */
    public function __construct(FrontRootServices $frontRootServices, AdminServices $adminServices)
    {
        parent::__construct();

        $this->frontRootServices = $frontRootServices;
        $this->adminServices = $adminServices;
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
            'mains' => $this->adminServices->editMainHomeList()
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
                'pageMode' => 'create',
            ],
            'simpleProducts' => $this->adminServices->simpleProductList(),
            'mainhome' => null
        ]);
    }

    /**
     * 홈 메인 수정 및 보기 페이지.
     * @param Int $id
     * @return Application|Factory|View
     */
    public function edit_home_main_update(Int $id)
    {
        return view('admin/v1/pages/service/edit-home-main-create', [
            'pages' => [
                'pageStep' => 'service',
                'pageMode' => 'update',
            ],
            'simpleProducts' => $this->adminServices->simpleProductList(),
            'mainhome' => $this->adminServices->updateEditMainHome($id)
        ]);
    }
}
