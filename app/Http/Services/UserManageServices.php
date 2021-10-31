<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class UserManageServices
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
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
                'active' => $item['active'],
                'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d'),
                'updated_at' => Carbon::parse($item['updated_at'])->format('Y-m-d'),
            ];
        }, $task->toArray());
    }
}
