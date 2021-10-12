<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductBadgeMastersInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductBadgeMasters;

class ProductBadgeMastersRepository extends BaseRepository implements ProductBadgeMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductBadgeMasters $model
     */
    public function __construct(ProductBadgeMasters $model)
    {
        parent::__construct($model);
    }
}
