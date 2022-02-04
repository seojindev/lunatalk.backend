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
     * 오더 카운트 - 입금전
     * @param Int $user_id
     * @return Int
     */
    public function getOrderBeForeCount(Int $user_id) : Int {
        return $this->model
            ->where('active', 'Y')
            ->where('user_id', $user_id)
            ->where('active', 'Y')
            ->where('state', config('extract.order_state.price_before'))
            ->get()
            ->count();
    }

    /**
     * 오더 카운트 - 배송준비중
     * @param Int $user_id
     * @return Int
     */
    public function getOrderDeliveryBeforeCount(Int $user_id) : Int {
        return $this->model
            ->where('active', 'Y')
            ->where('user_id', $user_id)
            ->where('active', 'Y')
            ->where('state', config('extract.order_state.price_end'))
            ->where('delivery', config('extract.order_state.delivery_brfore'))
            ->get()
            ->count();
    }

    /**
     * 오더 카운트 - 배송중
     * @param Int $user_id
     * @return Int
     */
    public function getOrderDeliveryIngCount(Int $user_id) : Int {
        return $this->model
            ->where('active', 'Y')
            ->where('user_id', $user_id)
            ->where('active', 'Y')
            ->where('state', config('extract.order_state.price_end'))
            ->where('delivery', config('extract.order_state.delivery_ing'))
            ->get()
            ->count();
    }

    /**
     * 오더 카운트 - 배송완료
     * @param Int $user_id
     * @return Int
     */
    public function getOrderDeliveryEndCount(Int $user_id) : Int {
        return $this->model
            ->where('active', 'Y')
            ->where('user_id', $user_id)
            ->where('active', 'Y')
            ->where('state', config('extract.order_state.price_end'))
            ->where('delivery', config('extract.order_state.delivery_end'))
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
            ->where('active', 'Y')
            ->with(['products.product.repImage.image', 'state'])
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 오더 상품 상세.
     * @param String $uuid
     * @return Collection
     */
    public function getOrderMasterDetail(String $uuid) : Collection {
        return $this->model
            ->where('uuid', $uuid)
            ->with([
                'user',
                'address',
                'state',
                'delivery',
                'receive',
                'products.product.category' => function($query){
                    $query->select(['id', 'uuid', 'name'])->where('active', 'Y');
                },
                'products.product.colors.color',
                'products.product.wireless.wireless',
                'products.product.repImages' => function($query) {
                    $query->where('media_id', '>', 0);
                },'products.product.repImages.image'
            ])
            ->get();
    }
}
