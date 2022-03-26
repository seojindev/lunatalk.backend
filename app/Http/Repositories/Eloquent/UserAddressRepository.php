<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\UserAddressInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAddress;

class UserAddressRepository extends BaseRepository implements UserAddressInterface
{
    protected Model $model;

    public function __construct(UserAddress $model)
    {
        parent::__construct($model);
    }

}
