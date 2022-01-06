<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderProducts
 *
 * @property int $id
 * @property int|null $order_id 오더 번호
 * @property int|null $product_id 오더 번호
 * @property int $price 상품 가격.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\OrderProductsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price'
    ];
}
