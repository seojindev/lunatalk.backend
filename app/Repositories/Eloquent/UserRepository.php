<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\UserRepositoryInterface;
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
}
