<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductMasters
 *
 * @property int $id
 * @property string $uuid 상품 uuid.
 * @property string $category 상품 카테고리.
 * @property string $name 상품명.
 * @property string|null $barcode 상품 비코드.
 * @property int $price 상품 가격.
 * @property int $stock 상품 재고 수량.
 * @property string|null $memo 상품 메모.
 * @property string $sale 상품 판매 유무.
 * @property string $active 상품 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProductMastersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductMasters onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductMasters whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ProductMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductMasters withoutTrashed()
 * @mixin \Eloquent
 */
class ProductMasters extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'uuid',
        'category',
        'name',
        'barcode',
        'price',
        'stock',
        'memo',
        'sale',
        'active'
    ];
}
