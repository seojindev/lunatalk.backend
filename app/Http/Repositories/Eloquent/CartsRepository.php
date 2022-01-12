<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\CartsRepositoryInterface;
use App\Models\Carts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class CartsRepository extends BaseRepository implements CartsRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Carts $model
     */
    public function __construct(Carts $model)
    {
        parent::__construct($model);
    }

    /**
     * 내 위시 리스트 상품 정보.
     * @param Int $user_id
     * @param Int $product_id
     * @return Collection
     */
    public function getUserCart(Int $user_id, Int $product_id) : Collection {
        return $this->model->where([['user_id', $user_id], ['product_id', $product_id]])->get();
    }

    /**
     * 사용자 장바구니 상품 리스트.
     * @param Int $user_id
     * @return Collection
     */
    public function userCarts(Int $user_id) : Collection {
        return $this->model->where('user_id', $user_id)
            ->with(['product.repImage.image', 'product.colors', 'product.colors.color'])
            ->get();
    }

    /**
     * 사용자 상품
     * @param Int $user_id
     * @param Int $cart_id
     * @return Collection
     */
    public function getUserCartById(Int $user_id, Int $cart_id) : Collection {
        return $this->model->where([['user_id', $user_id], ['id', $cart_id]])->get();
    }

    /**
     * 사용자 장바구니 상품 삭제.
     * @param Int $user_id
     * @param Int $cart_id
     * @return bool
     */
    public function deleteCart(Int $user_id, Int $cart_id) : bool {
        return $this->model->where([['user_id', $user_id], ['id', $cart_id]])->delete();
    }
}
