<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Products
 *
 * @property int $id
 * @property string $uuid 상품 uuid.
 * @property \App\Models\Codes|null $category 상품 카테고리.
 * @property string $name 상품명.
 * @property string|null $barcode 상품 비코드.
 * @property int $price 상품 가격.
 * @property int $stock 상품 재고 수량.
 * @property string $memo 상품 메모.
 * @property string $sale 상품 판매 유무.
 * @property string $active 상품 상태.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImages[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductOptions[] $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUuid($value)
 * @mixin \Eloquent
 */
class Products extends Model
{
    use HasFactory;


    protected $table = 'products';

    /**
     * @var string[]
     */
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

    public function category()
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'category');
    }

    public function options()
    {
        return $this->hasOne('App\Models\ProductOptions', 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id', 'id');
    }
}
