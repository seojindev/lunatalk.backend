<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserPhoneVerifyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneVerifies;

class UserPhoneVerifyRepository extends BaseRepository implements UserPhoneVerifyRepositoryInterface
{
    protected Model $model;

    public function __construct(PhoneVerifies $model)
    {
        parent::__construct($model);
    }

}
