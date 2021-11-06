<?php

namespace App\Http\Controllers\Api\Admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Http\Services\AdminUserManageServices;

class UserManageController extends Controller
{
    /**
     * @var AdminUserManageServices
     */
    protected AdminUserManageServices $userManageServices;

    /**
     * @param AdminUserManageServices $userManageServices
     */
    function __construct(AdminUserManageServices $userManageServices) {
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
     * 사용자 상세
     * @param String $uuid
     * @return mixed
     */
    public function detailUser(String $uuid) {
        return Response::custom_success(200, __('default.response.process_success'), $this->userManageServices->detailtUser($uuid));
    }

    /**
     * 사용자 수정.
     */
    public function updateUser($uuid) {
        return Response::custom_success(200, __('default.response.process_success'), $this->userManageServices->updateUser($uuid));
    }

    /**
     * 사용자 등록.
     */
    public function createUser() {
        return Response::custom_success(201, __('default.response.process_success'), $this->userManageServices->createUser());
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function deleteUser($uuid) {
        return Response::custom_success(200, __('default.response.process_success'), $this->userManageServices->deleteUser($uuid));
    }

}
