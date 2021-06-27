<?php

namespace App\Http\Controllers\Front\v1;

use App\Http\Controllers\Front\RootController;
use App\Services\Front\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Front\v1
 */
class UserController extends RootController
{
    /**
     * @var UserServices
     */
    protected UserServices $userServices;

    /**
     * UserController constructor.
     * @param UserServices $userServices
     */
    public function __construct(UserServices $userServices)
    {
        parent::__construct();

        $this->userServices = $userServices;
    }

    /**
     * @return Application|Factory|View
     */
    public function list()
    {
        return view('admin/v1/pages/user/user-list', [
            'pages' => [
                'pageStep' => 'users',
            ],
            'users' => $this->userServices->usersList()
        ]);
    }
}
