<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\OrderAddressInterface;
use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Model;

class OrderAddressRepository extends BaseRepository implements OrderAddressInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param OrderAddress $model
     */
    public function __construct(OrderAddress $model)
    {
        parent::__construct($model);
    }
}
