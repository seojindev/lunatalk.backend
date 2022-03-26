<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * 사용자 전체 리스트용.
     * @return Collection
     */
    public function getTotalUsers() : Collection {
        return $this->model
            ->with(['client', 'type', 'level', 'status', 'phone_verifies'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 사용자 상세 정보용.
     * @param String $uuid
     * @return Collection
     */
    public function getUserDetail(String $uuid) : Collection {
        return $this->model
            ->where('uuid', $uuid)
            ->with(['client', 'type', 'level', 'status', 'user_select', 'phone_verifies', 'memo'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 회원 상세 정보용.
     * @param String $id
     * @return Collection
     */
    public function getUserDetailById(String $id) : Collection {
        return $this->model
            ->where('id', $id)
            ->with(['client', 'type', 'level', 'status', 'user_select', 'phone_verifies', 'memo', 'address'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 회원 정보 수정.
     * @param Int $id
     * @param array $info
     * @return mixed
     */
    public function updateUserDetailInfo(Int $id, Array $info) {
        return $this->model->where('id', $id)->update($info);
    }

    /**
     * 로그인 아이디 찾기.
     * @param String $email
     * @return Collection
     */
    public function getLoginIdByEmail(String $email): Collection {
        return $this->model->where('email', $email)->get();
    }
}
