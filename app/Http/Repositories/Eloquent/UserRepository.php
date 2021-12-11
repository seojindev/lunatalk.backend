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

    public function getUserDetailById(String $id) : Collection {
        return $this->model
            ->where('id', $id)
            ->with(['client', 'type', 'level', 'status', 'user_select', 'phone_verifies', 'memo'])
            ->orderBy('id', 'desc')
            ->get();
    }
}
