<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMasters;

class ProductMastersRepository extends BaseRepository implements ProductMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductMasters $model
     */
    public function __construct(ProductMasters $model)
    {
        parent::__construct($model);
    }

}
