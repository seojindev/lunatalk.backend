<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductImagesInterface;
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
