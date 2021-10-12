<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductBadgesInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductBadges;

class ProductBadgesRepository extends BaseRepository implements ProductBadgesInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductBadges $model
     */
    public function __construct(ProductBadges $model)
    {
        parent::__construct($model);
    }
}
