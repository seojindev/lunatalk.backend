<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\UserRegisterSelectsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserRegisterSelects;

class UserRegisterSelectsRepository extends BaseRepository implements UserRegisterSelectsRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param UserRegisterSelects $model
     */
    public function __construct(UserRegisterSelects $model)
    {
        parent::__construct($model);
    }
}
