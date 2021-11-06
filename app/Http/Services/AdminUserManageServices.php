<?php

namespace App\Http\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Repositories\Eloquent\UserRepository;
use App\Http\Repositories\Eloquent\UserRegisterSelectsRepository;
use App\Http\Repositories\Eloquent\PhoneVerifyRepository;
use Crypt;
use Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminUserManageServices
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

    protected PhoneVerifyRepository $phoneVerifyRepository;

    /**
     * @param Request $currentRequest
     * @param UserRepository $userRepository
     * @param UserRegisterSelectsRepository $userRegisterSelectsRepository
     * @param PhoneVerifyRepository $phoneVerifyRepository
     */
    function __construct(Request $currentRequest, UserRepository $userRepository, UserRegisterSelectsRepository $userRegisterSelectsRepository, PhoneVerifyRepository $phoneVerifyRepository) {
        $this->currentRequest = $currentRequest;
        $this->userRepository = $userRepository;
        $this->userRegisterSelectsRepository = $userRegisterSelectsRepository;
        $this->phoneVerifyRepository = $phoneVerifyRepository;
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

    /**
     * @return array
     * @throws ClientErrorException
     */
    public function createUser() : array {
        $validator = Validator::make($this->currentRequest->all(), [
            'type' => 'required|exists:codes,code_id',
            'level' => 'required|exists:codes,code_id',
            'status' => 'required|exists:codes,code_id',
            'user_id' => 'required|between:5,20|regex:/^[a-z]/i|regex:/(^[A-Za-z0-9 ]+$)+/|unique:users,login_id',
            'user_password' => 'required|between:5,20',
            'user_phone_number' => 'required|numeric|digits_between:8,11',
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email',
            'user_select_email' => 'required|in:Y,N|max:1',
            'user_select_message' => 'required|in:Y,N|max:1'
        ],
            [
                'type.required' => __('admin-users-manage.create.type.required'),
                'type.exists' => __('admin-users-manage.create.uuid.exists'),
                'level.required' => __('admin-users-manage.create.level.required'),
                'level.exists' => __('admin-users-manage.create.level.exists'),
                'status.required' => __('admin-users-manage.create.status.required'),
                'status.exists' => __('admin-users-manage.create.status.exists'),
                'user_id.required' => __('admin-users-manage.create.user_id.reqquired'),
                'user_id.between' => __('admin-users-manage.create.user_id.check'),
                'user_id.regex' => __('admin-users-manage.create.user_id.check'),
                'user_id.unique' => __('admin-users-manage.create.user_id.unique'),
                'user_password.required' => __('admin-users-manage.create.user_password.required'),
                'user_password.between' => __('admin-users-manage.create.user_password.check'),
                'user_phone_number.required' => __('admin-users-manage.create.user_phone_number.required'),
                'user_phone_number.min' => __('admin-users-manage.create.user_phone_number.minmax'),
                'user_phone_number.digits_between' => __('admin-users-manage.create.user_phone_number.minmax'),
                'user_phone_number.numeric' => __('admin-users-manage.create.user_phone_number.numeric'),
                'user_name.required' => __('admin-users-manage.create.user_name.required'),
                'user_email.required' => __('admin-users-manage.create.email.required'),
                'user_email.unique' => __('admin-users-manage.create.email.unique'),
                'user_select_email.required'=> __('admin-users-manage.create.select_email.required'),
                'user_select_email.unique'=> __('admin-users-manage.create.select_email.unique'),
                'user_select_message.required'=> __('admin-users-manage.create.select_message.required'),
                'user_select_message.in'=> __('admin-users-manage.create.select_message.in'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }


        $usr_uuid = Str::uuid()->toString();

        // 각 코드들 때문에 웹 외엔 추가 수정 필요.
        $createTask = $this->userRepository->create([
            'uuid' => $usr_uuid,
            'type' => $this->currentRequest->input('type'),
            'level' => $this->currentRequest->input('level'),
            'status' => $this->currentRequest->input('status'),
            'login_id' => $this->currentRequest->input('user_id'),
            'name' => $this->currentRequest->input('user_name'),
            'email' => $this->currentRequest->input('user_email'),
            'password' => Hash::make($this->currentRequest->input('user_password')),
        ]);

        $this->userRegisterSelectsRepository->create([
            'user_id' => $createTask->id,
            'email' => $this->currentRequest->input('user_select_email'),
            'message' => $this->currentRequest->input('user_select_message')
        ]);

        $this->phoneVerifyRepository->create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => $createTask->id,
            'phone_number' => Crypt::encryptString($this->currentRequest->input('phone_number')),
            'auth_code' => Helper::generateAuthNumberCode(),
            'verified' => 'Y'
        ]);

        return [
            "uuid" => $usr_uuid
        ];
    }

    /**
     * @param $uuid
     * @return void
     * @throws ClientErrorException
     */
    public function deleteUser($uuid): void {
        $validator = Validator::make([
            'uuid' => $uuid
        ], [
            'uuid' => 'required|exists:users,uuid',
        ], [
                'uuid.exists' => '존재 하는 사용자가 아닙니다.',
        ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $task = $this->userRepository->defaultCustomFind('uuid', $uuid);

        $this->userRepository->deleteById($task->id);
        $this->userRegisterSelectsRepository->deleteByCustomColumn('user_id', $task->id);
        $this->phoneVerifyRepository->deleteByCustomColumn('user_id', $task->id);

    }

    /**
     * @param String $uuid
     * @throws ClientErrorException
     */
    public function updateUserPassword(String $uuid) : void {
        $validator = Validator::make(collect($this->currentRequest->all())->put('uuid', $uuid)->toArray(), [
            'uuid' => 'required|exists:users,uuid',
            'user_password' => 'required|between:5,20',
            'user_password.required' => __('admin-users-manage.create.user_password.required'),
            'user_password.between' => __('admin-users-manage.create.user_password.check'),
        ], [
            'uuid.exists' => '존재 하는 사용자가 아닙니다.',
            'user_password.required' => __('admin-users-manage.create.user_password.required'),
            'user_password.between' => __('admin-users-manage.create.user_password.check'),
        ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->userRepository->updateByCustomColumn('uuid', $uuid, [
            'password' => Hash::make($this->currentRequest->input('user_password')),
        ]);
    }

    public function updateUserPhoneNumber(String $uuid) : void {
        //
    }
}
