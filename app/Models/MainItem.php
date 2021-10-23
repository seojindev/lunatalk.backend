<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainItem
 *
 * @property int $id
 * @property string $uuid uuid.
 * @property string $category 구분.
 * @property int $product_id 상품 번호.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\ProductMasters|null $product
 * @method static \Database\Factories\MainItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MainItem whereUuid($value)
 * @mixin \Eloquent
 */
class MainItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'category',
        'product_id',
    ];

    public function product() {
        return $this->hasOne(ProductMasters::class, 'id', 'product_id');
    }
}
