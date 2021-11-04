<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Repositories\Eloquent\UserRepository;
use App\Http\Repositories\Eloquent\UserRegisterSelectsRepository;
use Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class UserManageServices
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var UserRegisterSelectsRepository
     */
    protected UserRegisterSelectsRepository $userRegisterSelectsRepository;

    /**
     * @param Request $currentRequest
     * @param UserRepository $userRepository
     * @param UserRegisterSelectsRepository $userRegisterSelectsRepository
     */
    function __construct(Request $currentRequest, UserRepository $userRepository, UserRegisterSelectsRepository $userRegisterSelectsRepository) {
        $this->currentRequest = $currentRequest;
        $this->userRepository = $userRepository;
        $this->userRegisterSelectsRepository = $userRegisterSelectsRepository;
    }

    /**
     * 사용자 리스트
     * @return array
     */
    public function showUser() : array {

        $task = $this->userRepository->getTotalUsers();

        if(empty($task->toArray())) {
            throw new ModelNotFoundException();
        }

        return array_map(function($item) {
            return [
                'id' => $item['id'],
                'uuid' => $item['uuid'],
                'client' => [
                    'code_id' => $item['client']['code_id'],
                    'code_name' => $item['client']['code_name'],
                ],
                'type' => [
                    'code_id' => $item['type']['code_id'],
                    'code_name' => $item['type']['code_name'],
                ],
                'level' => [
                    'code_id' => $item['level']['code_id'],
                    'code_name' => $item['level']['code_name'],
                ],
                'status' => [
                    'code_id' => $item['status']['code_id'],
                    'code_name' => $item['status']['code_name'],
                ],
                'login_id' => $item['login_id'],
                'name' => $item['name'],
                'email' => $item['email'],
                'active' => $item['active'],
                'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                'updated_at' => Carbon::parse($item['updated_at'])->format('Y-m-d'),
            ];
        }, $task->toArray());
    }

    /**
     * 사용자 상세 정보
     * @param String $uuid
     * @return array
     */
    public function detailtUser(String $uuid) : array {

        $task = $this->userRepository->getUserDetail($uuid);

        if($task->isEmpty()) {
            throw new ModelNotFoundException();
        }

        $item = $task->first()->toArray();

        return [
            'id' => $item['id'],
            'uuid' => $item['uuid'],
            'client' => [
                'code_id' => $item['client']['code_id'],
                'code_name' => $item['client']['code_name'],
            ],
            'type' => [
                'code_id' => $item['type']['code_id'],
                'code_name' => $item['type']['code_name'],
            ],
            'level' => [
                'code_id' => $item['level']['code_id'],
                'code_name' => $item['level']['code_name'],
            ],
            'status' => [
                'code_id' => $item['status']['code_id'],
                'code_name' => $item['status']['code_name'],
            ],
            'login_id' => $item['login_id'],
            'name' => $item['name'],
            'email' => $item['email'],
            'active' => $item['active'],
            'user_select' => [
                'email' => $item['user_select']['email'],
                'message' => $item['user_select']['message'],
            ],
            'phone_verifies' => [
                'uuid' => $item['phone_verifies']['uuid'],
                'phone_number' => Crypt::decryptString($item['phone_verifies']['phone_number']),
                'auth_code' => $item['phone_verifies']['auth_code'],
                'verified' => $item['phone_verifies']['verified'],
            ],
            'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d'),
            'updated_at' => Carbon::parse($item['updated_at'])->format('Y-m-d'),
        ];
    }


    /**
     * 사용자 정보 업데이트.
     * @param $uuid
     * @return array
     * @throws ClientErrorException
     */
    public function updateUser($uuid) : array {

        $validator = Validator::make(collect($this->currentRequest->all())->put('uuid', $uuid)->toArray(), [
            'uuid' => 'required|exists:users,uuid',
            'type' => 'required|exists:codes,code_id',
            'level' => 'required|exists:codes,code_id',
            'status' => 'required|exists:codes,code_id',
            'user_name' => 'required',
            'user_email' => 'required',
            'user_select_email' => 'required|in:Y,N|max:1',
            'user_select_message' => 'required|in:Y,N|max:1'

        ],
            [
                'uuid.required' => __('admin-users-manage.update.uuid.required'),
                'uuid.exists' => __('admin-users-manage.update.uuid.exists'),
                'type.required' => __('admin-users-manage.update.type.required'),
                'type.exists' => __('admin-users-manage.update.uuid.exists'),
                'level.required' => __('admin-users-manage.update.level.required'),
                'level.exists' => __('admin-users-manage.update.level.exists'),
                'status.required' => __('admin-users-manage.update.status.required'),
                'status.exists' => __('admin-users-manage.update.status.exists'),
                'user_name.required' => __('admin-users-manage.update.user_name.required'),
                'user_email.required' => __('admin-users-manage.update.email.required'),
                'user_select_email.required'=> __('admin-users-manage.update.select_email.required'),
                'user_select_email.in'=> __('admin-users-manage.update.select_email.in'),
                'user_select_message.required'=> __('admin-users-manage.update.select_message.required'),
                'user_select_message.in'=> __('admin-users-manage.update.select_message.in'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $findTask = $this->userRepository->defaultCustomFind('uuid', $uuid);

        $this->userRepository->updateByCustomColumn('id', $findTask->id, [
            'type' => $this->currentRequest->input('type'),
            'level' => $this->currentRequest->input('level'),
            'status' => $this->currentRequest->input('status'),
            'name' => $this->currentRequest->input('user_name'),
            'email' => $this->currentRequest->input('user_email'),
        ]);

        $this->userRegisterSelectsRepository->updateByCustomColumn('user_id', $findTask->id, [
            'email' => $this->currentRequest->input('user_select_email'),
            'message' => $this->currentRequest->input('user_select_message')
        ]);

        return [
            'uuid' => $uuid
        ];
    }

    public function createUser() : array {
        return [];
    }

    public function deleteUser($uuid): array {
        return [];
    }
}
