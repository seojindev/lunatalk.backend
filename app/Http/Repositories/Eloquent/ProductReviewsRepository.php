<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\ProductReviewsInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductReviews;

class ProductReviewsRepository extends BaseRepository implements ProductReviewsInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param ProductReviews $model
     */
    public function __construct(ProductReviews $model)
    {
        parent::__construct($model);
    }
}
