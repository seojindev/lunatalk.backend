<?php

namespace App\Models;

use Database\Factories\ProductMastersFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductMasters
 *
 * @property int $id
 * @property string $uuid uuid
 * @property \App\Models\ProductCategoryMasters|null $category 상품 카테고리.
 * @property string $name 상품명.
 * @property string|null $barcode 상품 비코드.
 * @property int $price 상품 가격.
 * @property int $quantity 상품 재고 수량.
 * @property string|null $memo 상품 메모.
 * @property string $sale 상품 판매 유무.
 * @property string $active 상품 상태.
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\MainItem|null $bestItem
 * @property-read \App\Models\ProductOptions|null $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductOptions[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImages[] $detailImages
 * @property-read int|null $detail_images_count
 * @property-read \App\Models\MainItem|null $newItem
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductOptions[] $options
 * @property-read int|null $options_count
 * @property-read \App\Models\ProductImages|null $repImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImages[] $repImages
 * @property-read int|null $rep_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductOptions[] $wireless
 * @property-read int|null $wireless_count
 * @method static \Database\Factories\ProductMastersFactory factory(...$parameters)
 * @method static Builder|ProductMasters newModelQuery()
 * @method static Builder|ProductMasters newQuery()
 * @method static \Illuminate\Database\Query\Builder|ProductMasters onlyTrashed()
 * @method static Builder|ProductMasters query()
 * @method static Builder|ProductMasters whereActive($value)
 * @method static Builder|ProductMasters whereBarcode($value)
 * @method static Builder|ProductMasters whereCategory($value)
 * @method static Builder|ProductMasters whereCreatedAt($value)
 * @method static Builder|ProductMasters whereDeletedAt($value)
 * @method static Builder|ProductMasters whereId($value)
 * @method static Builder|ProductMasters whereMemo($value)
 * @method static Builder|ProductMasters whereName($value)
 * @method static Builder|ProductMasters wherePrice($value)
 * @method static Builder|ProductMasters whereQuantity($value)
 * @method static Builder|ProductMasters whereSale($value)
 * @method static Builder|ProductMasters whereUpdatedAt($value)
 * @method static Builder|ProductMasters whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ProductMasters withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ProductMasters withoutTrashed()
 * @mixin Eloquent
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
        'quantity',
        'memo',
        'sale',
        'active'
    ];

    public function category()
    {
        return $this->hasOne(ProductCategoryMasters::class, 'id', 'category');
    }

    public function options()
    {
        return $this->hasMany(ProductOptions::class, 'product_id', 'id');
    }

    public function color()
    {
        return $this->hasOne(ProductOptions::class, 'product_id', 'id')->whereNotNull('color');
    }

    public function colors()
    {
        return $this->hasMany(ProductOptions::class, 'product_id', 'id')->whereNotNull('color');
    }

    public function wireless()
    {
        return $this->hasMany(ProductOptions::class, 'product_id', 'id')->whereNotNull('wireless');
    }

    public function repImage()
    {
        return $this->hasOne(ProductImages::class, 'product_id', 'id')->where('media_category', config('extract.mediaCategory.repImage.code'))->latest();
    }

    public function repImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->where('media_category', config('extract.mediaCategory.repImage.code'));
    }

    public function detailImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->where('media_category', config('extract.mediaCategory.detailImage.code'));
    }

    public function bestItem() {
        return $this->hasOne(MainItem::class, 'product_id', 'id')->where('category', config('extract.main_item.bestItem.code'));
    }

    public function newItem() {
        return $this->hasOne(MainItem::class, 'product_id', 'id')->where('category', config('extract.main_item.newItem.code'));
    }
}
