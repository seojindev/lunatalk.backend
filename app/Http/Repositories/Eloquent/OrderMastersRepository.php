<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\OrderMastersInterface;
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
}
