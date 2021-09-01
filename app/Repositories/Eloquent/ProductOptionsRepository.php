<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductOptionsInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductOptions;

class ProductOptionsRepository extends BaseRepository implements ProductOptionsInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductOptions $model
     */
    public function __construct(ProductOptions $model)
    {
        parent::__construct($model);
    }
}
