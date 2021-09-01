<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ProductImagesInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;

class ProductImagesRepository extends BaseRepository implements ProductImagesInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductImages $model
     */
    public function __construct(ProductImages $model)
    {
        parent::__construct($model);
    }
}
