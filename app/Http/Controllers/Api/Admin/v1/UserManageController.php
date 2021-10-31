<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Services\UserManageServices;

class UserManageController extends Controller
{
    protected UserManageServices $userManageServices;

    function __construct(UserManageServices $userManageServices) {
        $this->userManageServices = $userManageServices;
    }

    /**
     * 사용자 리스트.
     * @return mixed
     */
    public function showUser() {
        return Response::custom_success(200, __('default.response.process_success'), $this->userManageServices->showUser());
    }

    /**
     * 사용자 상세.
     */
    public function detailUser(String $uuid) {

    }

    /**
     * 사용자 등록.
     */

    /**
     * 사용자 수정.
     */
}
