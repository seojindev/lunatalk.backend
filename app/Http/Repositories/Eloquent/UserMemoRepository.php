<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\UserMemoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMemo;

class UserMemoRepository extends BaseRepository implements UserMemoRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param UserMemo $model
     */
    public function __construct(UserMemo $model)
    {
        parent::__construct($model);
    }
}
