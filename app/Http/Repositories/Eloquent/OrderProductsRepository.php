<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\OrderProductsInterface;
use App\Models\OrderProducts;
use Illuminate\Database\Eloquent\Model;

class OrderProductsRepository extends BaseRepository implements OrderProductsInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param OrderProducts $model
     */
    public function __construct(OrderProducts $model)
    {
        parent::__construct($model);
    }
}
