<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\OrderMasters
 *
 * @property int $id
 * @property string $uuid uuid
 * @property int|null $user_id 회원 번호
 * @property string $name 이름
 * @property string $phone 휴대폰 번호
 * @property string $email 이메일
 * @property string $message 배송 메시지
 * @property string $order_name 상품명.
 * @property int $order_price 상품 가격.
 * @property string|null $active 시도 상태
 * @property \App\Models\Codes|null $state 결제 상태.
 * @property \App\Models\Codes|null $delivery 배송 상태.
 * @property \App\Models\Codes|null $receive 고객 상품 선택 상태.
 * @property string $order_log 결제 기록.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\OrderAddress|null $address
 * @property-read \App\Models\OrderPayments|null $payments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProducts[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\OrderMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|OrderMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereOrderLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereOrderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereOrderPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|OrderMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OrderMasters withoutTrashed()
 * @mixin \Eloquent
 */
class OrderMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'phone',
        'email',
        'message',
        'order_name',
        'order_price',
        'active',
        'delivery',
        'memo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address() {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(OrderProducts::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state() {
        return $this->hasOne(Codes::class, 'code_id', 'state');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function delivery() {
        return $this->hasOne(Codes::class, 'code_id', 'delivery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receive() {
        return $this->hasOne(Codes::class, 'code_id', 'receive');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payments() {
        return $this->hasOne(OrderPayments::class, 'order_id', 'id');
    }
}
