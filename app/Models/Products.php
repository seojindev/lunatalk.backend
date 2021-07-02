<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @method static \Database\Factories\ProductsFactory factory(...$parameters)
 * @property int $view_count 뷰 카운트.
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereViewCount($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HomeMains[] $homeMain
 * @property-read int|null $home_main_count
 * @property-read \App\Models\HomeMains|null $home_best_item
 * @property-read \App\Models\HomeMains|null $home_hot_item
 * @property-read \App\Models\HomeMains|null $home_top_item
 * @property-read \App\Models\ProductImages|null $rep_images
 */
class Products extends Model
{
    use HasFactory;

    /**
     * @var string
     */
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

    /**
     * 카테고리.
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne('App\Models\Codes', 'code_id', 'category');
    }

    /**
     * 옵션 관계.
     * @return HasOne
     */
    public function options(): HasOne
    {
        return $this->hasOne('App\Models\ProductOptions', 'product_id', 'id');
    }

    /**
     * 이미지 관계.
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id', 'id');
    }

    /**
     * 대표 이미지 관계.
     * @return HasOne
     */
    public function rep_images(): HasOne
    {
        return $this->hasOne('App\Models\ProductImages', 'product_id', 'id')->where('media_category', config('extract.mediaCategory.repImage.code'));
    }

    /**
     * 홈 메인 관계.
     * @return HasMany
     */
    public function homeMain() : HasMany
    {
        return $this->HasMany('App\Models\HomeMains', 'product_id', 'id');
    }

    /**
     * 홈 탑 이미지 관계.
     * @return HasOne
     */
    public function home_top_item() : HasOne
    {
        return $this->hasOne('App\Models\HomeMains', 'product_id', 'id')->where('gubun', config('extract.homeMainGubun.mainTop.code'));
    }

    /**
     * 홈 베스트 아이템 관계.
     * @return HasOne
     */
    public function home_best_item() : HasOne
    {
        return $this->hasOne('App\Models\HomeMains', 'product_id', 'id')->where('gubun', config('extract.homeMainGubun.mainBestItem.code'));
    }

    /**
     * 홈 핫 아이템 관계.
     * @return HasOne
     */
    public function home_hot_item() : HasOne
    {
        return $this->hasOne('App\Models\HomeMains', 'product_id', 'id')->where('gubun', config('extract.homeMainGubun.mainHotItem.code'));
    }
}
