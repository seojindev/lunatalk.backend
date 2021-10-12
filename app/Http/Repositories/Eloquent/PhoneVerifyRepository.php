<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\PhoneVerifyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneVerifies;

class PhoneVerifyRepository extends BaseRepository implements PhoneVerifyRepositoryInterface
{
    protected Model $model;

    public function __construct(PhoneVerifies $model)
    {
        parent::__construct($model);
    }

}
