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
 * @property string $active 결제 상태
 * @property string $state 결제 상.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\OrderAddress|null $address
 * @method static \Database\Factories\OrderMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|OrderMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereOrderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters whereOrderPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderMasters wherePhone($value)
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
        'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address() {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }
}
