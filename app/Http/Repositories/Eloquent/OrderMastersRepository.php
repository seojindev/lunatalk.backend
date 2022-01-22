<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\OrderMastersInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderMasters;

class OrderMastersRepository extends BaseRepository implements OrderMastersInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param OrderMasters $model
     */
    public function __construct(OrderMasters $model)
    {
        parent::__construct($model);
    }

    /**
     * 내 주문 정보(성공한 주문)
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getOrder($user_id) {
        return $this->model
            ->with(['address'])
            ->where('user_id', $user_id)
            ->where('active', 'Y')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 오더 카운트
     * @param Int $user_id
     * @param String $state_code
     * @return Int
     */
    public function getOrderCount(Int $user_id, String $state_code) : Int {
        return $this->model
            ->where('active', 'Y')
            ->where('user_id', $user_id)
            ->where('state', $state_code)
            ->get()
            ->count();
    }

    /**
     * 오더 리스트.
     * @param Int $user_id
     * @return Collection
     */
    public function getOrderProducts(Int $user_id) : Collection {
        return $this->model
            ->where('user_id', $user_id)
            ->with(['products.product.repImage.image', 'state'])
            ->orderBy('id', 'desc')
            ->get();
    }
}
