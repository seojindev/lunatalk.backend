<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\OrderMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderMasters;

class OrderMastersRepository extends BaseRepository implements OrderMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param OrderMasters $model
     */
    public function __construct(OrderMasters $model)
    {
        parent::__construct($model);
    }
}
