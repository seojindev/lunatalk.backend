<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Carts
 *
 * @property int $id
 * @property int|null $user_id 회원 번호
 * @property int $product_id 상품 id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductMasters|null $product
 * @method static \Database\Factories\CartsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUserId($value)
 * @mixin \Eloquent
 */
class Carts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function product() {
        return $this->hasOne(ProductMasters::class, 'id', 'product_id');
    }

}
