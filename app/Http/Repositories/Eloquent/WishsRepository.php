<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\WishsRepositoryInterface;
use App\Models\Wishs;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class WishsRepository extends BaseRepository implements WishsRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Wishs $model
     */
    public function __construct(Wishs $model)
    {
        parent::__construct($model);
    }

    /**
     * 내 위시 리스트 상품 정보.
     * @param Int $user_id
     * @param Int $product_id
     * @return Collection
     */
    public function getUserWish(Int $user_id, Int $product_id) : Collection {
        return $this->model->where([['user_id', $user_id], ['product_id', $product_id]])->get();
    }
}
