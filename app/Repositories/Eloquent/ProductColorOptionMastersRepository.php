<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductColorOptionMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductColorOptionMasters;

class ProductColorOptionMastersRepository extends BaseRepository implements ProductColorOptionMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductColorOptionMasters $model
     */
    public function __construct(ProductColorOptionMasters $model)
    {
        parent::__construct($model);
    }
}
